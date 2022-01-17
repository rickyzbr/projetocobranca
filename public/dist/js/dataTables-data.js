/*DataTable Init*/

"use strict"; 

$(document).ready(function() {
	$('#datable_11').DataTable({
		responsive: true,
		autoWidth: false,
		language: {
            url: 'http://cdn.datatables.net/plug-ins/1.10.25/i18n/Portuguese-Brasil.json'
        },
		initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	});

	$('#datable_1 thead th').each( function () {
        var title = $(this).text();
        $(this).html( '<input class="form-control form-control-sm mt-15" type="text" placeholder=" '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#datable_1').DataTable({
		responsive: true,
		pageLength: 25,
		autoWidth: false,
		"bPaginate": true,
		"ordering": false,
		"info":     true,
		"bFilter":     true,	
		"dom": 'lrtip',
		
		language: {
            url: '/dist/js/pt-br.json'
        },
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.header() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

    $('#list_1').DataTable({
		responsive: true,
		autoWidth: false,
        pageLength: 25,
		language: {
            url: '/dist/js/pt-br.json'
        }
    });


    $('#datable_2').DataTable({ 
		autoWidth: false,
		lengthChange: false,
		"bPaginate": false,
		language: { search: "",searchPlaceholder: "Search" }
	});
	
	/*Export DataTable*/
	$('#datable_3').DataTable( {
		dom: 'Bfrtip',
		responsive: true,
		language: { search: "",searchPlaceholder: "Search" },
		"bPaginate": false,
		"info":     false,
		"bFilter":     false,
		buttons: [
			'copy', 'csv', 'excel', 'pdf', 'print'
		],
		"drawCallback": function () {
			$('.dt-buttons > .btn').addClass('btn-outline-light btn-sm');
		}
	} );
	
	var table = $('#datable_5').DataTable({
		responsive: true,
		language: { 
		search: "" ,
		sLengthMenu: "_MENU_Items",
		},
		"bPaginate": false,
		"info":     false,
		"bFilter":     false,
		});
	$('#datable_5 tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );