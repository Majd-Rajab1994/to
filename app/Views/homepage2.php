<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
		<form action="" method="post" id ="form">
			<div class="form-group">
				<label>Enter Name Please:</label>
				<input type="text" name="name1" class="form-control" value="<?= esc($string); ?>">
			</div>			
        </form>
        <div class="form-group">
			<button onclick="save1()" class="button-info SaveButton" >insert</button>
		</div>
	</div>
	<div class="container mt-6" id="userTable">
		<table class="row mt-3 table table-striped">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col"> OP </th>
            </tr>
            <?php

                                                                            use CodeIgniter\Database\Database;

if($todolist): ?>
            <?php    foreach($todolist as $data): ?>
            <tr>
                <td><?php echo $data['id']; ?></td>
                <td><input type="text" id="todoname<?php echo $data['id'] ?>" value="<?php echo $data['name'] ?>"></td>
                <td>
                    <a href="" onclick="update1(<?php echo $data['id'] ?>)">edit</a>
                    <a href="" onclick="delete1(<?php echo $data['id'] ?>)">delete</a>
                </td>
            </tr>
                <?php endforeach; ?>
            <?php endif;?>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        $(".DeleteButton1").click(function(){
            alert("jhj");
        });

        function delete1(id)
        {
            var url1;
            url1 = "<?php echo base_url(); ?>/Home/delete";
            $.ajax({
                type: "POST",
                url: url1,
                data: {id1 : id},
                success: function(){
                    //$('#userTable').html();
                    location.reload(true);
                }
            });
            
        }
        function update1(id)
        {
            var name = document.getElementById("todoname"+id).value;
            var url1;
            url1 = "<?php echo base_url(); ?>/Home/update";
            $.ajax({
                type: "POST",
                url: url1,
                data: {id1 : id , name1 : name},
                success: function(){
                    location.reload(true);
                }
            });
        }

        function save1()
        {
            var url1;
            url1 = "<?php echo base_url(); ?>/Home/insert";
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