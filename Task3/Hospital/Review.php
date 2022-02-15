<?php
$title = 'Survey';
include_once 'layouts/header.php';
if ($_POST) {
    $errors = [];

    for($i=1;$i<=5;$i++){
            if(empty($_POST['q'.$i])){
                $errors['requiredQuestion'] = "<div class='alert alert-danger'> All Answers are Required!!!! Please fill the missed one. </div>";
            }
        }

    if (empty($errors)) {
        $_SESSION['q1'] = $_POST['q1'];
        $_SESSION['q2'] = $_POST['q2'];
        $_SESSION['q3'] = $_POST['q3'];
        $_SESSION['q4'] = $_POST['q4'];
        $_SESSION['q5'] = $_POST['q5'];
        header("location:Result.php");
    }
}

?>

<h1  class="text-center text-secondary" > <strong>Hospital Survey</strong>   </h1>
<form method="POST" style="margin: 50px 100px;">
    <table class="col-12 table table-striped table-warning">
        <thead class="bg-warning">
            <th>#</th>
            <th>Question?</th>
            <th>Bad</th>
            <th>Good</th>
            <th>Very Good</th>
            <th>Excellent</th>
        </thead>
        <tbody>
            <tr>
                <td>1-</td>
                <td>Are you satisfied with the level of cleanliness?</td>
                <td><input type="radio" name="q1" value="Bad"></td>
                <td><input type="radio" name="q1" value="Good"></td>
                <td><input type="radio" name="q1" value="Very Good"></td>
                <td><input type="radio" name="q1" value="Excellent"></td>
            </tr>
            <tr>
                <td>2-</td>
                <td>Are you satisfied with the services prices?</td>
                <td><input type="radio" name="q2" value="Bad"></td>
                <td><input type="radio" name="q2" value="Good"></td>
                <td><input type="radio" name="q2" value="Very Good"></td>
                <td><input type="radio" name="q2" value="Excellent"></td>
            </tr>
            <tr>
                <td>3-</td>
                <td>Are you satisfied with the nursing service?</td>
                <td><input type="radio" name="q3" value="Bad"></td>
                <td><input type="radio" name="q3" value="Good"></td>
                <td><input type="radio" name="q3" value="Very Good"></td>
                <td><input type="radio" name="q3" value="Excellent"></td>
            </tr>
            <tr>
                <td>4-</td>
                <td>Are you satisfied with the level of the doctor?</td>
                <td><input type="radio" name="q4" value="Bad"></td>
                <td><input type="radio" name="q4" value="Good"></td>
                <td><input type="radio" name="q4" value="Very Good"></td>
                <td><input type="radio" name="q4" value="Excellent"></td>
            </tr>
            <tr>
                <td>5-</td>
                <td>Are you satisfied with the quietness in the hospital?</td>
                <td><input type="radio" name="q5" value="Bad"></td>
                <td><input type="radio" name="q5" value="Good"></td>
                <td><input type="radio" name="q5" value="Very Good"></td>
                <td><input type="radio" name="q5" value="Excellent"></td>
            </tr>

        </tbody>
    </table>
    <button type="submit" class="btn btn-danger col-12">Submit</button>
    

    <?php if (isset($errors['requiredQuestion'])) {
        echo $errors['requiredQuestion'];
    } ?>

</form>




<?php
include_once "layouts/scripts.php";
?>