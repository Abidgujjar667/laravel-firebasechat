"use strict";
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function() {
		var table = $('#kt_datatable');

		// begin first table
	var newTable=	table.DataTable({
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
			ajax: HOST_URL + "/admin/users/view",


			columns: [

                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
				{data: 'firstname','name':'users.firstname'},
				{data: 'lastname'},
				{data: 'username'},
				{data: 'country'},
				{data: 'mobile'},
				{data: 'email'},
                {data: 'status'},
				/*{data: null,name:'users.firstname', responsivePriority: -1},*/
				{data: 'id', render: function(id) {
						return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" href="'+HOST_URL+'/admin/edituser/'+id+'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="'+HOST_URL+'/admin/unblockuser/'+id+'"><i class="nav-icon la la-leaf"></i><span class="nav-text">Unblock</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="'+HOST_URL+'/admin/userdetails/'+id+'"><i class="nav-icon las la-arrow-up"></i><span class="nav-text">Details</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
							<a href="'+HOST_URL+'/admin/edituser/'+id+'" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="'+HOST_URL+'/admin/deleteuser/'+id+'" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
							<a href="'+HOST_URL+'/admin/blockuser/'+id+'" class="btn btn-sm btn-clean btn-icon" title="Block">\
								<i class="la la-ban"></i>\
							</a>\
							<a href="'+HOST_URL+'/admin/userdetails/'+id+'" class="btn btn-sm btn-clean btn-icon" title="Details">\
								<i class="las la-arrow-up"></i>\
							</a>\
						';
					},
                },

                    ],
			columnDefs: [

                {'bSortable': false, 'aTargets': [0]},{'bSearchable': false, 'aTargets': [0]},
				{
					width: '75px',
					targets: -3,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Pending', 'class': 'label-light-primary'},
							2: {'title': 'Delivered', 'class': ' label-light-danger'},
							3: {'title': 'Canceled', 'class': ' label-light-primary'},
							4: {'title': 'Success', 'class': ' label-light-success'},
							5: {'title': 'Info', 'class': ' label-light-info'},
							6: {'title': 'Danger', 'class': ' label-light-danger'},
							7: {'title': 'Warning', 'class': ' label-light-warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},
				{
					width: '75px',
					targets: -2,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Online', 'state': 'danger'},
							2: {'title': 'Retail', 'state': 'primary'},
							3: {'title': 'Direct', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
							'<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});
        /*newTable.on( 'order.dt search.dt', function () {
            newTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();*/
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();
});
