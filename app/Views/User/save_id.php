        <?php $this->extend('template'); ?>
		
		<?php $this->section('css'); ?>
		<?php $this->endSection(); ?>
		
		<?php $this->section('content'); ?>
        <div class="eniv-content">
            <div class="container">
        		<div class="eniv-body">
        			<div class="row">
        				
                        <?= $this->Include('users'); ?>

        				<div class="col-md-9">
                        <div class="row justify-content-center">
                        	<div class="col-md-12">
                        		<div class="card">
                                    <div class="card-body pb-0 mb-4 d-flex align-items-center">
                                        <h1 class="card-title flex-grow-1"><?= $title; ?></h1>
                                        <form action="" method="POST" enctype="multipart/form-data" class="d-flex align-items-center flex-grow-1 me-3">
                                            <?= csrf_field(); ?> 
                                            <select class="form-control w-100" name="games">
                                                <option value="">Semua Games</option>
                                                <?php foreach ($games as $loop): ?>
                                                    <option value="<?= $loop['id']; ?>"><?= $loop['games']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gameModal">Tambah ID +</button>
                                    </div>
                                </div>

                        		<div class="table-responsive">
                                    <table class="table mb-0 border-top" id="datatable">
                                        <thead>
                                            <tr>
                                                <th>Label Akun</th>
                                                <th>Nama Game</th>
                                                <th>User ID</th>
                                                <th>Zone ID</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                        <?php if (empty($player)): ?>
                                            <!-- Jika data kosong -->
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <div class="no-data">
                                                        <img src="https://cdn-icons-png.flaticon.com/512/7466/7466140.png" height="50px" width="50px" alt="No Data" class="no-data-img" />
                                                        <p class="no-data-text">Data ID Belum Ada</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <!-- Jika ada data -->
                                            <?php foreach ($player as $players): ?>
                                                <tr>
                                                    <td><?= $players['label_akun']; ?></td>
                                                    <td><?= $players['games']; ?></td>
                                                    <td><?= $players['game_id']; ?></td>
                                                    <td><?= $players['zone_id'] ?? 'Tidak Ada'; ?></td>
                                                    <td>
                                                        <!-- Tombol Edit
                                                        <button class="btn btn-sm btn-warning" onclick="editData(<?= $players['id']; ?>)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                                <path d="M12.854.146a.5.5 0 0 1 .11.638l-.057.07-11 11-.003.003-.003.003a.5.5 0 0 1-.161.106l-.07.034-.084.03-.108.025-.124.018H1.5a.5.5 0 0 1-.492-.41L1 12.5v-.378l.005-.064.018-.124.025-.108.03-.084.034-.07a.5.5 0 0 1 .106-.161l.003-.003.003-.003 11-11 .07-.057a.5.5 0 0 1 .638.057zm-3.5 4.707L5.5 8.707 7.293 10.5 9.5 8.293 7.293 6.5l-1.939 1.94-1.54-.94L7.353 3.353l2 2z"/>
                                                            </svg>
                                                        </button> -->
                                                    
                                                        <!-- Tombol Hapus -->
                                                        <button class="btn btn-sm btn-danger" onclick="hapus('<?= base_url(); ?>/user/delete_data_player/<?= $players['id']; ?>');">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                <path d="M2.5 1a1 1 0 0 1 1-1h9a1 1 0 0 1 1 1v1H2.5V1zM2 4v9a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4H2zm1 0h10v9a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V4zm2 0h6v9H5V4z"/>
                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                    </table>
                                    </div>
                        		</div>
                        		
                        	</div>
                        </div>
                        
                        
                        <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="gameModalLabel">Tambah ID</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url('/user/save_id_player'); ?>" method="POST">
                                                <div class="modal-body">
                                                    <?= csrf_field(); ?>
                                                    <div class="mb-3">
                                                        <img id="gameBanner" src="" alt="Banner Game" class="img-fluid mb-3" style="display:none;"><br>
                                                        <label for="gameSelect" class="form-label">Pilih Game</label>
                                                        <select class="form-control" id="gameSelect" name="games" required>
                                                            <option value="">Pilih Game</option>
                                                            <?php foreach ($target as $loop): ?>
                                                                <option value="<?= $loop['target']; ?>"><?= $loop['target']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                      <div class="input-group" style="margin-bottom:8px;">
                                                        <span class="input-group-text left">Label</span>
                                                        <input type="text" class="form-control games-input target-input" name="label" autocomplete="off" value="">
                                                    </div>
                                                    <div id="dynamicFields"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="checkAccountBtn" class="btn btn-warning">Cek Akun</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
        				</div>
        			</div>
        		</div>
            </div>
        </div>
		<?php $this->endSection(); ?>
		
		<?php $this->section('js'); ?>
		<script>
		
		 $('#gameSelect').change(function() {
            var gameName = $(this).val(); 

            if (gameName) {
                $.ajax({
                    url: '<?= base_url(); ?>/user/get-banner', 
                    type: 'GET',
                    data: { game: gameName }, 
                    success: function(response) {
                        if (response.banner) {
                            $('#gameBanner').attr('src', response.banner); 
                            $('#gameBanner').show(); 
                        } else {
                            $('#gameBanner').hide(); 
                        }
                    }
                });
            } else {
                $('#gameBanner').hide(); 
            }
        });
		
		
       document.addEventListener('DOMContentLoaded', function () {
    const gameSelect = document.getElementById('gameSelect');
    const dynamicFields = document.getElementById('dynamicFields');
    
    // Ketika game dipilih dari dropdown
    gameSelect.addEventListener('change', async function () {
        const selectedGame = gameSelect.value;
        const baseUrl = "<?= base_url(); ?>"; // Pastikan baseUrl sudah benar
        
        dynamicFields.innerHTML = ''; // Bersihkan dynamicFields sebelum menambah elemen baru
        
        if (selectedGame) {
            try {
                // Kirim permintaan ke server untuk mendapatkan kolom data
                const response = await fetch(`${baseUrl}/user/getTargetFields?games=${selectedGame}`);
                const gameData = await response.json();
                
                // Periksa apakah ada data yang valid
                if (gameData && gameData[0] && gameData[0].col) {
                    const columns = JSON.parse(gameData[0].col); // Pastikan kolom di-decode dengan benar
                    
                    // Loop untuk menambahkan elemen input atau select
                    columns.forEach(function (loop) {
                        const div = document.createElement('div');
                        div.classList.add('mb-2');
                        
                        if (loop.col_type === 'input') {
                            // Membuat input field berdasarkan data 'input'
                            div.innerHTML = `
                                <div class="input-group">
                                    <span class="input-group-text left">${loop.title}</span>
                                    <input type="${loop.type}" class="form-control games-input target-input" name="target[]" autocomplete="off" value="">
                                </div>
                            `;
                        } else if (loop.col_type === 'select') {
                            // Membuat dropdown (select) field berdasarkan data 'select'
                            div.innerHTML = `
                                <div class="input-group">
                                    <span class="input-group-text left">${loop.title}</span>
                                    <select class="form-control games-input target-input" name="target[]">
                                        ${loop.option.split("\n").map(option => {
                                            const [value, label] = option.split('|');
                                            return `<option value="${value}">${label}</option>`;
                                        }).join('')}
                                    </select>
                                </div>
                            `;
                        }

                        // Tambahkan div ke dalam dynamicFields
                        dynamicFields.appendChild(div);
                    });
                } else {
                    console.error('Kolom data tidak ditemukan');
                }
            } catch (error) {
                console.error('Error fetching game data:', error);
                alert('Gagal memuat data game. Coba lagi nanti.');
            }
        }
    });
});


        
        //ini untuk check akun    
          document.addEventListener('DOMContentLoaded', function () {
            const checkAccountBtn = document.getElementById('checkAccountBtn');
            const gameSelect = document.getElementById('gameSelect');
            const dynamicFields = document.getElementById('dynamicFields');
        
            checkAccountBtn.addEventListener('click', async function () {
                // Ambil semua input dengan name="target[]" setelah dimasukkan ke DOM
                const targetInputs = document.querySelectorAll('input[name="target[]"], select[name="target[]"]');
                
                // Ambil data game dan ID dari input
                const selectedGame = gameSelect.value;
                const userId = targetInputs[0]?.value; // Input pertama untuk User ID
                const zoneId = targetInputs[1]?.value; // Input kedua untuk Zone ID
        
                console.log('User ID:', userId);
                console.log('Zone ID:', zoneId);
                
                // Pastikan elemen input ditemukan
                if (targetInputs.length < 2) {
                    alert('Masukkan User ID dan Zone ID terlebih dahulu.');
                    return;
                }
        
                // Validasi input
                if (!userId || !selectedGame ) {
                    alert('Pilih game dan masukkan User ID terlebih dahulu.');
                    return;
                }

        try {
            const slug = await getSlugForGame(selectedGame);

            if (slug) {
                let apiUrl = `https://checknick.dimunaz-pedia.id/api/game/${slug}?id=${userId}`;
                if (zoneId) {
                    apiUrl += `&zone=${zoneId}`;
                }

                const response = await fetch(apiUrl);
                const result = await response.json();
                if (result.status) {
                   
                    Swal.fire({
                        title: 'Akun ditemukan',
                        text: `${result.message}`,
                        icon: 'success',
                        confirmButtonText: 'Tutup'
                    });
                    checkAccountBtn.style.display = 'none';
                } else {
                    Swal.fire({
                        title: 'Akun Tidak Ditemukan',
                        text: `${result.message}`,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            } else {
                Swal.fire({
                        title: 'Slug game tidak ditemukan.',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
            }
        } catch (error) {
            Swal.fire({
                        title: 'Terjadi kesalahan saat mengecek akun',
                        text : error,
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
        }
    });

    async function getSlugForGame(gameName) {
        try {
            const apiUrl = `https://checknick.dimunaz-pedia.id/`;

            const response = await fetch(apiUrl);
            const data = await response.json();

            const games = data.data;

            // Cari game berdasarkan nama
            const game = games.find(game => game.name.toLowerCase() === gameName.toLowerCase());

            if (game) {
                return game.slug;
            } else {
                console.error('Game tidak ditemukan:', gameName);
                return null;
            }
        } catch (error) {
            console.error('Error saat mendapatkan slug:', error);
            return null;
        }
    }
});

            
            function hapus(link) {

                Swal.fire({
                    title: 'Anda yakin?',
                    text: 'Data akan dihapus permanen',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Tetap Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    }
                });
            }
        </script>

		
		<?php $this->endSection(); ?>