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

$branch_id = $_POST['branch_id'];
$branch_name=$_POST['branch_name'];
$contact_person_name=$_POST['contact_person_name'];
$contact_person_no=$_POST['contact_person_no'];
$contact_person_email_id=$_POST['contact_person_email_id'];
$address=$_POST['address'];
$customer_care_no=$_POST['customer_care_no'];
$sales_no=$_POST['sales_no'];
$support_no=$_POST['support_no'];
$mby = $_SESSION['user_id'];
$mon = date('Y-m-d H:i:s');

$sql="UPDATE `branch` SET `branch_name`='".$branch_name."',`contact_person_name`='".$contact_person_name."',`contact_person_no`='".$contact_person_no."',`contact_person_email_id`='".$contact_person_email_id."',`address`='".$address."',`customer_care_no`='".$customer_care_no."',`sales_no`='".$sales_no."',`support_no`='".$support_no."',`modified_on`='".$mno."',`modified_by`='".$mby."' WHERE `branch_id`='".$branch_id."'";
$user_result = mysqli_query($mysqli, $sql);
if($user_result)
{
$msg="Branch Updated successfully";
header('location:branch.php');
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
	
	<title><?php echo $gset_row['title'];?> | Admin Edit Branch</title>
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
					
						<h2 class="page-title">Edit Branch</h2>
<?php $id=intval($_GET['id']);
$bcat_qry ="SELECT * FROM branch where branch_id='".$id."'";
$bcat_result = mysqli_query($mysqli, $bcat_qry);
$bcat_row = mysqli_fetch_array($bcat_result);
?>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return branch_validataion()">
	<input type="hidden" id="branch_id" name="branch_id" value="<?php echo $bcat_row['branch_id'];?>">

<div class="form-group">
	<label class="col-sm-2 control-label">Branch<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="branch_name" name="branch_name" class="form-control" value="<?php echo $bcat_row['branch_name'];?>">
	<span id="branch_name_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Contact Person<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="contact_person_name" name="contact_person_name" class="form-control" value="<?php echo $bcat_row['contact_person_name'];?>">
	<span id="contact_person_name_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Phone No<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="contact_person_no" name="contact_person_no" class="form-control" onkeypress="return isNumber(event);" maxlength="12" value="<?php echo $bcat_row['contact_person_no'];?>">
	<span id="contact_person_no_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Email Id<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="contact_person_email_id" name="contact_person_email_id" class="form-control" value="<?php echo $bcat_row['contact_person_email_id'];?>">
	<span id="contact_person_email_id_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Address<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<textarea class="form-control" id="address" name="address" rows="3"><?php echo $bcat_row['address'];?></textarea>
	<span id="address_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Customer Care No<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="customer_care_no" name="customer_care_no" class="form-control" onkeypress="return isNumber(event);" maxlength="12" value="<?php echo $bcat_row['customer_care_no'];?>">
	<span id="customer_care_no_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Sales No<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="sales_no" name="sales_no" class="form-control" onkeypress="return isNumber(event);" maxlength="12" value="<?php echo $bcat_row['sales_no'];?>">
	<span id="sales_no_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Support No<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="support_no" name="support_no" class="form-control" onkeypress="return isNumber(event);" maxlength="12" value="<?php echo $bcat_row['support_no'];?>">
	<span id="support_no_err" class="text-danger"></span>
	</div>
</div>

									
</div>
</div>
</div>
</div>



											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<a href="branch.php"><button class="btn btn-default" type="button">Cancel</button></a>
													<button class="btn btn-primary" name="submit" type="submit">Save</button>
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
function branch_validataion()
{
   var err = 0;
   var branch_name = $('#branch_name').val();
   var contact_person_name = $('#contact_person_name').val();
   var contact_person_no = $('#contact_person_no').val();
   var contact_person_email_id = $('#contact_person_email_id').val();
   var address = $('#address').val();
   var customer_care_no = $('#customer_care_no').val();
   var sales_no = $('#sales_no').val();
   var support_no = $('#support_no').val();
   if (branch_name == '') {
      $('#branch_name_err').html('Enter Branch Name!');
      err++;
   }
   else {
      $('#branch_name_err').html('');
   }
   if (contact_person_name == '') {
      $('#contact_person_name_err').html('Enter Contact Person!');
      err++;
   }
   else {
      $('#contact_person_name_err').html('');
   }
   if (contact_person_no == '') {
      $('#contact_person_no_err').html('Enter Contact Person No!');
      err++;
   }
   else {
      $('#contact_person_no_err').html('');
   }
   if (contact_person_email_id == '') {
      $('#contact_person_email_id_err').html('Enter Contact Person Mail Id!');
      err++;
   }
   else if(contact_person_email_id.trim() !='' && !ValidateEmail(contact_person_email_id)){ 
        $('#contact_person_email_id_err').html('Invalid Email ID!');
        err++;
    }
   else {
      $('#contact_person_email_id_err').html('');
   }
   if (address == '') {
      $('#address_err').html('Enter Address!');
      err++;
   }
   else {
      $('#address_err').html('');
   }
   if (customer_care_no == '') {
      $('#customer_care_no_err').html('Enter Customer Care No!');
      err++;
   }
   else {
      $('#customer_care_no_err').html('');
   }
   if (sales_no == '') {
      $('#sales_no_err').html('Enter Sales No!');
      err++;
   }
   else {
      $('#sales_no_err').html('');
   }
   if (support_no == '') {
      $('#support_no_err').html('Enter Support No!');
      err++;
   }
   else {
      $('#support_no_err').html('');
   }
   if(err> 0){ return false;}else{ return true; }   
}

// To validate Email ID
function ValidateEmail(email){
var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
return expr.test(email);
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
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