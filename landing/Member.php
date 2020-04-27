<?php
namespace Validate;

use \Validate\DataSource;

class Member
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function validateMember()
    {
        $valid = true;
        $errorMessage = array();
        foreach ($_POST as $key => $value) {
            if (empty($_POST[$key])) {
                $valid = false;
            }
        }
        
        if($valid == true) {
            // Password Matching Validation
            if ($_POST['password'] != $_POST['confirm_password']) {
                $errorMessage[] = 'Паролі мають співпадати.';
                $valid = false;
            }
            
            // Email Validation
            if (! isset($error_message)) {
                if (! filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
                    $errorMessage[] = "Неправильна email адреса.";
                    $valid = false;
                }
            }
            
            // Validation to check if Terms and Conditions are accepted
            if (! isset($error_message)) {
                if (! isset($_POST["terms"])) {
                    $errorMessage[] = "Погодьтеся з Угодою користувача.";
                    $valid = false;
                }
            }
        }
        else {
            $errorMessage[] = "Потрібно ввести всі поля.";
        }
        
        if ($valid == false) {
            return $errorMessage;
        }
        return;
    }

    function isMemberExists($username, $email)
    {
        $query = "select * FROM register_users WHERE username = ? OR email = ?";
        $paramType = "ss";
        $paramArray = array($username, $email);
        return $this->ds->numRows($query, $paramType, $paramArray);
    }

    function insertMemberRecord($username, $displayName, $password, $email)
    {
        $passwordHash = md5($password);
        $query = "INSERT INTO register_users (username, display_name, email, password) VALUES (?, ?, ?, ?)";
        $paramType = "ssss";
        $paramArray = array(
            $username,
            $displayName,
            $email,
            $passwordHash
        );
        return $this->ds->insert($query, $paramType, $paramArray);
    }
}