<?php
//Nourhan@12345

$title = "Register";
include_once "layouts/header.php";
include_once "app/middleware/guest.php";
include_once "layouts/nav.php";
include_once "layouts/bread_crumb.php";

use app\database\models\User;
use app\mail\MailSending;
use app\requests\UserValidation;

if ($_POST) {
    //1-validation
    $errors = [];
    $validation = new UserValidation();
    $validation->setPassword($_POST['password']);
    $validation->setPassword_confirmation($_POST['confirmedPassword']);
    $errors['password'] = $validation->passIsRequired();
    if (empty($errors['password'])) {
        $errors['password'] = $validation->passConfirmationIsRequired();
        if (empty($errors['password'])) {
            $errors['password'] = $validation->passMatchRegex();
            if (empty($errors['password'])) {
                $errors['password'] = $validation->passIsSimilarPasswordCnfirmation();
            }
        }
    }

    $validation->setEmail($_POST['email']);
    $errors['email'] = $validation->emailIsRequired();
    if (empty($errors['email'])) {
        $errors['email'] = $validation->emailMatchRegex();
        if (empty($errors['email'])) {
            $errors['email'] = $validation->emailIsUnique();
        }
    }

    $validation->setPhone($_POST['phone']);
    $errors['phone'] = $validation->phoneValidation();

    //if all errors are empty => execute needed process
    if (empty($errors['password']) && empty($errors['email']) && empty($errors['phone'])) {
        $code = rand(10000, 99999); //generate random code of 5 no. to verfy  user
        $expirationDate = date('Y-m-m H:i:s', strtotime('+' . Expiration_Duration . 'seconds'));

        $newUser = new User;
        $newUser->setFirst_name($_POST['fName']);
        $newUser->setLast_name($_POST['lName']);
        $newUser->setEmail($_POST['email']);
        $newUser->setPhone($_POST['phone']);
        $newUser->setGender($_POST['gender']);
        $newUser->setPassword(bcrypt($_POST['password']));
        $newUser->setCode($code);
        $newUser->setCode_expired_at($expirationDate);
        $newUser->setPassword(bcrypt($_POST['password']));

        $result = $newUser->insert();
        if ($result) { //send code
            $body = " <div>
            <h5> Hello {$_POST['fName']} {$_POST['lName']} </h5> <p>Your Verification Code is: <b style='color:red'>$code</b> </p>
            <p>Note: It is valid for 2 min </p> </div>";
            $subject = 'Verfication code';
            $mail = new MailSending($_POST['email'], $subject,  $body);
            if ($mail->verficationCode()) {
                echo "sec";
                $_SESSION['email'] = $_POST['email'];
                header('location:check-code.php');
                die;
            }
        }
    }
}
?>

<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" required name="fName" placeholder="First Name" value="<?= isset($_POST['fName']) ? $_POST['fName'] : ''; ?>">
                                        <input type="text" required name="lName" placeholder="Last Name" value="<?= isset($_POST['lName']) ? $_POST['lName'] : ''; ?>">
                                        <input name="email" placeholder="Email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                                        <?php
                                        if (!empty($errors['email'])) {
                                            foreach ($errors['email'] as $error) {
                                                echo "<p class='text-danger'> {$error}</p>";
                                            }
                                        }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (isset($errors['password']['pasword-required'])) {
                                            echo "<p class='text-danger'>{$errors['password']['pasword-required']}</p>";
                                        }
                                        if (isset($errors['password']['pasword-regex'])) {
                                            echo "<p class='text-danger'> {$errors['password']['pasword-regex']}</p>";
                                        }
                                        if (isset($errors['password']['pasword-confirmed'])) {
                                            echo "<p class='text-danger'> {$errors['password']['pasword-confirmed']}</p>";
                                        }
                                        ?>
                                        <input type="password" name="confirmedPassword" placeholder="Confirm Password">
                                        <?php
                                        // isset($errors['password']['password_confirmation-required']) ? "<p class='text-danger'>{$errors['password']['password_confirmation-required']}</p>" : "";
                                        if (isset($errors['password']['password_confirmation-required'])) {
                                            echo  "<p class='text-danger'>{$errors['password']['password_confirmation-required']}</p>";
                                        }
                                        ?>
                                        <input name="phone" placeholder="Phone" type="number" value="<?= isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                                        <?php
                                        if (!empty($errors['phone'])) {
                                            foreach ($errors['phone'] as $error) {
                                                echo "<p class='text-danger'> {$error}</p>";
                                            }
                                        }
                                        ?>
                                        <select name="gender" class="form-control">
                                            <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'm') ? "selected" : '' ?> value="m">Male</option>
                                            <option <?= (isset($_POST['gender']) && $_POST['gender'] == 'f') ? 'selected' : '' ?> value="f">Female</option>
                                        </select>
                                        <br> <br>
                                        <div class="button-box">
                                            <button type="submit"><span>Register</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "layouts/footer.php";
include_once "layouts/scripts.php";
?>