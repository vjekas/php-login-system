<?php

class LoginContr extends Login
{

    /* This variables are properties of the class
    and they are not the same with properties in constructor
     */
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    /* This data is data that will we grab from the user */
    public function __construct($uid, $pwd)
    {
        /* And how we must say with that $this properties of the class
        are = equal with this data that we are grabbing from the user
         */
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    /* Checking for signupUser*/
    public function loginUser()
    {

        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        $this->getUser($this->uid, $this->pwd);
    }

    /* Checking if we had an empty input */
    private function emptyInput()
    {
        $result;
        if (empty($this->uid) || empty($this->pwd)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
