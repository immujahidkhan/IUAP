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
if(isset($_POST['selected']))
{
	$query=$class->insert("UPDATE `meritlist` SET `status`='selected' WHERE `p_id` = '$_POST[p_id]' and `s_id` = '$_POST[user_id]'");		
	$query=$class->insert("UPDATE `course_enrolled` SET `status`='selected' WHERE `p_id` = '$_POST[p_id]' and `user_id` = '$_POST[user_id]'");
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

$course_count = $class->fetchdata("SELECT * FROM `admin_criteria_list` WHERE `p_id`='$_GET[pId]' and `user_id`='$user_id'");
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$countData = $course_count->fetch(PDO::FETCH_ASSOC);
$perpage = $countData['t_seats'];
//$perpage = 10;
$secondPerpage = $perpage-$selectedCount;
//echo $_GET["page"];
if(isset($_GET["page"])){
$page = intval($_GET["page"]);
	
}
else {
$page = 1;
}

$calc = $perpage * $page;
$start = $calc - $perpage;
//$result = mysqli_query($conn, "select * from post Limit $start, $perpage");

		
if(isset($_GET['pId']))
{
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $perpage");
while($MeritGenerate=$course_Merit_query->fetch(PDO::FETCH_ASSOC))
{
if($page==1)
{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='1' WHERE id = '$MeritGenerate[id]'");
}else{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='$page' WHERE id = '$MeritGenerate[id]'");
}
}if($page>1)
{
$perpage = $secondPerpage;
}
$course_enrolled_query = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
include "assets/main_header.php";		
?>
<div class="row">
<div class="col-md-12">

<div class="row">
<div class="col-md-6">
<ul class="pagination <?php if($course_Merit_query->rowCount()==0){echo "hidden";}?>">
<li><a target="_blank" href="generateMeritlist.php?pId=<?php echo $_GET['pId'];?>&page=<?php echo $page+1;?>">Generate Merit List <?php echo $page+1;?></a></li>	
</ul>
</div>
<div class="col-md-6">
<?php
$seats_query= $class->fetchdata("SELECT * FROM `admin_criteria_list` where  p_id = '$_GET[pId]' and  user_id='$user_id'");
$DataSeats=$seats_query->fetch(PDO::FETCH_ASSOC);
if($DataSeats['quota']=="Quota System")
{
if(!empty($DataSeats['punjab']))
{
echo " <span> <span class='badge badge-warning'> $DataSeats[punjab] </span> Punjab Seats </span>";	
}
if(!empty($DataSeats['sindh']))
{
echo " <span><span class='badge badge-warning'> $DataSeats[sindh] </span> Sindh Seats </span> ";	
}
if(!empty($DataSeats['kpk']))
{
echo "<span><span class='badge badge-warning'> $DataSeats[kpk] </span> KPK Seats </span>";	
}
if(!empty($DataSeats['bal']))
{
echo "<span><span class='badge badge-warning'>$DataSeats[bal]</span> Balochistan Seats </span>";	
}
if(!empty($DataSeats['fed']))
{
echo "<span><span class='badge badge-warning'>$DataSeats[fed]</span> Federal Seats </span>";	
}
if(!empty($DataSeats['fata']))
{
echo "<span><span class='badge badge-warning'>$DataSeats[fata]</span> Fata Seats </span>";	
}
if(!empty($DataSeats['sports']))
{
echo "<span><span class='badge badge-warning'>$DataSeats[sports]</span> Sports Seats </span>";	
}
if(!empty($DataSeats['handicaped']))
{
echo "<span><span class='badge badge-warning'>$DataSeats[handicaped]</span> Handicaped Seats </span>";	
}

}
?>
</div>
</div>
<div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Id</th>
		<th>Program Name</th>
        <th>Student Name</th>
		<th>Student Email</th>
		<th>Student CNIC</th>
		<th>Domicile</th>
		<th>Aggregate</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php
		while($data_course_enrolled_query=$course_enrolled_query->fetch(PDO::FETCH_ASSOC))
		{
		?>
									<tr class="odd gradeX">
                                        <td><?php echo $data_course_enrolled_query['id'];?></td>
										<td title="<?php echo $data_course_enrolled_query['s_id'];?>"><?php echo $p_name = $data_course_enrolled_query['p_name'];?></td>
                                        <td><?php echo $s_name = $data_course_enrolled_query['s_name'];?></td>
                                        <td><?php echo $s_email = $data_course_enrolled_query['s_email'];?></td>
										<td><?php echo $s_cnic = $data_course_enrolled_query['s_cnic'];?></td>
										<td><?php echo $s_domicile = $data_course_enrolled_query['s_domicile'];?></td>
									    <td><?php echo $s_aggregate = $data_course_enrolled_query['s_aggregate'];?></td>
										<td>
<?php
if($data_course_enrolled_query['status']=="selected")
{
	echo "selected";
}else{
?>					
					<form method="post" action="generateMeritlist.php?pId=<?php echo $_GET['pId'];?>&page=<?php echo $_GET['page'];?>">
					<input type="hidden" name="p_id" value="<?php echo $data_course_enrolled_query['p_id'];?>"/>
					<input type="hidden" name="user_id" value="<?php echo $data_course_enrolled_query['s_id'];?>"/>				   
					<label class="checkbox-inline">
					<input type="checkbox" name="selected" onChange="this.form.submit()" value="<?php $data_course_enrolled_query['s_id']?>">SELECT
					</label>
					</form>
					<?php
}
?>
					</td>
                    </tr>
					<?php
					}
					?>
    </tbody>
  </table>
</div>


</div>
</div>

<?php
include "assets/footer.php";
?>