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
    <div class="container">
        <form action="" method="post" id ="form">
			<div class="form-group">
				<label>Enter Name Please:</label>
				<input type="text" name="name1" class="form-control" value="<?= esc($string); ?>">
			</div>			
        </form>
        <button onclick="save1()" class="button-info SaveButton" >insert</button>
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax": "<?php echo base_url(); ?>/apiforms/apiget",
                "columns" : [
                    {"data" :"name"}
                ]
            } );
        } );
        function save1()
        {
            var url1;
            url1 = "<?php echo base_url(); ?>/apiforms/insertapi";
            //alert($('#form').serialize());
            $.ajax({
                type: "POST",
                url: url1,
                data: $('#form').serialize(),
                success: function(){
                    //$('#userTable').html();
                    location.reload(true);
                }
            });
        }
    </script>
</body>
</html>