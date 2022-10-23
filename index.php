<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Read Log File</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<style>
    #input-file input{
        padding: 5px 0px;
    }
    #input-file a{
        margin-left: 20px;
    }

    .table,#input-file{
        margin-top: 50px !important;
    }
    nav,.table,#input-file{
        margin: auto;
        width: 50% !important;
    }
</style>

<body>


<div class="flex-container row" id="input-file">
    <input id="file-name" type="text" class="input-group-text col-md-4" placeholder="/path/to/file">
        <a class="btn btn-primary col-md-2" id="view-button">view</a>
</div>
<input type="hidden" id="page_number" value="0">
<table class="table">
    <tbody>

    </tbody>
</table>

<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" id="first-page" href="#" tabindex="-1">|<</a>
        </li>
        <li class="page-item"><a class="page-link" id="prev-page" href="#"><</a></li>
        <li class="page-item">
            <a class="page-link" id="next-page" href="#"> > </a>
        </li>

        <li class="page-item">
            <a class="page-link" id="last-page" href="#">>|</a>
        </li>
    </ul>
</nav>

<script>
    $("#first-page").click(function (){
        $("#page_number").val(0);
        let page_number= 0 ;
    });

    $("#next-page").click(function (){

        let page_number=  parseInt($("#page_number").val());
        $("#page_number").val(page_number + 1)
        getData(page_number + 1);
    })

    $("#prev-page").click(function (){
        let page_number= parseInt($("#page_number").val());
        $("#page_number").val(page_number - 1)
        getData(page_number - 1);
    })

    $("#last-page").click(function (){
        let page_number= -1;
        $("#page_number").val(page_number)
        getData(page_number);
    })

    $("#view-button").click(function(){

        let page_number= parseInt($("#page_number").val());

        getData(page_number);

    });

    function getData(page_number){
        debugger;
        let fileName = $("#file-name").val();
        $.ajax
        ({
            url: 'task.php',
            data: {"fileName": fileName,"page_number":page_number},
            dataType : 'json',
            type: 'post',
            success: function(result)
            {

                if (result == false){
                    $("table tbody").empty();
                    $("table  tbody").append('<tr><td>There is no Data for your choice</td></tr>');
                }
                else{
                    $("table tbody").empty();
                for(var key in result){
                    var value = result[key];
                    $("table  tbody").append('<tr><td>'+key+'</td><td>'+value+'</td></tr>');
                }
                }

            },

            error:function (error){

            }
        });
    }

</script>

</body>
</html>