<?php

namespace app\requests;

use app\database\models\User;

class UserValidation
{
    private $password, $password_confirmation, $email, $phone;


    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password_confirmation
     */
    public function getPassword_confirmation()
    {
        return $this->password_confirmation;
    }

    /**
     * Set the value of password_confirmation
     *
     * @return  self
     */
    public function setPassword_confirmation($password_confirmation)
    {
        $this->password_confirmation = $password_confirmation;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    //validation functions

    #password
    public function passIsRequired()
    {
        $errors = [];
        if (empty($this->password)) {
            $errors['pasword-required'] = "Your Password is required";
        }
        return $errors;
    }
    public function passConfirmationIsRequired()
    {
        $errors = [];
        if (empty($this->password_confirmation)) {
            $errors['password_confirmation-required'] = "Password confrimation is required";
        }
        return $errors;
    }

    public function passIsSimilarPasswordCnfirmation()
    {
        $errors = [];
        if ($this->password != $this->password_confirmation) {
            $errors['pasword-confirmed'] = "Password dosen't match password confirmation";
        }
        return $errors;
    }

    public function passMatchRegex()
    {
        $errors = [];
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/', $this->password)) {
            $errors["pasword-regex"] = "Password Minimum eight and maximum 20 characters, at least one uppercase letter, one lowercase letter, one number and one special character";
        }
        return $errors;
    }

    #email
    public function emailIsRequired()
    {
        $errors = [];
        if (empty($this->email)) {
            $errors["email-required"] = "Your email is required";
        }
        return $errors;
    }
    public function emailMatchRegex()
    {
        $errors = [];
        if (!preg_match('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/', $this->email)) {
            $errors["email-regex"] = "Your mail doesn't match the regular expression";
        }
        return $errors;
    }

    public function emailIsUnique()
    {
        $errors = [];
        $user = new User;
        $user->setEmail($this->email);
        $result = $user->getUserByEmail();
        if ($result->num_rows == 1) {
            $errors['email-unique'] = "Email Already Exists";
        }
        return $errors;
    }

    #phone
    public function phoneValidation()
    {
        $errors = [];
        if (empty($this->phone)) {
            $errors['phone-required'] = "Your Phone is required";
        }

        if (empty($errors)) {
            if (!preg_match('/01[0-2,5]{1}[0-9]{8}$/', $this->phone)) {
                $errors['phone-regex'] = "Phone is invalid";
            }
            if (empty($errors)) {
                $user = new User;
                $user->setPhone($this->phone);

                $result = $user->getUserByPhone();
                if ($result->num_rows == 1) {
                    $errors['phone-unique'] = "Existed phone number";
                }
            }
        }
        return $errors;
    }
}
