<?php 
include('includes/config.php');
	$title=$_POST['title'];
	$val = $_POST['val'];
	if($title=='Branch Role')
	{
		if($val!='')
		{
			$sql = "SELECT * FROM role WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$option = "<option value=''>Select Role</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$option.="<option value='".$row['role_id']."'>".$row['role_name']."</option>";
			}
			echo $option;
		}
		else
		{
			$option = "<option value=''>Select Role</option>";
			echo $option;
		}
	}

	if($title=='Branch Settings')
	{
		if($val!='')
		{
			$sql = "SELECT * FROM category WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$catoption = "<option value=''>Select Category</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$catoption.="<option value='".$row['category_id']."'>".$row['category']."</option>";
			}
			//echo $option;

			$sql = "SELECT * FROM brand WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$brandoption = "<option value=''>Select Brand</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$brandoption.="<option value='".$row['brand_id']."'>".$row['brand']."</option>";
			}

			$sql = "SELECT * FROM course_type WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$typeoption = "<option value=''>Select Type</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$typeoption.="<option value='".$row['course_type_id']."'>".$row['course_type']."</option>";
			}

			$sql = "SELECT * FROM course_group WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$groupoption = "<option value=''>Select Group</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$groupoption.="<option value='".$row['course_group_id']."'>".$row['course_group']."</option>";
			}

			$sql = "SELECT * FROM job_role WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$jroleoption = "<option value=''>Select Job Role</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$jroleoption.="<option value='".$row['job_role_id']."'>".$row['job_role']."</option>";
			}

			$sql = "SELECT * FROM tag WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$tagoption = "<option value=''>Select Tag</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$tagoption.="<option value='".$row['tag_id']."'>".$row['tag']."</option>";
			}

			$sql = "SELECT * FROM pre_skill_set WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$pssetoption = "<option value=''>Select Pre Skill Set</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$pssetoption.="<option value='".$row['pre_skill_set_id']."'>".$row['pre_skill_set']."</option>";
			}

			$sql = "SELECT * FROM learned_skill_set WHERE branch_id=".$val;
			$user_result = mysqli_query($mysqli, $sql);
			$lssetoption = "<option value=''>Select Learned Skill Set</option>";
			while($row = mysqli_fetch_array($user_result))
			{
				$lssetoption.="<option value='".$row['learned_skill_set_id']."'>".$row['learned_skill_set']."</option>";
			}
		}
		else
		{
			$catoption = "<option value=''>Select Category</option>";
			$brandoption = "<option value=''>Select Brand</option>";
			$typeoption = "<option value=''>Select Type</option>";
			$groupoption = "<option value=''>Select Group</option>";
			$jroleoption = "<option value=''>Select Job Role</option>";
			$tagoption = "<option value=''>Select Tag</option>";
			$pssetoption = "<option value=''>Select Pre Skill Set</option>";
			$lssetoption = "<option value=''>Select Learned Skill Set</option>";
			//echo $option;
		}
		echo $catoption."|".$brandoption."|".$typeoption."|".$groupoption."|".$jroleoption."|".$tagoption."|".$pssetoption."|".$lssetoption;
	}
?>