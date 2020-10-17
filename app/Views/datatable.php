<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
            </tr>
        </tfoot>
    </table>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax": "<?php echo base_url(); ?>/Home/jsontest",
                "columns" : [
                    {"data" :"name"}
                ]
            } );
        } );
    </script>
</body>
</html>