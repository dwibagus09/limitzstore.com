<?php

namespace App\Controllers;

class Tokogar extends BaseController
{
    private $apiUrl = 'https://api.limitzstore.com/v2/tokogar-variants';
    private $apiKey;
    public $M_Base;

    public function __construct()
    {
        $this->M_Base = new \App\Models\M_Base();
        $this->apiKey = $this->M_Base->u_get('api_tokogar');
        
        if (empty($this->apiKey)) {
            throw new \RuntimeException('Tokogar API key not configured');
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

    private function exportToExcel($products, $searchTerm = '') {
    if (empty($products)) {
        die('No product data available for export');
    }

    $fileName = 'tokogar_products_' . ($searchTerm ? strtolower($searchTerm) . '_' : '') . date('YmdHis') . '.xlsx';
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header
    $headers = [
        'No', 'ID', 'Product Name', 
        'Public Price', 'Silver Price', 
        'Gold Price', 'Platinum Price'
    ];
    $sheet->fromArray($headers, null, 'A1');

    // Data
    $row = 2;
    foreach ($products as $index => $product) {
        $sheet->setCellValue('A' . $row, $index + 1);
        $sheet->setCellValue('B' . $row, $product['id'] ?? 'N/A');
        $sheet->setCellValue('C' . $row, $product['name'] ?? 'N/A');
        $sheet->setCellValue('D' . $row, $product['harga_public'] ?? 0);
        $sheet->setCellValue('E' . $row, $product['harga_silver'] ?? 0);
        $sheet->setCellValue('F' . $row, $product['harga_gold'] ?? 0);
        $sheet->setCellValue('G' . $row, $product['harga_platinum'] ?? 0);
        
        $row++;
    }

    // Styling
    $this->applySheetStyle($sheet, count($products) + 1); // +1 for header row

    // Output
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Cache-Control: max-age=0');
    
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
}

private function applySheetStyle($sheet, $lastRow) {
    // Header styling
    $sheet->getStyle('A1:G1')->applyFromArray([
        'font' => ['bold' => true],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['argb' => 'FFD9D9D9']
        ]
    ]);
    
    // Format numbers for price columns
    $sheet->getStyle('D2:G' . $lastRow)
        ->getNumberFormat()
        ->setFormatCode('#,##0');
    
    // Auto size columns
    foreach (range('A', 'G') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }
    
    // Border for all data
    $sheet->getStyle('A1:G' . $lastRow)->applyFromArray([
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
            ]
        ]
    ]);
}

// In your getProducts function (the part that calls the export)
public function getProducts($brand = null)
{
    // Gunakan parameter atau query ?brand=
    $search = $brand ?? $this->request->getGet('brand');
    $products = $this->getProduk($search);

    // Sorting harga_public jika ada sort
    $sort = $this->request->getGet('sort');
    if ($sort === 'asc') {
    usort($products, function($a, $b) {
        return $a['harga_public'] <=> $b['harga_public'];
    });
    } elseif ($sort === 'desc') {
        usort($products, function($a, $b) {
            return $b['harga_public'] <=> $a['harga_public'];
        });
    }


    // Export Excel jika diminta
    if ($this->request->getGet('export') === 'excel') {
        return $this->exportToExcel($products, $search);
    }

    return $this->formatResponse($products);
}



// The getProduk function with search functionality
private function getProduk($search = null)
{
    $client = \Config\Services::curlrequest();
    
    try {
        $response = $client->get($this->apiUrl, [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey
            ],
            'timeout' => 30
        ]);

        $result = json_decode($response->getBody(), true);

        if ($response->getStatusCode() !== 200 || !isset($result['success'])) {
            log_message('error', 'Tokogar API Error: ' . ($result['message'] ?? 'Unknown error'));
            return [];
        }

        $products = $result['data'] ?? [];

        // Filter berdasarkan name (dari form brand)
        if ($search) {
            $searchLower = strtolower($search);
            $products = array_filter($products, function ($product) use ($searchLower) {
                return strpos(strtolower($product['name']), $searchLower) !== false;
            });
        }

        return array_values($products);

    } catch (\Exception $e) {
        log_message('error', 'Tokogar API Exception: ' . $e->getMessage());
        return [];
    }
}
}