<?php

namespace App\Controllers;


class Digiflazz extends BaseController
{
    private $apiUrl = 'https://api.digiflazz.com/v1/price-list';
    private $username;
    private $apiKey;
    public $M_Base;

    public function __construct()
    {
        $this->M_Base = new \App\Models\M_Base();
        $this->username = $this->M_Base->u_get('digi-user');
        $this->apiKey = $this->M_Base->u_get('digi-key');
        
        if (empty($this->username) || empty($this->apiKey)) {
            throw new \RuntimeException('Digiflazz credentials not configured');
        }
    }

    /**
     * Get semua produk (GET/POST)
     */
    public function getAllProducts()
    {
        $products = $this->getProduk();
        return $this->formatResponse($products);
    }

    /**
     * Get produk by kode (GET/POST)
     */
    public function getProductByCode($kodeProduk)
    {
        $product = $this->getProduk($kodeProduk);
        return $this->formatResponse($product);
    }

    /**
     * Get produk dengan query parameter (GET)
     * Contoh: /digiflazz/product?code=xld10
     */
    public function getProduct()
    {
        $kodeProduk = $this->request->getGet('code');
        $product = $this->getProduk($kodeProduk);
        return $this->formatResponse($product);
    }

   
    public function getProductsByBrand($brand)
{
    $allProducts = $this->getProduk();
    
    if ($allProducts === null) {
        return $this->formatResponse(null, false, 'Failed to retrieve products');
    }

    $filteredProducts = array_filter($allProducts, function($product) use ($brand) {
        return strtoupper($product['brand'] ?? '') === strtoupper($brand);
    });

    // Konversi ke array index
    $filteredProducts = array_values($filteredProducts);
    
    // Sorting berdasarkan jumlah diamond di product_name
    $sort = $this->request->getGet('sort') ?? 'asc'; // asc atau desc
    usort($filteredProducts, function($a, $b) use ($sort) {
        $diamondA = $this->extractDiamondCount($a['product_name'] ?? '');
        $diamondB = $this->extractDiamondCount($b['product_name'] ?? '');
        
        return ($sort === 'desc') ? $diamondB - $diamondA : $diamondA - $diamondB;
    });

    if ($this->request->getGet('export') === 'excel') {
        return $this->exportToExcel($filteredProducts, $brand, $sort);
    }

    return $this->formatResponse($filteredProducts);
}

private function extractDiamondCount($productName)
{
    // Mencocokkan pola: [DIGIT] Diamond
    if (preg_match('/(\d+)\s*Diamond/i', $productName, $matches)) {
        return (int)$matches[1];
    }
    
    // Alternatif jika format berbeda
    if (preg_match('/(\d+)/', $productName, $matches)) {
        return (int)$matches[1];
    }
    
    return 0;
}

private function exportToExcel($products, $brandName, $sortOrder)
{
    if (empty($products)) {
        die('Tidak ada data produk untuk diexport');
    }

    $fileName = $brandName . strtolower($sortOrder) . '_' . date('YmdHis') . '.xlsx';
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    
    // Hapus sheet default
    $spreadsheet->removeSheetByIndex(0);
    
    // Kelompokkan produk berdasarkan type
    $groupedProducts = [];
    foreach ($products as $product) {
        $type = $product['type'] ?? 'Lainnya';
        $groupedProducts[$type][] = $product;
    }
    
    // Buat worksheet untuk setiap type
    foreach ($groupedProducts as $type => $typeProducts) {
        $sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $this->sanitizeSheetName($type));
        $spreadsheet->addSheet($sheet);
        $spreadsheet->setActiveSheetIndexByName($this->sanitizeSheetName($type));
        
        // Header
        $headers = ['No', 'Product Name', 'Diamonds', 'Price', 'SKU Code'];
        $sheet->fromArray($headers, null, 'A1');
        
        // Data
        $row = 2;
        foreach ($typeProducts as $index => $product) {
            $productName = $this->cleanProductName(
                $product['product_name'] ?? '', 
                $product['brand'] ?? ''
            );
            $diamondCount = $this->extractDiamondCount($product['product_name'] ?? '');
            
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $productName);
            $sheet->setCellValue('C' . $row, $diamondCount);
            $sheet->setCellValue('D' . $row, $product['price'] ?? 0);
            $sheet->setCellValue('E' . $row, $product['buyer_sku_code'] ?? 'N/A');
            
            $row++;
        }
        
        // Styling untuk setiap sheet
        $this->applySheetStyle($sheet, $row);
    }
    
    // Set sheet pertama sebagai aktif
    $spreadsheet->setActiveSheetIndex(0);
    
    // Output
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

/**
 * Membersihkan product_name dengan menghilangkan brand
 */
private function cleanProductName($productName, $brand) {
    // Jika brand kosong, kembalikan product_name asli
    if (empty($brand)) {
        return $productName;
    }

    // Daftar pengecualian khusus
    $exceptions = [
        'MOBILE LEGENDS Weekly Diamond Pass' => 'Weekly Diamond Pass',
        // Tambahkan pengecualian lain jika diperlukan
    ];
    
    // Cek pengecualian
    if (isset($exceptions[$productName])) {
        return $exceptions[$productName];
    }

    // Buat berbagai variasi pola matching untuk brand
    $brandVariations = [
        $brand, // Original (MOBILE LEGENDS)
        str_replace(' ', '', $brand), // MOBILELEGENDS
        substr(str_replace(' ', '', $brand), 0, -1), // MOBILELEGEND (untuk kasus typo)
        preg_replace('/\s+/', '-', $brand), // MOBILE-LEGENDS
        preg_replace('/\s+/', '_', $brand) // MOBILE_LEGENDS
    ];

    // Coba semua variasi brand
    foreach ($brandVariations as $variation) {
        $pattern = '/^' . preg_quote($variation, '/') . '[\s\-_]*/i';
        $cleaned = preg_replace($pattern, '', $productName);
        
        // Jika ada perubahan dan hasilnya tidak kosong
        if ($cleaned !== $productName && !empty(trim($cleaned))) {
            // Hapus karakter khusus di awal hasil
            $cleaned = preg_replace('/^[\s\-_]+/', '', $cleaned);
            return trim($cleaned);
        }
    }

    // Fallback: Hapus kata "MOBILE" jika masih ada
    $cleaned = preg_replace('/^mobile[\s\-_]*/i', '', $productName);
    $cleaned = preg_replace('/^[\s\-_]+/', '', $cleaned);
    
    return trim($cleaned) ?: $productName; // Kembalikan original jika semua gagal
}

/**
 * Sanitasi nama sheet Excel
 */
private function sanitizeSheetName($name) {
    $name = substr($name, 0, 31); // Excel membatasi 31 karakter
    return preg_replace('/[\/:*?"<>|]/', '', $name); // Hapus karakter terlarang
}

/**
 * Apply styling untuk sheet Excel
 */
private function applySheetStyle($sheet, $lastRow) {
    // Header styling
    $sheet->getStyle('A1:E1')->applyFromArray([
        'font' => ['bold' => true],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFD9D9D9']
        ]
    ]);
    
    // Auto size columns
    foreach (range('A', 'E') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    // Border untuk seluruh data
    $sheet->getStyle('A1:E' . ($lastRow - 1))->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            ]
        ]
    ]);
}
    /**
     * Function utama untuk get produk
     */
    private function getProduk($kodeProduk = null)
    {
        $client = \Config\Services::curlrequest();

        $data = [
            'cmd' => 'prepaid',
            'username' => $this->username,
            'sign' => md5($this->username . $this->apiKey . 'pricelist')
        ];

        if ($kodeProduk) {
            $data['code'] = $kodeProduk;
        }

        try {
            $response = $client->request('POST', $this->apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
                'timeout' => 30,
                'http_errors' => false
            ]);

            $result = json_decode($response->getBody(), true);
            
            if ($response->getStatusCode() !== 200) {
                log_message('error', 'Digiflazz API Error: ' . ($result['message'] ?? 'Unknown error'));
                return null;
            }
            
            return $result['data'] ?? null;
            
        } catch (\Exception $e) {
            log_message('error', 'Digiflazz API Exception: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Format standar response JSON
     */
    private function formatResponse($data, $status = null, $message = null)
    {
        $status = $status ?? !empty($data);
        $message = $message ?? ($status ? 'Success' : 'No data found');
        
        return $this->response->setJSON([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
    
    public function exportPage()
{
    // Ambil semua produk dari API Digiflazz
    $allProducts = $this->getProduk();
    
    $brands = [];
    
    if ($allProducts && is_array($allProducts)) {
        // Ekstrak brand dari semua produk
        foreach ($allProducts as $product) {
            if (!empty($product['brand'])) {
                $brand = strtoupper($product['brand']);
                if (!in_array($brand, $brands)) {
                    $brands[] = $brand;
                }
            }
        }
        
        // Urutkan brand secara alfabet
        sort($brands);
        
        // Tambahkan brand khusus jika diperlukan
        // if (!in_array('MOBILE LEGENDS', $brands)) {
        //     array_push($brands, 'MOBILE LEGENDS');
        // }
    } else {
        // Fallback jika API tidak merespon
        $brands = [
            'MOBILE LEGENDS',
            'FREE FIRE',
            'PUBG MOBILE',
            'TELKOMSEL',
            'XL',
            'INDOSAT',
            'SMARTFREN',
            'AXIS'
        ];
        
        log_message('error', 'Gagal mendapatkan data brand dari API Digiflazz');
    }
    
    $data = array_merge($this->base_data,[
        'title' => 'Export Produk Digiflazz',
        'brands' => $brands,
        'total_brands' => count($brands)
    ]);
    
    return view('Admin/Getproduk/index', $data);
}
}