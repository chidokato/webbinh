<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{asset('')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="admin_asset/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="admin_asset/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- zoom -->
    <link href="admin_asset/zoom/zoom.css" rel="stylesheet">
    <!-- select2 multiple css -->
    <link href="admin_asset/select2/css/select2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        @include('admin.layout.navbar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <div class="container-fluid">
                    @yield('content')
                </div>
                @include('admin.layout.footer')
            </div>
        </div>
        
    </div>
    <!-- Footer -->
            
            <!-- End of Footer -->

            <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace ('ckeditor' ,{
            filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
        });
        
        @for ($i = 1; $i <= 10; $i++)
            CKEDITOR.replace ('ckeditor{{$i}}' ,{
                filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
                filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
            });
        @endfor
        
    </script>
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- <script src="admin_asset/jquery/jquery.min.js"></script> -->
    <script src="admin_asset/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="admin_asset/jquery-easing/jquery.easing.min.js"></script>
    <script src="admin_asset/js/sb-admin-2.min.js"></script>
    <script src="admin_asset/js/pages/crud/file-upload/image-inpute3c3.js?v=7.2.5"></script>

    
    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <!-- date -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <script type="text/javascript">
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
        });
        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
        });
    });
    </script>

    <!-- select2 multiple JavaScript -->
    <script src="admin_asset/select2/js/select2.min.js"></script>
    <script src="admin_asset/select2/js/select2-searchInputPlaceholder.js"></script>
    <script type="text/javascript">
        // $(document).ready(function() { $('.select2').select2({ placeholder: '...'}); });
        $(document).ready(function() { $('.select2').select2({ searchInputPlaceholder: 'Nhập từ khóa' }); });
    </script>

    <!-- zoom ảnh -->
    <script src="admin_asset/zoom/zoom.js"></script>
    <script src="admin_asset/js/js.js"></script>
    <!-- validate -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
    <script src="admin_asset/js/validate.js"></script>
</body>
</html>
