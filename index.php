<?php
require_once "config.php";

$query = "SELECT * FROM `parameter`";
$result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
$result = json_encode($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>Zadanie5 SSE</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="text-center my-4">SSE</h1>
            <p id="realtime"></p>

            <form action="update.php" method="post">
                <div class="mb-3">
                    <label for="a" class="form-label">a parameter</label>
                    <input type="number" step="0.01" class="form-control" id="a" name="a" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="y1" name="y1" >
                    <label class="form-check-label" for="y1">Zahrnut y1</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="y2" name="y2">
                    <label class="form-check-label" for="y2">Zahrnut y2</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="y3" name="y3">
                    <label class="form-check-label" for="y3">Zahrnut y3</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<script>
    var results = <?php echo $result;?>;
    $("#a").val(results[0].a);
    if(results[0].y1 != 0){
        $("#y1").prop('checked', true);
    }
    if(results[0].y2 != 0){
        $("#y2").prop('checked', true);
    }
    if(results[0].y3 != 0){
        $("#y3").prop('checked', true);
    }

    var source = new EventSource("sse.php");
    source.addEventListener('data', (e) =>{
        $("#realtime").text(e.data);
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>