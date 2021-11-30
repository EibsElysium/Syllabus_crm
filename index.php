<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$email=$_POST['username'];
$password=encrypt_decrypt($_POST['password'],'encrypt');
$user_qry ="SELECT * FROM users WHERE user_name='".$email."' and password='".$password."'";
//echo $user_qry;
$user_result = mysqli_query($mysqli, $user_qry);
$user_row = mysqli_fetch_array($user_result);
if(mysqli_num_rows($user_result) > 0)
{
$_SESSION['user_name']=$_POST['username'];
$_SESSION['user_id'] = $user_row['user_id'];
$_SESSION['role_id'] = $user_row['role_id'];
$_SESSION['branch_id'] = $user_row['branch_id'];
$_SESSION['login_name'] = $user_row['name'];
echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}
else
{
	$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
	$gset_result = mysqli_query($mysqli, $gset_qry);
	$gset_row = mysqli_fetch_array($gset_result);
}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?php echo $gset_row['title'];?> | Admin Login</title>
	<link rel="shortcut icon" href="img/logo/<?php echo $gset_row['favicon']; ?>" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold mt-4x" style="color:#fff"><img src = "img/logo/<?php echo $gset_row['logo'];?>" width="250px" height="100px"></h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Your Username </label>
									<input type="text" placeholder="Username" name="username" class="form-control mb">

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb">
		

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>

								</form>

			<!-- <p style="margin-top: 4%" align="center"><a href="../index.php">Back to Home</a>	</p> -->
							</div>

						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>