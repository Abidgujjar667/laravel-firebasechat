<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.5') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/editor/css/editor.bootstrap4.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Manage Users</h2>
    <div class="d-flex justify-content-end">
        <div style="text-align: right;" class="btn-group mb-3" id="dtButtons" role="group" aria-label="Button group with nested dropdown">
        </div>
    </div>
    <table id="kt_datatable" class="table text-center table-bordered yajra-datatable " style="width: 100%;">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js?v=7.0.5') }}"></script>

<script src="{{ asset('assets/js/scripts.bundle.js?v=7.0.5') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.5') }}"></script>
<script src="{{ url('/assets/editor/js/dataTables.editor.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/editor/js/editor.bootstrap4.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/select2custom.js') }}"></script>


<script type="text/javascript">
    var HOST_URL=window.location.origin+'/';
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tableEditor= new $.fn.dataTable.Editor({
            ajax: "/manage/create",
            table: "#kt_datatable",
            display: "bootstrap",
            idSrc:'id',
            keys:true,
            fields: [
                {label: "Name :", name: "name"},
                {label: "Email :", name: "email"},
                {label: "Password :", name: "password"},
                {label: "image :", name: "image",
                    type:'upload',
                    display: function (file_id) {
                        return '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>';
                    },
                    clearText:'clear',
                    noImageText:'No Image'
                },
                {   label: "Status :",
                    name: "status",
                    type: 'select2',
                    options:[
                        { label: "Active", value: 1 },
                        { label: "Inactive", value: 0 },
                    ]
                },

            ],

        });
        $('#kt_datatable').on('click', 'tbody td:not(:first-child)', function (e) {
            tableEditor.inline( this ,{
                onBlur: 'submit',
                scope:'cell',
                /*buttons: { label: '&gt;', fn: function () { this.submit(); } }*/
            });
        });
        var table = $('#kt_datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            dom: 'Bfltip',
            ajax: "{{ url('/manage/fetch') }}",
            columns: [
                {data:'DT_RowIndex', name:'DT_RowIndex'},

                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},

                {data: 'image', name: 'image',
                    render: function ( file_id ) {
                        return file_id ?
                            '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>' :
                            null;
                    },
                    defaultContent: "No image",
                    title: "Image"
                },
                {data:'status', name:'status'}


            ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            buttons: [
                /*{ extend: "create", editor: tableEditor ,className:'btn btn-outline-success font-weight-bold'},*/
                { extend: "edit",   editor: tableEditor ,className:'btn btn-outline-warning font-weight-bold'},
                { extend: "remove", editor: tableEditor ,className:'btn btn-outline-danger font-weight-bold'},

            ]
        });
        table.buttons( 0, null ).containers().appendTo( '#dtButtons' );

    });

    //edit


</script>
</html>