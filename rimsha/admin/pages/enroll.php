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

		$query= $class->fetchdata(" select * from users where id='$user_id'");
		$data=$query->fetch(PDO::FETCH_ASSOC);
		if($data['role']=="student")
		{
		?>
		<script> window.location.href="logout.php";</script>
		<?php 	
		}
		
		
	if(isset($_POST['testNO']))
	{
	$title_p_name = $_POST['p_name'];
	$query=$class->insert("UPDATE `course_enrolled` SET `marks`='$_POST[testNO]' WHERE p_id = $_POST[p_id]");
	$checkD=$class->fetchdata("SELECT * FROM `notification` WHERE p_id = '$_POST[p_id]'");

	if($checkD->rowCount()==0)
	{
	$p_name = "Yours Entry Test Marks ".$_POST['testNO']." are added for program ".$title_p_name;
    $class->insert("INSERT INTO `notification`(`title`,`fromNot`,`toNot`,`p_id`) VALUES('$p_name','$user_id','$_POST[user_id]','$_POST[p_id]')");
	}else{
	$p_name = "Yours Entry Test Marks ".$_POST['testNO']." are added for program ".$title_p_name;
	$class->insert("UPDATE `notification` SET `title`='$p_name',`toNot`='$_POST[user_id]',`fromNot`='$user_id' where `p_id`='$_POST[p_id]'");	
	}
	
	}

if(isset($_POST['add_done']))
{
$title= $_POST['title'];

	try {
    
    $sql = "INSERT INTO `programs`(`title`, `user_id`) VALUES('$title','$user_id')";
    // use exec() because no results are returned
    $DB_con->exec($sql);
    $last_id = $DB_con->lastInsertId();
	$_SESSION['pId'] = $last_id;
	
	$class->redirect("instruction.php?pId=".$_SESSION['pId']);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

}
include "assets/main_header.php";		
?>



 <div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Program Name</th>
        <th>Student Name</th>
		<th>Student Email</th>
		<th>Student CNIC</th>
		<th>Enter Entry Test Marks</th>
      </tr>
    </thead>
    <tbody>
		<?php
		
		
		$course_enrolled_query = $class->fetchdata("SELECT * FROM `course_enrolled` WHERE `by`='$user_id'");
		while($data_course_enrolled_query=$course_enrolled_query->fetch(PDO::FETCH_ASSOC))
		{
		$program_query= $class->fetchdata("SELECT * FROM `programs` WHERE `user_id` ='$user_id' AND status = 1");
		$dataP1=$program_query->fetch(PDO::FETCH_ASSOC);
									
									$queryP= $class->fetchdata(" select * from admin_p_detail where p_id='$data_course_enrolled_query[p_id]'");
									$dataP=$queryP->fetch(PDO::FETCH_ASSOC);
									
									$Userquery= $class->fetchdata(" select * from users where id='$data_course_enrolled_query[user_id]'");
									$Userdata=$Userquery->fetch(PDO::FETCH_ASSOC);
									
									$query_student_p_detail= $class->fetchdata("SELECT * FROM `student_p_detail` where user_id='$data_course_enrolled_query[user_id]'");
									$CninData=$query_student_p_detail->fetch(PDO::FETCH_ASSOC);
									?>
									<tr class="odd gradeX">
                                        <td><?php echo $dataP['uni_program'];?></td>
                                        <td><?php echo $Userdata['name'];?></td>
                                        <td><?php echo $Userdata['email'];?></td>
										<td><?php echo $CninData['cnic'];?></td>
                                       <td>
									   <form method="post" action="enroll.php">
									   <input type="text" 	name="testNO" 	value="<?php echo $data_course_enrolled_query['marks'];?>" placeholder="Enter Marks Here"/>
									   <input type="hidden" name="p_id"   	value="<?php echo $data_course_enrolled_query['p_id'];?>"/>
									   <input type="hidden" name="user_id" 	value="<?php echo $data_course_enrolled_query['user_id'];?>"/>
									   <input type="hidden" name="p_name" 	value="<?php echo $dataP['uni_program'];?>"/>
									   </form>
									   </td>
                                    </tr>
									<?php
									}
									?>
    </tbody>
  </table>
</div>
</div>
<?php
include "assets/footer.php";
?>