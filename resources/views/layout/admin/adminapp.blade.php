<!DOCTYPE html>
<html>
<title>vaishnav Parichya : @yield('title')</title>
<link rel="icon" href="{{ asset('assets1\img\favicon.png') }}" type="image/x-icon">
<!-- Add this line for the favicon -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Vaishnav Parichya Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="{{ url('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ url('assets1/css/ready.css') }}">
    <link rel="stylesheet" href="{{ url('assets1/css/demo.css') }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- Include Line Icons CSS -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">

            @include('layout.admin.header');

            @include('layout.admin.sidebar');

            <div class="main-panel">

                @yield('content')

            </div>
            @include('layout.admin.footer');

        </div>
    </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePro"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title"><i class="la la-frown-o"></i> Under Development</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Currently the pro version of the <b>Ready Dashboard</b> Bootstrap is in progress development</p>
                    <p>
                        <b>We'll let you know when it's done</b>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>




<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
{{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> --}}
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
{{-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
{{-- <script src="{{url('assets1/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>


{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}




<script>
    $(document).ready(function() {
        $('#data-table').DataTable({
            responsive: true,
            autoWidth: true,
            paging: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                'pageLength',
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible:not(.print-hidden)'
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible:not(.print-hidden)'
                    }
                },
                {
                    extend: 'pdf', // Add PDF button
                    exportOptions: {
                        columns: ':visible:not(.print-hidden)'
                    }
                },
            ],
            columnDefs: [{
                targets: 'print-hidden',
                visible: false,
                orderable: false
            }]
        }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');
    });
</script>


</html>
