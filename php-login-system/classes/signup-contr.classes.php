<?php

class SignupContr extends Signup
{

    /* This variables are properties of the class
    and they are not the same with properties in constructor
     */
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    /* This data is data that will we grab from the user */
    public function __construct($uid, $pwd, $pwdRepeat, $email)
    {
        /* And how we must say with that $this properties of the class
        are = equal with this data that we are grabbing from the user
         */
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
    }

    /* Checking for signupUser*/
    public function signupUser()
    {

        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if ($this->invalidUid() == false) {
            // echo "Invalid username!";
            header("location: ../index.php?error=username");
            exit();
        }

        if ($this->invalidEmail() == false) {
            // echo "Invalid email!";
            header("location: ../index.php?error=email");
            exit();
        }

        if ($this->pwdMatch() == false) {
            // echo "Password don't match!";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        if ($this->uidTakenCheck() == false) {
            // echo "Username or email taken!";
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    /* Checking if we had an empty input */
    private function emptyInput()
    {
        $result;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    /* Checking if we had an invalid input */
    private function invalidUid()
    {
        $result;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    /* Checking if we have valid email */
    private function invalidEmail()
    {
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    /* Checking if password is matching */
    private function pwdMatch()
    {
        $result;
        if ($this->pwd !== $this->pwdRepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        $result;
        if (!$this->checkUser($this->uid, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
