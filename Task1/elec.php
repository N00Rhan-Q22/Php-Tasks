<?php
if ($_POST) {
    $color = "success";
    if ($_POST['unit'] <= 50) {
        $cost = $_POST['unit'] * 0.50;
        $cost+=($cost*0.2);
    } elseif ($_POST['unit'] > 50 && $_POST['unit'] <= 150) {
        $cost = $_POST['unit'] * 0.75;
        $cost+=($cost*0.2);
    } elseif ($_POST['unit'] > 150 && $_POST['unit'] <= 250) {
        $cost = $_POST['unit'] * 1.20;
        $cost+=($cost*0.2);
    } else {
        $cost = $_POST['unit'] * 1.50;
        $cost+=($cost*0.2);
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <title>Electricity</title>
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
                    Electricity Bill
                </h1>
            </div>
            <div class="col-4 offset-4">
                <form method="post">
                    <div class="form-group">
                        <input type="number" name="unit" id="unit" class="form-control" placeholder="Please Enter your Consumed electricity units" aria-describedby="helpId">
                    </div>

                    <div class="col-md-12 text-center">
                        <button class="btn btn-dark rounded" style="margin-bottom: 15px;"> View Bill </button>
                        <br>
                    </div>
                </form>
                <?php
                if (isset($cost)) {

                    echo "<div class='alert alert-$color'>You have to pay $cost <b>EGP</b> </div>";
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