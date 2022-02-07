<?php
if ($_POST) {
    $color = "success";
    $Total = $_POST['Physics'] + $_POST['Chemistry'] + $_POST['Biology'] + $_POST['Mathematics'] + $_POST['Computer'];
    $percentage = $Total / 250 * 100;
    if ($percentage >= 90) {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is A ";
    } else if ($percentage < 90 && $percentage >= 80) {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is B ";
    } else if ($percentage < 80 && $percentage >= 70) {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is C ";
    } else if ($percentage < 70 && $percentage >= 60) {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is D ";
    } else if ($percentage < 60 && $percentage >= 40) {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is E";
    } else {
        $message = "Your Percentage is $percentage<b>%</b> <br> Your Grade is F ";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Grade</title>
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
                    "Calculate Your Grade"
                </h1>
            </div>
            <div class="col-4 offset-4">
                <form method="post">
                    <div class="form-group">
                        <input type="number" name="Physics" id="Physics" class="form-control" placeholder="Please Enter Physics Mark" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="number" name="Chemistry" id="Chemistry" class="form-control" placeholder="Please Enter Chemistry Mark" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="number" name="Biology" id="Biology" class="form-control" placeholder="Please Enter Biology Mark" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="number" name="Mathematics" id="Mathematics" class="form-control" placeholder="Please Enter Mathematics Mark " aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <input type="number" name="Computer" id="Computer" class="form-control" placeholder="Please Enter Computer Mark" aria-describedby="helpId">
                    </div>

                    <div class="col-md-12 text-center">
                        <button class="btn btn-dark rounded" style="margin-bottom: 15px;"> Calculate </button>
                        <br>
                    </div>
                </form>
                <?php
                if (isset($message)) {

                    echo "<div class='alert alert-$color'> $message </div>";
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