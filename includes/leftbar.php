	<nav class="ts-sidebar">
			<ul class="ts-sidebar-menu">
			
				<li class="ts-label">Main</li>
				<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>

<li><a href="course.php"><i class="fa fa-table"></i> Course</a></li>
			
<li><a href="#"><i class="fa fa-files-o"></i> Settings</a>
<ul>
<?php if($_SESSION['branch_id']==0)	{?>
<li><a href="general_settings.php">General Settings</a></li>
<li><a href="branch.php">Branch</a></li>
<?php }?>
<li><a href="role.php">Role</a></li>
<li><a href="user.php">User</a></li>
<li><a href="brand.php">Brand</a></li>
<li><a href="category.php">Category</a></li>
<li><a href="course_group.php">Course Group</a></li>
<li><a href="course_type.php">Course Type</a></li>
<li><a href="job_role.php">Job Role</a></li>
<li><a href="learned_skill_set.php">Learned Skill Set</a></li>
<li><a href="pre_skill_set.php">Pre Skill Set</a></li>
<li><a href="tag.php">Tag</a></li>
</ul>
</li>

			</ul>
		</nav>