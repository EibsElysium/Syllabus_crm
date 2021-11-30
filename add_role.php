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

$branch_id=$_POST['branch_id'];
$role_name=$_POST['role_name'];
$cby = $_SESSION['user_id'];
$con = date('Y-m-d H:i:s');

$sql="INSERT INTO `role`(`branch_id`, `role_name`, `created_on`, `created_by`) VALUES ('".$branch_id."','".$role_name."','".$con."','".$cby."')";
$user_result = mysqli_query($mysqli, $sql);
if($user_result)
{
$msg="Role Added successfully";
header('location:role.php');
}
else 
{
$error="Something went wrong. Please try again";
}

}
/*else
{
	$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
	$gset_result = mysqli_query($mysqli, $gset_qry);
	$gset_row = mysqli_fetch_array($gset_result);
}*/
$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
$gset_result = mysqli_query($mysqli, $gset_qry);
$gset_row = mysqli_fetch_array($gset_result);

if($_SESSION['branch_id']==0)
	$branch_qry = "SELECT * FROM branch";
else
	$branch_qry = "SELECT * FROM branch WHERE branch_id=".$_SESSION['branch_id'];
$branch_result = mysqli_query($mysqli, $branch_qry);


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
	
	<title><?php echo $gset_row['title'];?> | Admin Add Role</title>
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
					
						<h2 class="page-title">Add Role</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return role_validataion()">

<div class="form-group">
	<label class="col-sm-2 control-label">Branch<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<select name="branch_id" id="branch_id" class="form-control">
		<option value=''>Select Branch</option>
	   	<?php while($row = mysqli_fetch_array($branch_result)){?>
	   	<option value="<?php echo $row['branch_id'];?>"><?php echo $row['branch_name'];?></option>
	   	<?php }?>
	</select>
	<span id="branch_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Role<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="role_name" name="role_name" class="form-control">
	<span id="role_name_err" class="text-danger"></span>
	</div>
</div>

									
</div>
</div>
</div>
</div>



											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<a href="role.php"><button class="btn btn-default" type="button">Cancel</button></a>
													<button class="btn btn-primary" name="submit" type="submit">Add</button>
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


<script>
function role_validataion()
{
   var err = 0;
   var branch_id = $('#branch_id').val();
   var role_name = $('#role_name').val();
   if (branch_id == '') {
      $('#branch_id_err').html('Choose Branch!');
      err++;
   }
   else {
      $('#branch_id_err').html('');
   }
   if (role_name == '') {
      $('#role_name_err').html('Enter Role Name!');
      err++;
   }
   else {
      $('#role_name_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}
</script>

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