$(document).ready( function () {
    $('#myTable_hide_sort').DataTable({
        'columnDefs':[{'orderable' : false, 'targets' : 0}],
        'aaSorting' : [[1, 'asc']]
    });
} );

$(document).ready( function () {
    $('#myTable').DataTable();
} );