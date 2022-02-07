<?php
if ($_POST) {
    $color = "success";
    if($_POST['clicked'] == 'add'){
        $result = $_POST['num1'] +  $_POST['num2'];
    }else if($_POST['clicked'] == 'subtract'){
        $result = $_POST['num1'] -  $_POST['num2'];
    }else if($_POST['clicked'] == 'power'){
        $result = $_POST['num1'] **  $_POST['num2'];
    }else if($_POST['clicked'] == 'mod'){
        $result = $_POST['num1'] %  $_POST['num2'];
    }else if($_POST['clicked'] == 'divide'){
        $result = $_POST['num1'] /  $_POST['num2'];
    }else{
        $result = $_POST['num1'] *  $_POST['num2'];
    }
   
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Calculator</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="contianer">
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="text-center text-danger" style="font-size: 50px; margin-bottom: 30px;">
                    Calculator!!
                </h1>
            </div>
            <div class="col-4 offset-4">
                <form method="post">
                    <div class="form-group">
                        <input type="number" name="num1" id="num1" class="form-control" placeholder="Please Enter First Number" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="number" name="num2" id="num2" class="form-control" placeholder="Please Enter Second Number" aria-describedby="helpId">
                    </div>

                    <div class="col-md-12 text-center" style="margin-bottom: 30px;">
                        <button type="submit" name="clicked" value="add" class="btn btn-primary"style="width: 100px;">Add</button>
                        <button type="submit" name="clicked" value="subtract" class="btn btn-secondary"style="width: 100px;">Subtract</button>
                        <button type="submit" name="clicked" value="power" class="btn btn-warning"style="width: 100px;">Power</button>
                    </div>
                    <div class="col-md-12 text-center" style="margin-bottom: 30px;">
                        <button type="submit" name="clicked" value="multiply" class="btn btn-success" style="width: 100px;">Multiply</button>
                        <button type="submit" name="clicked" value="divide" class="btn btn-danger"style="width: 100px;">Divide</button>
                        <button type="submit" name="clicked" value="mod" class="btn btn-info"style="width: 100px;">Modulus</button>
                    </div>
                   
                </form>
                <?php
                if (isset($result)) {

                    echo "<div class='alert alert-$color'>The Result is : $result</div>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>