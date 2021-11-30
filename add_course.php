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
$course_name=$_POST['course_name'];
$category_id=$_POST['category_id'];
$brand_id=$_POST['brand_id'];
$course_type_id=$_POST['course_type_id'];
$course_group_id=$_POST['course_group_id'];
$job_role_id=$_POST['job_role_id'];
$tag_id=$_POST['tag_id'];
$pre_skill_set_id=$_POST['pre_skill_set_id'];
$learned_skill_set_id=$_POST['learned_skill_set_id'];
$total_days=$_POST['total_days'];
$total_duration=$_POST['total_duration'];
$theory_duration=$_POST['theory_duration'];
$practical_duration=$_POST['practical_duration'];
$facility=$_POST['facility'];
$industrial_opportunity=$_POST['industrial_opportunity'];
$min_fees=$_POST['min_fees'];
$max_fees=$_POST['max_fees'];
$course_description=$_POST['course_description'];
$cby = $_SESSION['user_id'];
$con = date('Y-m-d H:i:s');

$clist_qry = "SELECT * FROM course ORDER BY course_id DESC LIMIT 1";
$clist_result = mysqli_query($mysqli, $clist_qry);
$clist_row = mysqli_fetch_array($clist_result);
$clist_rows = mysqli_num_rows($clist_result);
if($clist_rows>0)
{
	$cno = $clist_row['course_no'];
	$exlno = substr($cno,8);
    $next_value = (int)$exlno + 1;
    $course_no = 'EA/'.date("Y").'/'.$next_value;
}
else
{
	$course_no = 'EA/'.date("Y").'/100';
}

$sql="INSERT INTO `course`(`course_no`, `course_name`, `category_id`, `brand_id`, `course_group_id`, `tag_id`, `course_type_id`, `total_duration`, `theory_duration`, `practical_duration`, `total_days`, `facility`, `pre_skill_set_id`, `course_description`, `job_role_id`, `industrial_opportunity`, `learned_skill_set_id`, `branch_id`, `min_fees`, `max_fees`, `created_on`, `created_by`) VALUES ('".$course_no."','".$course_name."','".$category_id."','".$brand_id."','".$course_group_id."','".$tag_id."','".$course_type_id."','".$total_duration."','".$theory_duration."','".$practical_duration."','".$total_days."','".$facility."','".$pre_skill_set_id."','".$course_description."','".$job_role_id."','".$industrial_opportunity."','".$learned_skill_set_id."','".$branch_id."','".$min_fees."','".$max_fees."','".$con."','".$cby."')";
$user_result = mysqli_query($mysqli, $sql);
if($user_result)
{
$msg="Course Added successfully";
header('location:course.php');
}
else 
{
$error="Something went wrong. Please try again";
}

}
/*else
{*/
	$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
	$gset_result = mysqli_query($mysqli, $gset_qry);
	$gset_row = mysqli_fetch_array($gset_result);

if($_SESSION['branch_id']==0)
	$branch_qry = "SELECT * FROM branch";
else
	$branch_qry = "SELECT * FROM branch WHERE branch_id=".$_SESSION['branch_id'];
	$branch_result = mysqli_query($mysqli, $branch_qry);
	//$gset_row = mysqli_fetch_array($gset_result);


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
	
	<title><?php echo $gset_row['title'];?> | Add Course</title>
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
					
						<h2 class="page-title">Add Course</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return course_validataion()">

<div class="form-group">
	<label class="col-sm-2 control-label">Branch<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="branch_id" id="branch_id" class="form-control" onchange="getBranchSettings(this.value);">
			<option value=''>Select Branch</option>
		   	<?php while($row = mysqli_fetch_array($branch_result)){?>
		   	<option value="<?php echo $row['branch_id'];?>"><?php echo $row['branch_name'];?></option>
		   	<?php }?>
		</select>
		<span id="branch_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Course Name<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<input type="text" id="course_name" name="course_name" class="form-control">
	<span id="course_name_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Category<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="category_id" id="category_id" class="form-control">
			<option value=''>Select Category</option>
		</select>
		<span id="category_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Brand<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="brand_id" id="brand_id" class="form-control">
			<option value=''>Select Brand</option>
		</select>
		<span id="brand_id_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Type<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="course_type_id" id="course_type_id" class="form-control">
			<option value=''>Select Type</option>
		</select>
		<span id="course_type_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Group<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="course_group_id" id="course_group_id" class="form-control">
			<option value=''>Select Group</option>
		</select>
		<span id="course_group_id_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Job Role<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="job_role_id" id="job_role_id" class="form-control">
			<option value=''>Select Job Role</option>
		</select>
		<span id="job_role_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Tag<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="tag_id" id="tag_id" class="form-control">
			<option value=''>Select Tag</option>
		</select>
		<span id="tag_id_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Pre Skill Set<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="pre_skill_set_id" id="pre_skill_set_id" class="form-control">
			<option value=''>Select Pre Skill Set</option>
		</select>
		<span id="pre_skill_set_id_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Learned Skill Set<span style="color:red">*</span></label>
	<div class="col-sm-4">
		<select name="learned_skill_set_id" id="learned_skill_set_id" class="form-control">
			<option value=''>Select Learned Skill Set</option>
		</select>
		<span id="learned_skill_set_id_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Total Days<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="total_days" name="total_days" class="form-control" onkeypress="return isNumber(event);" value="0" onfocus="this.select();">
	<span id="total_days_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Total Duration<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="total_duration" name="total_duration" class="form-control" onkeypress="return isNumber(event);" value="0" onfocus="this.select();">
	<span id="total_duration_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Theory Duration<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="theory_duration" name="theory_duration" class="form-control" onkeypress="return isNumber(event);" value="0" onfocus="this.select();">
	<span id="theory_duration_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Practical Duration<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="practical_duration" name="practical_duration" class="form-control" onkeypress="return isNumber(event);" value="0" onfocus="this.select();">
	<span id="practical_duration_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Facility<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<textarea class="form-control" id="facility" name="facility" rows="3"></textarea>
	<span id="facility_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Industrial Opportunity<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<textarea class="form-control" id="industrial_opportunity" name="industrial_opportunity" rows="3"></textarea>
	<span id="industrial_opportunity_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Minimum Fee<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="min_fees" name="min_fees" class="form-control" onkeypress="return isNumberKey(event,this);" value="0" onfocus="this.select();">
	<span id="min_fees_err" class="text-danger"></span>
	</div>

	<label class="col-sm-2 control-label">Maximum Fee<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<input type="text" id="max_fees" name="max_fees" class="form-control" onkeypress="return isNumberKey(event,this);" value="0" onfocus="this.select();">
	<span id="max_fees_err" class="text-danger"></span>
	</div>
</div>

<div class="form-group">
	<label class="col-sm-2 control-label">Description<span style="color:red">*</span></label>
	<div class="col-sm-4">
	<textarea class="form-control" id="course_description" name="course_description" rows="3"></textarea>
	<span id="course_description_err" class="text-danger"></span>
	</div>
</div>





											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<a href="user.php"><button class="btn btn-default" type="button">Cancel</button></a>
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

function getBranchSettings(val)
{
	//make the ajax call
    $.ajax({
        url: 'ajax_call.php',
        type: 'POST',
        data: {title : 'Branch Settings',val:val},
        async: false,
        success: function(res) {
        	var ressplit = res.split('|');
            $('#category_id').empty().html(ressplit[0]);
            $('#brand_id').empty().html(ressplit[1]);
            $('#course_type_id').empty().html(ressplit[2]);
            $('#course_group_id').empty().html(ressplit[3]);
            $('#job_role_id').empty().html(ressplit[4]);
            $('#tag_id').empty().html(ressplit[5]);
            $('#pre_skill_set_id').empty().html(ressplit[6]);
            $('#learned_skill_set_id').empty().html(ressplit[7]);
        }
    });
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

function isNumberKey(evt, obj)
{ 
    var charCode = (evt.which) ? evt.which : event.keyCode
    var value = obj.value;
    var dotcontains = value.indexOf(".") != -1;
    if (dotcontains)
        if (charCode == 46) return false;
    if (charCode == 46) return true;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}




function course_validataion()
{
   var err = 0;
   var branch_id = $('#branch_id').val();
   var course_name = $('#course_name').val();
   var category_id = $('#category_id').val();
   var brand_id = $('#brand_id').val();
   var course_type_id = $('#course_type_id').val();
   var course_group_id = $('#course_group_id').val();
   var job_role_id = $('#job_role_id').val();
   var tag_id = $('#tag_id').val();
   var pre_skill_set_id = $('#pre_skill_set_id').val();
   var learned_skill_set_id = $('#learned_skill_set_id').val();
   var total_days = $('#total_days').val();
   var total_duration = $('#total_duration').val();
   var theory_duration = $('#theory_duration').val();
   var practical_duration = $('#practical_duration').val();
   var facility = $('#facility').val();
   var industrial_opportunity = $('#industrial_opportunity').val();
   var min_fees = $('#min_fees').val();
   var max_fees = $('#max_fees').val();
   var course_description = $('#course_description').val();

   if (branch_id == '') {
      $('#branch_id_err').html('Choose Branch!');
      err++;
   }
   else {
      $('#branch_id_err').html('');
   }
   if (course_name == '') {
      $('#course_name_err').html('Enter Course Name!');
      err++;
   }
   else {
      $('#course_name_err').html('');
   }
   if (category_id == '') {
      $('#category_id_err').html('Choose Category!');
      err++;
   }
   else {
      $('#category_id_err').html('');
   }
   if (brand_id == '') {
      $('#brand_id_err').html('Choose Brand!');
      err++;
   }
   else {
      $('#brand_id_err').html('');
   }
   if (course_type_id == '') {
      $('#course_type_id_err').html('Choose Type!');
      err++;
   }
   else {
      $('#course_type_id_err').html('');
   }
   if (course_group_id == '') {
      $('#course_group_id_err').html('Choose Group!');
      err++;
   }
   else {
      $('#course_group_id_err').html('');
   }
   if (job_role_id == '') {
      $('#job_role_id_err').html('Choose Job Role!');
      err++;
   }
   else {
      $('#job_role_id_err').html('');
   }
   if (tag_id == '') {
      $('#tag_id_err').html('Choose Tag!');
      err++;
   }
   else {
      $('#tag_id_err').html('');
   }
   if (pre_skill_set_id == '') {
      $('#pre_skill_set_id_err').html('Choose Pre Skill Set!');
      err++;
   }
   else {
      $('#pre_skill_set_id_err').html('');
   }
   if (learned_skill_set_id == '') {
      $('#learned_skill_set_id_err').html('Choose Learned Skill Set!');
      err++;
   }
   else {
      $('#learned_skill_set_id_err').html('');
   }
   if (total_days == '') {
      $('#total_days_err').html('Enter Total Days!');
      err++;
   }
   else {
      $('#total_days_err').html('');
   }
   if (total_duration == '') {
      $('#total_duration_err').html('Enter Total Duration!');
      err++;
   }
   else {
      $('#total_duration_err').html('');
   }
   if (theory_duration == '') {
      $('#theory_duration_err').html('Enter Theory Duration!');
      err++;
   }
   else {
      $('#theory_duration_err').html('');
   }
   if (practical_duration == '') {
      $('#practical_duration_err').html('Enter Practical Duration!');
      err++;
   }
   else {
      $('#practical_duration_err').html('');
   }
   if (facility == '') {
      $('#facility_err').html('Enter Facility!');
      err++;
   }
   else {
      $('#facility_err').html('');
   }
   if (industrial_opportunity == '') {
      $('#industrial_opportunity_err').html('Enter Industrial Opportunity!');
      err++;
   }
   else {
      $('#industrial_opportunity_err').html('');
   }
   if (min_fees == '') {
      $('#min_fees_err').html('Enter Minimum Fees!');
      err++;
   }
   else {
      $('#min_fees_err').html('');
   }
   if (max_fees == '') {
      $('#max_fees_err').html('Enter Maximum Fees!');
      err++;
   }
   else {
      $('#max_fees_err').html('');
   }
   if (course_description == '') {
      $('#course_description_err').html('Enter Course Description!');
      err++;
   }
   else {
      $('#course_description_err').html('');
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