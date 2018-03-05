var basepath = "http://localhost/php";
var oTable;
var url = basepath+"/admin/get_users.php";
$(document).ready(function() {
    oTable = $('.user_datab').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": url,
        "deferRender": true,
        responsive: true,
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
        "order": [[ 0, "desc" ]],
        "sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
        "oLanguage": {
            "sSearch": "<span>Filter:</span> _INPUT_",
            "sLengthMenu": "<span>Show:</span> _MENU_",
            "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
        }
    });

    var oTable2 = $('.student_datab').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": basepath+"/admin/get_student.php",
        "deferRender": true,
        responsive: true,
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
        "order": [[ 0, "desc" ]],
        "sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
        "oLanguage": {
            "sSearch": "<span>Filter:</span> _INPUT_",
            "sLengthMenu": "<span>Show:</span> _MENU_",
            "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
        }
    });

    var oTable3 = $('.payments_datab').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": basepath+"/admin/get_payments.php",
        "deferRender": true,
        responsive: true,
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
        "order": [[ 0, "desc" ]],
        "sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
        "oLanguage": {
            "sSearch": "<span>Filter:</span> _INPUT_",
            "sLengthMenu": "<span>Show:</span> _MENU_",
            "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
        }
    });


    var oTable4 = $('.parents_datab').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": basepath+"/admin/get_parents.php",
        "deferRender": true,
        responsive: true,
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "All"]],
        "order": [[ 0, "desc" ]],
        "sDom": '<"datatable-header"Tfl><"datatable-scroll"t><"datatable-footer"ip>',
        "oLanguage": {
            "sSearch": "<span>Filter:</span> _INPUT_",
            "sLengthMenu": "<span>Show:</span> _MENU_",
            "oPaginate": { "sFirst": "First", "sLast": "Last", "sNext": ">", "sPrevious": "<" }
        }
    });


} );

var getMonthName = function (v) {
    var n = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return n[v]
};