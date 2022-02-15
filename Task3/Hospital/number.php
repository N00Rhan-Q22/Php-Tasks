<?php
$title = 'Hospital Review';
$bkcolor="background-color: #B7D6E1;";
include_once 'layouts/header.php';

//validate prog. then run it
if ($_POST) {
    $errors = [];
    if (empty($_POST['phone'])) {
        $errors['phone-required'] =  "<div class='alert alert-danger'> Your Phone Is Required!!!! </div>";
    }

    if (empty($errors)) {
        $_SESSION['phone'] = $_POST['phone'];
        header("location:Review.php");
    }
}

?>

<div style="display: flex; justify-content: space-between; width: 80%; margin: 10px 50 px;">
    <aside>
        <img src="hospital_f.gif" alt="" style="width: 700px; height: 700px; border-radius: 150px;">
    </aside>
    <aside style="margin-top: 200px; width: 400px;">
        <h1>Help us and Fill The Next Survey</h1>

        <form method="POST">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Phone Number</span>
                </div>
                <input type="number" name="phone" id="phone" class="form-control" placeholder="Please Enter your number" aria-describedby="helpId">
            </div>

            <button type="submit" class="btn btn-danger">Go To Survey</button>
           <?php if(isset($errors['phone-required'])){
            echo $errors['phone-required'];
            }?>

        </form>
    </aside>
</div>
<?php
include_once "layouts/scripts.php";
?>