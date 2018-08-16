<?php
include "generateMeritlistHeader.php";

$course_count = $class->fetchdata("SELECT * FROM `admin_criteria_list` WHERE `p_id`='$_GET[pId]' and `user_id`='$user_id'");
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$countData = $course_count->fetch(PDO::FETCH_ASSOC);

$perpage = $countData['t_seats'];
$secondPerpage = $perpage-$selectedCount;
//echo $_GET["page"];
if(isset($_GET["page"])){
$page = intval($_GET["page"]);
	
}
else {
$page = 1;
}
include "assets/main_header.php";
if($countData['quota']=='Quota System')
{
	//echo "Quota System";
if(isset($_GET['pId']))
{
if(!empty($countData['sindh']))
{
$fedperpage = $countData['sindh'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'Sindh' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
while($MeritGenerate=$course_Merit_query->fetch(PDO::FETCH_ASSOC))
{
if($page==1)
{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='1' WHERE id = '$MeritGenerate[id]'");
}else{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='$page' WHERE id = '$MeritGenerate[id]'");
}
}
}
if(!empty($countData['fed']))
{
$fedperpage = $countData['fed'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'Federal' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
while($MeritGenerate=$course_Merit_query->fetch(PDO::FETCH_ASSOC))
{
if($page==1)
{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='1' WHERE id = '$MeritGenerate[id]'");
}else{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='$page' WHERE id = '$MeritGenerate[id]'");
}
}
}
if(!empty($countData['punjab']))
{
$punjabperpage = $countData['punjab'];
$calc = $punjabperpage * $page;
$start = $calc - $punjabperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'Punjab' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $punjabperpage");
while($MeritGenerate=$course_Merit_query->fetch(PDO::FETCH_ASSOC))
{
if($page==1)
{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='1' WHERE id = '$MeritGenerate[id]'");
}else{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='$page' WHERE id = '$MeritGenerate[id]'");
}
}
}


if(!empty($countData['fed']))
{
$perpage = $countData['fed'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'Federal' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $fedperpage-$selectedCount;
$perpage = $secondPerpage;
}
$course_enrolled_query = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Federal' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
if(!empty($countData['punjab'])){
$perpage = $countData['punjab'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'Punjab' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $punjabperpage-$selectedCount;
$perpage = $secondPerpage;
}

$course_enrolled_query_punjab = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Punjab' and  `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");	
}
}

		
?>
<div class="row">
<div class="col-md-12">

<?php
include "generateMeritlistSeatsCount.php";

?>
<div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Id</th>
		<th>Program Name</th>
        <th>Student Name</th>
		<th>Student Email</th>
		<th>Student CNIC</th>
		<th>Domicile District</th>
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

<div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Id</th>
		<th>Program Name</th>
        <th>Student Name</th>
		<th>Student Email</th>
		<th>Student CNIC</th>
		<th>Domicile District</th>
		<th>Aggregate</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody>
		<?php
		while($data_course_enrolled_query=$course_enrolled_query_punjab->fetch(PDO::FETCH_ASSOC))
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
}else{
	//echo "No Quota System";
$fedperpage = $countData['t_seats'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
while($MeritGenerate=$course_Merit_query->fetch(PDO::FETCH_ASSOC))
{
if($page==1)
{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='1' WHERE id = '$MeritGenerate[id]'");
}else{
	$class->insert("UPDATE `meritlist` SET `merit_list_no`='$page' WHERE id = '$MeritGenerate[id]'");
}
}
$course_enrolled_query = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $fedperpage");

?>
<div class="row">
<div class="col-md-12">

<?php
include "generateMeritlistSeatsCount.php";

?>
<div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th>Id</th>
		<th>Program Name</th>
        <th>Student Name</th>
		<th>Student Email</th>
		<th>Student CNIC</th>
		<th>Domicile District</th>
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

<?php
}
?>
<?php
include "assets/footer.php";
?>