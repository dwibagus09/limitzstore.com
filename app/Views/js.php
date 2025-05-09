		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script src="<?= base_url(); ?>/assets/js/swiper-bundle.min.js"></script>

        <?php if (session('success')): ?>
        <script>
        	Swal.fire('Berhasil', '<?= session('success'); ?>', 'success');
        </script>
        <?php endif ?>

        <?php if (session('error')): ?>
        <script>
        	Swal.fire('Terjadi Kesalahan', '<?= session('error'); ?>', 'error');
        </script>
        <?php endif ?>

        <?php if ($admin !== false): ?>
        <script>
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
        <?php endif ?>

        <?php if ($users !== false): ?>
        <script>
            function logout() {
                Swal.fire({
                    title: 'Anda yakin?',
                    text: 'Anda akan logoutdari akun',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= base_url(); ?>/logout';
                    }
                });
            }
        </script>
        <?php endif ?>

        <script>
            
            function salin(text, label_text) {

                navigator.clipboard.writeText(text);

                Swal.fire('Berhasil', label_text, 'success');
            }
            function rupiah(angka, prefix){
                angka = angka.toFixed(0);
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
                
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
     
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
        </script>

        <?php $this->renderSection('js'); ?>
        