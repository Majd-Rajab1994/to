<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
    <center>
        <select class="todoop" style="width: 50%;"></select>
    </center>
    
    <script>
        
        $(document).ready(function(){
            $(".sel2").select2({
                ajax: {
                    url: '<?= base_url() ?>/Home/gettodo',
                    //url:'https://api.github.com/search/repositories',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data, params) {
                        // parse the results into the format expected by Select2
                        // since we are using custom formatting functions we do not need to
                        // alter the remote JSON data, except to indicate that infinite
                        // scrolling can be used
                        //params.page = params.page || 1;

                        return {
                            results: data.name,
                            pagination: {
                            more: (params.page * 30) < data.total_count
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'Search for a repository',
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

            function formatRepo (repo) {
                if (repo.loading) {
                return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-name'></div>" +
                        "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-name").text(repo.name);

                return $container;
            }

            function formatRepoSelection (repo) {
                return repo.full_name || repo.text;
            }
        })





        $(document).ready(function(){

            $(".todoop").select2({
                ajax: { 
                    url: '<?= base_url() ?>/Home/gettodo',
                    //url: 'https://api.github.com/search/repositories',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.name
                            };
                            })
                        };
                    },
                    //processResults: function (data) {
                        //return {
                            //results: data
                        //};
                    //},
                    cache: true
                },
                placeholder: '-select-',
            });
        });



    </script>
</body>
</html>