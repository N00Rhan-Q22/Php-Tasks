<?php

use app\database\models\User;
use app\requests\UserValidation;

$title = "Login";
include_once "layouts/header.php";
include_once "layouts/nav.php";
include_once "layouts/bread_crumb.php";
include_once "app/middleware/guest.php";

define('Not_verified', 0);
define('blocked', 2);

if ($_POST) {

    $errors = [];
    $validation = new UserValidation();
    $validation->setEmail($_POST['email']);
    $errors['email'] = $validation->emailIsRequired();
    if (empty($errors['email'])) {
        $errors['email'] = $validation->emailMatchRegex();
    }
    $validation->setPassword($_POST['password']);
    $errors['password'] = $validation->passIsRequired();

    if (empty($errors['password']) && empty($errors['email']) && empty($errors['phone'])) {
        $user = new User;
        $user->setEmail($_POST['email']);
        $res = $user->getUserByEmail();

        if ($res->num_rows == 1) {
            $user = $res->fetch_object();
            if (password_verify($_POST['password'], $user->password)) {
                switch ($user->status) {
                    case 'Not_verified':
                        $_SESSION['email'] = $_POST['email'];
                        header('location:check-code.php');
                        die;
                    case 'blocked':
                        $errors['email']['blocked'] = "Currently This Email Is Blocked";
                    default:
                        if (isset($_POST['remember_me'])) {
                            $rememberToken = uniqid("", true);  //Generate a unique ID
                            $userObject->setRememberToken($rememberToken);
                            if ($userObject->updateRememberToken()) {
                                setcookie("remember_me", $rememberToken, time() + 86400, '/');
                            } else {
                                $rememberToken = uniqid("", true);
                                $userObject->setRememberToken($rememberToken);
                                $userObject->updateRememberToken();
                            }
                        }
                        $_SESSION['user'] = $user;
                        header('location:index.php');
                        die;
                }
            }
        } else {
            $errors['password']['wrong-password'] = " Your Credentials is not correct";
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
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="mail" name="email" placeholder="E-mail" value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>">
                                        <?php
                                        if (!empty($errors['email'])) {
                                            foreach ($errors['email'] as $error) {
                                                echo "<p class='text-danger'> {$error} </p>";
                                            }
                                        }
                                        ?>
                                        <input type="password" name="password" placeholder="Password">
                                        <?php
                                        if (!empty($errors['password'])) {
                                            foreach ($errors['password'] as $error) {
                                                echo "<p class='text-danger'> {$error} </p>";
                                            }
                                        }
                                        ?>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Remember me</label>
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                            <button type="submit"><span>Login</span></button>
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