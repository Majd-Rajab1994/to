<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            font-family: Arial;
            background: #e9ebee;
            font-size: 0.9em;
        }

        .post-wall {
            background: #FFF;
            border: #e0dfdf 1px solid;
            padding: 20px;
            border-radius: 5px;
            margin: 0 auto;
            width: 500px;
        }

        .post-item {
            padding: 10px;
            border: #f3f3f3 1px solid;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .post-title {
            color: #4faae6;
        }

        .ajax-loader {
            display: block;
            text-align: center;
        }
        .ajax-loader img {
            width: 50px;
            vertical-align: middle;
        }
    </style>
    
</head>
<body>
    <div class="post-wall">
        <div id="post-list">
            <input type="text" name="total_count" id="total_count" value="<?= $count ?>">
            <?php 
                if($array):
                    foreach($array as $posts):
                        ?>
                        <div class="post-item" id="<?= $posts['id'] ?>">
                            <p class="post-title"><?= $posts['title'] ?></p>
                            <p><?= $posts['content'] ?></p>
                        </div>
                        <?php
                    endforeach;
                endif;
            ?>
        </div>
        <div class="ajax-loader text-center">
                <img src="LoaderIcon.gif"> Loading more posts...
        </div>
    </div>
    
	
    <script>
        $(document).ready(function(){
            windowOnScroll();
        });

        function windowOnScroll() {
            $(window).on("scroll", function(e){
                if ($(window).scrollTop() == $(document).height() - $(window).height()){
                    if($(".post-item").length < <?= $count ?>) {
                        var lastId = $(".post-item:last").attr("id");
                        getMoreData(lastId);
                    }
                }
            });
        }

        function getMoreData(lastId) {
            $(window).off("scroll");
                $.ajax({
                    url: "<?php echo base_url() ?>/iscroll/getData",
                    type: "post",
                    data:{lid : lastId},
                    beforeSend: function ()
                    {
                        $('.ajax-loader').show();
                    },
                    success: function (data) {
                        setTimeout(function() {
                        $('.ajax-loader').hide();
                        $("#post-list").append(data);
                        windowOnScroll();
                        }, 1000);
                    }
                });
        }
    </script>
</body>
</html>