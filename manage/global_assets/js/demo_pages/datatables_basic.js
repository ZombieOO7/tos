/* ------------------------------------------------------------------------------
*
*  # Basic datatables
*
*  Demo JS code for datatable_basic.html page
*
* ---------------------------------------------------------------------------- */

document.addEventListener('DOMContentLoaded', function() {


    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        columnDefs: [{ 
            orderable: false,
            width: '100px',
            /*targets: [ 5 ]*/
        }],
        dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;' }
        },
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function() {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });


    // Basic datatable
    $('.datatable-basic').DataTable({
        "order":[ 0, 'desc' ],
        //autoWidth: false,
        //scrollX:300,
    });

      // Basic datatable
    $('.datatable-uo').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
        autoWidth: true,
        scrollX:true,
    });


     // Left and right fixed columns
    $('.datatable-fixed-both').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
        autoWidth: false,
        scrollX: true,
        scrollY: '450px',
        scrollCollapse: true,
        fixedColumns: {
            leftColumns: 1,
            rightColumns: 1
        }
    });



     // Basic datatable
    $('.datatable-basic-uo').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
      /*  autoWidth: true,
        scrollX:true,*/
    });

  // Basic datatable
    $('.datatable-small').DataTable({
        "order":[ 0, 'desc' ],
    });

     $('.datatable-small-uo').DataTable({
        order: [],
        columnDefs: [ { orderable: false, targets: [0] } ],
    });

    // Alternative pagination
    $('.datatable-pagination').DataTable({
        pagingType: "simple",
        language: {
            paginate: {'next': $('html').attr('dir') == 'rtl' ? 'Next &larr;' : 'Next &rarr;', 'previous': $('html').attr('dir') == 'rtl' ? '&rarr; Prev' : '&larr; Prev'}
        }
    });


    // Datatable with saving state
    $('.datatable-save-state').DataTable({
        stateSave: true
    });


    // Scrollable datatable
    var table = $('.datatable-scroll-y').DataTable({
        autoWidth: true,
        scrollY: 300
    });

    // Resize scrollable table when sidebar width changes
    $('.sidebar-control').on('click', function() {
        table.columns.adjust().draw();
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });
    
});
