<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="container">
		<form action="#" method="post" id ="form">
			<div class="form-group">
				<label>Enter Name Please:</label>
				<input type="text" name="name1" class="form-control" value="<?= esc($string); ?>">
			</div>			
        </form>
        <div class="form-group">
			<button type="submit" value="insert" name="insert" class="button-info SaveButton" onclick="hh();">insert</button>
		</div>
	</div>
	<div class="container mt-6">
		<table class="row mt-3 table table-striped">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col"> OP </th>
            </tr>
            <?php if($todolist): ?>
            <?php    foreach($todolist as $val): ?>
            <tr>
                <td><?php echo $val['id']; ?></td>
                <td><?php echo $val['name']; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>/Home/updatepage/<?php echo $val['id'];?>/<?php echo $val['name']; ?>">edit</a>
                    <button type="submit" class="deletebutton" value="<?php echo $val['id'];?>">delete</button>
                </td>
            </tr>
                <?php endforeach; ?>
            <?php endif;?>
        </table>
    </div>

    
    

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script>

function hh(){
    return alert("kjlakf");
}

$(".deletebutton").click(function(){
    alert("The paragraph was clicked.");
});

function save1()
{
    alert("afadfa");
    var url1;
    url1 = "<?php echo base_url(); ?>/Home/insert";
    $.ajax({
        url = url1,
        type = "post",
        data = $('#form').serialize(),
        dataType: "JSON",
        success:function(data){
            location.reload();
        }

    });

}


</script>
<a class="button-info" onclick="hh()">insert</a>

</body>
</html>