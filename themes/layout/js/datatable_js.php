<script src="{THEMES_PAGE}/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{THEMES_PAGE}/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    var oTable = $('#example1').DataTable( {
        "contentType": "application/json",
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        "ajax": {
            "url": "{REQUEST_AJAX_LIST}",
            "type": "POST"
        },
        
        "columns": [
            {DATA_TABLE}
        ]
    } );  
</script>