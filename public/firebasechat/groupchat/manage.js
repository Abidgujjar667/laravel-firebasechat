//var HOST_URL=window.location.origin+'/';
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
            {label: "Image :", name: "image",
                type:'upload',
                display: function (file_id) {
                    return '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>';
                },
                clearText:'clear',
                noImageText:'No Image'
            },

            /*{   label: "Status :",
                name: "status",
                type: 'select2',
                options:[
                    { label: "Active", value: 1 },
                    { label: "Inactive", value: 0 },
                ]
            },*/
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
        ajax: "/manage/fetch",
        columns: [
            //{data: 'id', name: 'id'},
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name:'email'},

            {data: 'image', name: 'image',
                render: function ( file_id ) {
                    return file_id ?
                        '<img style="height: auto;width: 50px;" src="'+HOST_URL+file_id+'"/>' :
                        null;
                },
                defaultContent: "No image",
                title: "Image"
            },

            /*{data: 'status', name: 'status'},*/

        ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            /*{ extend: "create", editor: tableEditor ,className:'btn btn-outline-success font-weight-bold text-info'},*/
            { extend: "edit",   editor: tableEditor ,className:'btn btn-outline-warning font-weight-bold'},
            { extend: "remove", editor: tableEditor ,className:'btn btn-outline-danger font-weight-bold'},
            {
                extend: 'collection',
                text: 'Export',
                className:'btn btn-dark font-weight-bold dropdown-toggle',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    });
    table.buttons( 0, null ).containers().appendTo( '#dtButtons' );

});

//edit