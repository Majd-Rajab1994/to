<?php

use Config\Validation;
$validation =  \Config\Services::validation();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
        <div class="container">
            <?php if ($ch == false) {
                echo '<p>error username or password </p>';
            } ?>
            <form action="<?php echo base_url() ?>/Home/checkuser" method="post">
                <div class="form-group">
                    <label class="col-lg-2 col-form-label">name:</label>
                    <input type="text" name="username" value="" class="form-control1">
                </div>
                <div class="form-group">
                    <label class="col-lg-2 col-form-label">password:</label>
                    <input type="password" name="password" value="" class="form-control1">
                <div class="form-group">
                    <button type="submit" name="adduser" class="btn btn-primary">Singin</button>
                </div>
            </form>
            <a href="/signup">Signup </a> 
            <a href="/main">main(without sigin) </a> 
            <a href="/apiview">apiview(without sigin) </a> 
            <a href="/select2">select2 </a> 
            <div>
                <a href="/scroll">Infinite Scroll </a> 
            </div>
        </div>
</body>
</html>