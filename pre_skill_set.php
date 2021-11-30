<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['user_name'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_REQUEST['del']))
	{
$delid=intval($_GET['del']);
$sql = "delete from pre_skill_set WHERE pre_skill_set_id='".$delid."'";
$user_result = mysqli_query($mysqli, $sql);
$msg="Pre Skill Set Deleted successfully";
}

$gset_qry = "SELECT * FROM general_settings WHERE general_settings_id=1";
	$gset_result = mysqli_query($mysqli, $gset_qry);
	$gset_row = mysqli_fetch_array($gset_result);


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
	
	<title><?php echo $gset_row['title'];?> | Pre Skill Set</title>
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

						<h2 class="page-title">Pre Skill Set</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">
								Pre Skill Set Details
								<span class="pull-right">
									<a href="add_pre_skill_set.php" title="Add"><i class="fa fa-plus"></i></a>
								</span>
							</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Branch</th>
											<th>Pre Skill Set</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Branch</th>
											<th>Pre Skill Set</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

<?php 
if($_SESSION['branch_id']==0)
{
	$sql = "SELECT brd.*,b.branch_name from pre_skill_set brd,branch b WHERE brd.branch_id = b.branch_id AND brd.branch_id!=0 ORDER BY pre_skill_set_id DESC";
}
else
{
	$sql = "SELECT brd.*,b.branch_name from pre_skill_set brd,branch b WHERE brd.branch_id = b.branch_id AND brd.branch_id='".$_SESSION['branch_id']."' ORDER BY pre_skill_set_id DESC";
}
$user_result = mysqli_query($mysqli, $sql);
//$user_row = mysqli_fetch_array($user_result);
if(mysqli_num_rows($user_result) > 0)
{
$i=1;while($row = mysqli_fetch_array($user_result))
{				?>	
										<tr>
											<td><?php echo htmlentities($i);?></td>
											<td><?php echo htmlentities($row['branch_name']);?></td>
											<td><?php echo htmlentities($row['pre_skill_set']);?></td>
		<td><a href="edit_pre_skill_set.php?id=<?php echo $row['pre_skill_set_id'];?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="pre_skill_set.php?del=<?php echo $row['pre_skill_set_id'];?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
										</tr>
										<?php $i++; }} ?>
										
									</tbody>
								</table>

						

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
