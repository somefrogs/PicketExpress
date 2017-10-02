
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<section class="container" >
		<div class="login" align="center">
			<h1>Login </h1>
			<form method="post" action="login.php">
				<p><input type="text" name="txt_uname_email" value="" placeholder="Username"></p>
				<p><input type="password" name="txt_password" value="" placeholder="Password"></p>
				<p class="submit"><input type="submit" name="commit" value="Submit"></p>
			</form>
		</div>

	</section>

</body>
</html>


<?php
require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['commit']))
{
	$uname = $_POST['txt_uname_email'];
	$upass = $_POST['txt_password'];

	if($user->login($uname,$upass))
	{

		if($_SESSION['privilege'] == '1') {
			$user->redirect('admin.php');
		} else
		if ($_SESSION['privilege'] == '2'){
			$user->redirect('th_employee.php');
		} else 
		if($_SESSION['privilege'] == '3') {
			$user->redirect('store_employee.php');

		} else {
			$user->redirect('home.php');
		}

	}
	else
	{

		$error = "Wrong Details !";
		$user->logout();
	} 
}

