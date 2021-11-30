<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['user_name'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {

$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
	$gset_result = mysqli_query($mysqli, $gset_qry);
	$gset_row = mysqli_fetch_array($gset_result);

$title=$_POST['title'];
$contact_name=$_POST['contact_name'];
$contact_phone_no=$_POST['contact_phone_no'];
$contact_email_id=$_POST['contact_email_id'];
$address=$_POST['address'];
$logo=$_FILES["logo"]["name"];
$favicon=$_FILES["favicon"]["name"];
$mby = $_SESSION['user_id'];
$mon = date('Y-m-d H:i:s');
if($logo!='')
{
	move_uploaded_file($_FILES["logo"]["tmp_name"],"img/logo/".$_FILES["logo"]["name"]);
	$logo = $_FILES["logo"]["name"];
}
else
{
	$logo = $gset_row['logo'];
}
if($favicon!='')
{
	move_uploaded_file($_FILES["favicon"]["tmp_name"],"img/logo/".$_FILES["favicon"]["name"]);
	$favicon=$_FILES["favicon"]["name"];
}
else
{
	$favicon = $gset_row['favicon'];
}

$sql="UPDATE `general_settings` SET `logo`='".$logo."',`favicon`='".$favicon."',`title`='".$title."',`contact_name`='".$contact_name."',`contact_phone_no`='".$contact_phone_no."',`contact_email_id`='".$contact_email_id."',`address`='".$address."',`modified_on`='".$mon."',`modified_by`='".$mby."' WHERE `general_settings_id`=1";
$user_result = mysqli_query($mysqli, $sql);
if($user_result)
{
$msg="General Settings Updated successfully";
}
else 
{
$error="Something went wrong. Please try again";
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
	<meta name="theme-color" content="#3e454c">
	
	<title><?php echo $gset_row['title'];?> | Admin General Settings</title>
	<link rel="shortcut icon" href="img/logo/<?php echo $gset_row['favicon']; ?>" />

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">General Settings</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="title" class="form-control" value="<?php echo $gset_row['title'];?>" required>
</div>
<label class="col-sm-2 control-label">Logo</label>
<div class="col-sm-4">
<input type="file" name="logo">
</div>
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Favicon</label>
<div class="col-sm-4">
<input type="file" name="favicon">
</div>
<label class="col-sm-2 control-label">Contact Name<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="contact_name" class="form-control" value="<?php echo $gset_row['contact_name'];?>" required>
</div>
</div>
											
<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Phone No<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="contact_phone_no" class="form-control" value="<?php echo $gset_row['contact_phone_no'];?>" required>
</div>
<label class="col-sm-2 control-label">Email Id<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="contact_email_id" class="form-control" value="<?php echo $gset_row['contact_email_id'];?>" required>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Address<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="address" rows="3" required><?php echo $gset_row['address'];?></textarea>
</div>
</div>									
</div>
</div>
</div>
</div>



											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
												</div>
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
<?php } ?>