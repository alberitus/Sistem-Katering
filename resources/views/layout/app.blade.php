<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('import/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('import/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('import/assets/css/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/select2/select2-bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Custom styles -->
    <link href="{{ asset('import/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('import/assets/css/loader.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <div id="loading-overlay">
        <div class="loader"></div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layout.sidebar')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layout.topbar')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log out from the application?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Click "<strong>Logout</strong>" below if you are sure you want to end the current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>        
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('import/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('import/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('import/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- datatables -->
    <script src="{{ asset('import/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('import/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('import/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('import/assets/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('import/assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('import/assets/js/sweetalert2/sweetalert2.min.js') }}"></script>  
    <script src="{{ asset('import/assets/js/search.js') }}"></script>  

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const overlay = document.getElementById('loading-overlay');
            let ajaxCount = 0;
    
            function showLoading() {
                overlay.style.display = 'flex';
            }
    
            function hideLoading() {
                if (ajaxCount <= 0) {
                    overlay.style.display = 'none';
                }
            }
    
            // Tampilkan saat submit form
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function () {
                    showLoading();
                });
            });
    
            // Tampilkan saat AJAX mulai
            $(document).ajaxStart(function () {
                ajaxCount++;
                showLoading();
            });
    
            // Sembunyikan saat AJAX selesai
            $(document).ajaxStop(function () {
                ajaxCount--;
                setTimeout(() => {
                    hideLoading();
                }, 500); // Minimum tampil 500ms
            });
    
            // Saat seluruh halaman dan resource selesai dimuat
            window.onload = function () {
                setTimeout(hideLoading, 300); // Biar tidak terlalu cepat hilang
            };
    
            // Kasus khusus: PDF
            if (window.location.href.endsWith('.pdf')) {
                setTimeout(hideLoading, 800);
            }
        });
    </script>
    

    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: @json(session('success')),
            timer: 4000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: @json(session('error')),
            timer: 4000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
        });
    </script>
    @endif
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            timer: 4000,
            timerProgressBar: true,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
        });
    </script>
    @endif

    <script>
        $(document).ready(function () {
            $('.select2').each(function () {
                const $this = $(this);
                const parentModal = $this.closest('.modal');
                const isMultiple = $this.hasClass('multiple');

                $this.select2({
                    dropdownParent: parentModal.length ? parentModal : $('body'),
                    placeholder: $(this).data('placeholder') || 'Select an option',
                    width: '100%',
                    theme: 'bootstrap',
                    allowClear: false,
                    dropdownAutoWidth: true,
                    dropdownCssClass: isMultiple ? 'multi-column' : ''
                });
            });

            $(document).on('select2:open', function () {
                let searchField = document.querySelector('.select2-container--open .select2-search__field');
                if (searchField) {
                    searchField.focus();
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus Data!',
                    cancelButtonText: 'Kembali'
                }).then((result) => {
                    if (result.isConfirmed) {
                        button.closest('form').submit();
                    }
                });
            });
        });
    </script>
</body>

</html>