<?php
session_start();
include "../../config.php";
if(empty($_SESSION['id']))
		{
		?>
		<script> window.location.href="login.php";</script>
		<?php 
		}else{
			$user_id = $_SESSION['id'];
		}
		
		$p_id = $_GET['user_id'];

		$query= $class->fetchdata(" select * from users where id='$user_id'");
		$data=$query->fetch(PDO::FETCH_ASSOC);
		if($data['role']=="student")
		{
		?>
		<script> window.location.href="logout.php";</script>
		<?php 	
		}
$JoinQuery = $class->fetchdata("SELECT users.*, student_address.*, student_doc_detail.*, student_e_detail.* , student_p_detail.* FROM users 
left join student_address ON users.id = student_address.user_id
left join student_p_detail ON users.id = student_p_detail.user_id
left join student_doc_detail ON users.id = student_doc_detail.user_id 
left join student_e_detail ON users.id = student_e_detail.user_id where users.id= '$p_id'");
$JoinResult=$JoinQuery->fetch(PDO::FETCH_ASSOC);
include "assets/main_header.php";		
?>
<div class="row">
<div class="col-md-12">

 <div class="table-responsive">
<div class="list-group">
  <a href="#" class="list-group-item active">Personal Info</a>
  <a href="#" class="list-group-item">Name :  <?php echo $JoinResult['name'];?></a>
  <a href="#" class="list-group-item">Email :  <?php echo $JoinResult['email'];?></a>
  <a href="#" class="list-group-item">Gender :  <?php echo $JoinResult['gender'];?></a>
  <a href="#" class="list-group-item">DOB :  <?php echo $JoinResult['dob'];?></a>
  <a href="#" class="list-group-item">Nationality :  <?php echo $JoinResult['nationality'];?></a>
  <a href="#" class="list-group-item">Domicile :  <?php echo $JoinResult['domicile'];?></a>
    <?php
if(!empty($JoinResult['permanent_address']))
{
?><a href="#" class="list-group-item"> <?php echo "Address :".$JoinResult['permanent_address']."</a>";
}
?>
<a href="#" class="list-group-item">Cnic :  <?php echo $JoinResult['cnic'];?></a>
<a href="#" class="list-group-item">Phone :  <?php echo $JoinResult['mobile'];?></a>
</div>
<div class="table-responsive">
<div class="list-group">
<a href="#" class="list-group-item active">Educational Info</a>
<a href="#" class="list-group-item">Degree : <?php echo $JoinResult['degree'];?></a>
<a href="#" class="list-group-item">SSC Marks :<?php echo $JoinResult['ssc_obtained'];?> Out Of <?php echo $JoinResult['ssc_max_marks'];?></a>

<?php
if(!empty($JoinResult['fa_obtained']))
{
?> <a href="#" class="list-group-item"> <?php echo "FA Marks :".$JoinResult['fa_obtained']." Out Of ".$JoinResult['fa_max_marks']."</a>";
}
?>
<?php
if(!empty($JoinResult['ba_obtained']))
{
?>
<a href="#" class="list-group-item"><?php echo "BA Marks :".$JoinResult['ba_obtained']." Out Of ".$JoinResult['ba_max_marks']."</a>";
}
?>
<?php
if(!empty($JoinResult['bs_obtained']))
{
?>
<a href="#" class="list-group-item"> <?php echo "BS Marks :".$JoinResult['bs_obtained']." Out Of ".$JoinResult['bs_max_marks']."</a>";
}
?>
<?php
if(!empty($JoinResult['ms_obtained']))
{
?><a href="#" class="list-group-item"><?php echo "MS Marks :".$JoinResult['ms_obtained']." Out Of ".$JoinResult['ms_max_marks']."</a>";
}
?>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img1'];?>" class="list-group-item">Front Cnic</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img2'];?>" class="list-group-item">Back Cnic</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img3'];?>" class="list-group-item">SSC</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img4'];?>" class="list-group-item">HSSC</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img5'];?>" class="list-group-item">MSc</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img6'];?>" class="list-group-item">MPhill</a>
<a href="http://localhost/rimsha/students/images/<?php echo $JoinResult['img7'];?>" class="list-group-item">NTS</a>
</div>
</div>

</div>
</div>

<?php
include "assets/footer.php";
?>