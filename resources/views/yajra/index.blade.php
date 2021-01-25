<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css"/>
    <link href="{{ url('assets/editor/css/editor.bootstrap4.css') }}" rel="stylesheet" type="text/css">

</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Laravel 7 Yajra Datatables Editor Example</h2>
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
            <th>Username</th>
            <th>Phone</th>
            <th>DOB</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</body>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>--}}

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

<script src="{{ url('/assets/editor/js/dataTables.editor.js') }}" type="text/javascript"></script>
<script src="{{ url('/assets/editor/js/editor.bootstrap4.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    var HOST_URL=window.location.origin+'/';
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var tableEditor= new $.fn.dataTable.Editor({
            ajax: "/students",
            table: "#kt_datatable",
            display: "bootstrap",
            idSrc:'id',
            keys:true,
            fields: [
                {label: "Name :", name: "name"},
                {label: "email :", name: "email"},
                {label: "username :", name: "username"},
                {label: "phone :", name: "phone"},
                {label: "dob :", name: "dob",
                    type:'date',
                },
                {label: "image :", name: "image",
                    type:'upload',
                    display: function (file_id) {
                        return '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>';
                    },
                    clearText:'clear',
                    noImageText:'No Image'
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
            ajax: "{{ url('students') }}",
            columns: [
                {data: 'id', name: 'id'},

                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {data: 'phone', name: 'phone'},
                {data: 'dob', name: 'dob'},
                {data: 'image', name: 'image',
                    render: function ( file_id ) {
                        return file_id ?
                            '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>' :
                            null;
                    },
                    defaultContent: "No image",
                    title: "Image"
                },


            ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            buttons: [
                { extend: "create", editor: tableEditor ,className:'btn btn-outline-success font-weight-bold'},
                { extend: "edit",   editor: tableEditor ,className:'btn btn-outline-warning font-weight-bold'},
                { extend: "remove", editor: tableEditor ,className:'btn btn-outline-danger font-weight-bold'},

            ]
        });
        table.buttons( 0, null ).containers().appendTo( '#dtButtons' );

    });

    //edit


</script>
</html>