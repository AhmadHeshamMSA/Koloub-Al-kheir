<?php

include_once 'AccountType.php';
include_once 'AccountStatus.php';
include_once 'Config.php';

class Account {

    private $database;
    public $id;
    public $username;
    public $password;
    public $email;
    public $createTime;
    public $phoneNumber;
    public $accountType = AccountType;
    public $accountStatus = AccountStatus;

 

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getCreateTime() {
        return $this->createTime;
    }

    function getPhoneNumber() {
        return $this->phoneNumber;
    }

    function getAccountType() {
        return $this->accountType;
    }

    function getAccountStatus() {
        return $this->accountStatus;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCreateTime($createTime) {
        $this->createTime = $createTime;
    }

    function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    function setAccountType($accountType) {
        $this->accountType = $accountType;
    }

    function setAccountStatus($accountStatus) {
        $this->accountStatus = $accountStatus;
    }

    function login($username, $password) {
        $this->connectToDB();
        $sql = "Select u.* , s.status_Name , acct.account_type  from users u"
                . " join status s ON u.statusID = s.status_ID "
                . " JOIN account_types acct on u.accountType= acct.type_id "
                . " where username= ? and password= ?";

        if ($stmt = $this->database->prepare($sql)) {
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = mysqli_stmt_get_result($stmt);
            //$stmt->store_result();

            while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                foreach ($row as $cname => $cvalue) {
                    $this->setId($row[4]);
                    $this->setUsername($row[0]);
                    $this->setEmail($row[1]);
                    $this->setCreateTime($row[3]);
                    $this->setPhoneNumber($row[7]);
                    $tempaccountType = new AccountType($row[6], $row[9]);
                    $this->setAccountType($tempaccountType);
                    $tempaccountStatus = new AccountStatus($row[5], $row[8]);
                    $this->setAccountStatus($tempaccountStatus);
                    //set session
                    $_SESSION['user'] = $this;
                    $stmt->close();
                    return $this;
                }
            }

            $stmt->close();
            // echo '<script>alert("Incorrect Username or Password")</script>';
            return null;
        } else {
            die("Error : Couldn't prepare sqli statement");
        }
        return null;
    }

    function chechLogin() {
        if (isset($_SESSION['LOGGED IN'])) {
            return true;
        } else {
            return false;
        }
    }

    function logout() {
        session_destroy();
        session_start();
    }

    function forgotPassword() {
        
    }

    function changePassword() {
        
    }
    
    function changeStatus() {
        
    }

    function connectToDB() {
        global $link;
        $this->database = $link;
    }

}