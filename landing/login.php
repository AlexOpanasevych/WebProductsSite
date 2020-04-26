<?php
$message="";
if(count($_POST)>0) {
	$conn = mysqli_connect("localhost","root","","users");
	$result = mysqli_query($conn,"SELECT * FROM register_users WHERE username='" . $_POST["userName"] . "' and password = '". md5($_POST["password"]) ."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
	} else {
		$message = "You are successfully authenticated!";
		header('Location: index.html');
	}
}
?>
<html>
<head>
    <title>Вхід</title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<form name="frmUser" method="post" action="">
	<div class="message"><?php if($message!="") { echo $message; } ?></div>
    <div class="demo-table">
        <div class="form-head">Вхід</div>
		<div class="field-column">
			<label  align="center" colspan="2">Ім'я користувача</label>
            <div>
                <input type="text" name="userName" placeholder="Введіть м'я користувача" class="demo-input-box">
            </div>
        </div>
        <div class="field-column">
            <label>Введіть пароль</label>
            <input type="password" name="password" placeholder="Введіть пароль" class="demo-input-box">
        </div>
        <div>
			<input type="submit" name="submit" value="Увійти" class="btnRegister">
		</div>
</form>
</body></html>