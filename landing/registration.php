<?php
namespace Validate;

use \Validate\Member;
if (! empty($_POST["register-user"])) {
    
    $username = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $displayName = filter_var($_POST["firstName"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["userEmail"], FILTER_SANITIZE_STRING);
    require_once ("Member.php");
    $member = new Member();
    $errorMessage = $member->validateMember();
    
    if (empty($errorMessage)) {
        $memberCount = $member->isMemberExists($username, $email);
        
        if ($memberCount == 0) {
            $insertId = $member->insertMemberRecord($username, $displayName, $password, $email);
            if (! empty($insertId)) {
                header("Location: index.html");
            }
        } else {
            $errorMessage[] = "User already exists.";
        }
    }
}
?>
<html>
<head>
    <title>Реєстрація</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <link href="./css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <form name="frmRegistration" method="post" action="">
        <div class="demo-table">
        <div class="form-head">Реєстрація</div>
<?php
if (! empty($errorMessage) && is_array($errorMessage)) {
    ?>	
            <div class="error-message">
            <?php 
            foreach($errorMessage as $message) {
                echo $message . "<br/>";
            }
            ?>
            </div>
<?php
}
?>
            <div class="field-column">
                <label>Логін</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="userName"
                        value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>">
                </div>
            </div>
            
            <div class="field-column">
                <label>Пароль</label>
                <div><input type="password" class="demo-input-box"
                    name="password" value=""></div>
            </div>
            <div class="field-column">
                <label>Підтвердити пароль</label>
                <div>
                    <input type="password" class="demo-input-box"
                        name="confirm_password" value="">
                </div>
            </div>
            <div class="field-column">
                <label>Ім'я на сайті</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="firstName"
                        value="<?php if(isset($_POST['firstName'])) echo $_POST['firstName']; ?>">
                </div>

            </div>
            <div class="field-column">
                <label>E-mail</label>
                <div>
                    <input type="text" class="demo-input-box"
                        name="userEmail"
                        value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>">
                </div>
            </div>
            <div class="field-column">
                <div class="terms">
                    <input type="checkbox" name="terms"> Я погоджуюсь з Угодою користувача
                </div>
                <div>
                    <input type="submit"
                        name="register-user" value="Зареєструватись"
                        class="btnRegister">
                </div>
            </div>
        </div>
    </form>
</body>
</html>