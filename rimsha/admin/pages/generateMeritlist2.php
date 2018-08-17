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
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE merit_list_no='1' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$countData = $course_count->fetch(PDO::FETCH_ASSOC);
$perpage = $countData['t_seats'];
$remaining = $perpage-$selectedCount;
if(isset($_POST['selected']))
{
	$query=$class->insert("UPDATE `meritlist` SET `status`='selected' WHERE `p_id` = '$_POST[p_id]' and `s_id` = '$_POST[user_id]'");		
	$query=$class->insert("UPDATE `course_enrolled` SET `status`='selected' WHERE `p_id` = '$_POST[p_id]' and `user_id` = '$_POST[user_id]'");
	if(isset($_GET['remaining']))
	{
	header("location:generateMeritlist.php?remaining=".$_GET['remaining']."&pId=".$_GET['pId']."&page=".$_GET['page']);
	}else{
	header("location:generateMeritlist.php?pId=".$_GET['pId']."&page=".$_GET['page']);
	}
}

if(isset($_GET["page"])){
$page = intval($_GET["page"]);
	
}
else {
$page = 1;
}

$calc = $perpage * $page;
$start = $calc - $perpage;
$reports_query = $class->fetchdata("SELECT * FROM `reports` WHERE `p_id`='$_GET[pId]' and `admin_id`='$user_id' and merit_list_no='$_GET[page]'");
$reports_counts = $reports_query->rowCount();
if($reports_counts==0)
{
$class->insert("INSERT INTO `reports`(`p_id`, `admin_id`, `merit_list_no`) VALUES('$_GET[pId]','$user_id','$_GET[page]')");
}
include "assets/main_header.php";		

if($countData['quota']=='Quota System')
{
	//echo "Quota System";
if(isset($_GET['pId']))
{
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


if(!empty($countData['kpk']))
{
$fedperpage = $countData['kpk'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'KPK' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
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
if(!empty($countData['bal']))
{
$fedperpage = $countData['bal'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'Balochistans' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
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
if(!empty($countData['fata']))
{
$fedperpage = $countData['fata'];

$calc = $fedperpage * $page;
$start = $calc - $fedperpage;
$course_Merit_query = $class->fetchdata("SELECT * FROM meritlist WHERE `p_id`='$_GET[pId]' and `s_domicile` = 'Fata' and `admin_id`='$user_id' order by s_aggregate desc Limit $start, $fedperpage");
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

/// second page logic here


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
if(!empty($countData['sindh']))
{
$perpage = $countData['sindh'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'Sindh' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $fedperpage-$selectedCount;
$perpage = $secondPerpage;
}
$course_enrolled_query_sindh = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Sindh' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
if(!empty($countData['kpk']))
{
$perpage = $countData['kpk'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'KPK' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $fedperpage-$selectedCount;
$perpage = $secondPerpage;
}
$course_enrolled_query_kpk = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'KPK' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
if(!empty($countData['bal']))
{
$perpage = $countData['bal'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'Balochistans' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $fedperpage-$selectedCount;
$perpage = $secondPerpage;
}
$course_enrolled_query_bal = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Balochistans' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
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
$course_enrolled_query_federal = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Federal' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
if(!empty($countData['fata']))
{
$perpage = $countData['fata'];
if($page>1)
{
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE `p_id`='$_GET[pId]' and s_domicile = 'Fata' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
$secondPerpage = $fedperpage-$selectedCount;
$perpage = $secondPerpage;
}
$course_enrolled_query_fata = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and s_domicile = 'Fata' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
}
//isset pId close here
}

		
?>
<div class="row">
<div class="col-md-12">

<a class="btn btn-info" href="Genearate_Reports.php?pId=<?php echo $_GET['pId'];?>&merit_list_no=<?php echo $_GET['page'];?>">Genearate Reports</a>

<?php
include "generateMeritlistSeatsCount.php";
if(!empty($countData['punjab']))
{
?>
<div class="table-responsive">
 <table class="table table-hover table-bordered">
     <caption>Punjab</caption>
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
	$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_punjab->fetch(PDO::FETCH_ASSOC))
		{
	
if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_punjab`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}
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
if(!empty($countData['sindh']))
{
?>
<div class="table-responsive">

 <table class="table table-hover table-bordered">
 <caption>Sindh</caption>
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
		$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_sindh->fetch(PDO::FETCH_ASSOC))
		{
			if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_sindh`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}
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
if(!empty($countData['kpk']))
{
?>
<div class="table-responsive">

 <table class="table table-hover table-bordered">
 <caption>KPK</caption>
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
		$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_kpk->fetch(PDO::FETCH_ASSOC))
		{
			if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_kpk`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}
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
if(!empty($countData['bal']))
{
?>
<div class="table-responsive">

 <table class="table table-hover table-bordered">
 <caption>Balochistan</caption>
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
		$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_bal->fetch(PDO::FETCH_ASSOC))
		{
			if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_bal`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}
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
if(!empty($countData['fed']))
{?>
<div class="table-responsive">

 <table class="table table-hover table-bordered">
 <caption>Federal</caption>
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
		$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_federal->fetch(PDO::FETCH_ASSOC))
		{
			if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_fed`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}	
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
if(!empty($countData['fata']))
{
?>
<div class="table-responsive">

 <table class="table table-hover table-bordered">
 <caption>Fata</caption>
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
		$i=0;
		while($data_course_enrolled_query=$course_enrolled_query_fata->fetch(PDO::FETCH_ASSOC))
		{
			if($reports_counts>0)
{
	$last = $course_enrolled_query_punjab->rowCount()-1;
	if($i==0)
	{
	echo $starting1 = "Starting Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$starting2 = "";
	if($i==$last){
	echo $starting2 = "Closing Merit ".$data_course_enrolled_query['s_aggregate'];
	}
	$i++;
$starting_n_end_punjab = $starting1."_".$starting2;
$class->insert("UPDATE `reports` SET `starting_n_end_fata`='$starting_n_end_punjab' where  `p_id`='$_GET[pId]' and merit_list_no = '$_GET[page]' and `admin_id`='$user_id' ");
}	
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
</div>
</div>
<?php
}else{
	echo "<h1>No Quota System</h1>";
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
}
$course_enrolled_query = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $perpage");
if($page>1)
{
if($_GET['remaining'])
{
//$perpage = $remaining;

$perpage = $_GET['remaining'];
echo " Total Seats in ".$_GET['page']." Merit List is :".$perpage."<br>";
$selected_count = $class->fetchdata("SELECT * FROM `meritlist` WHERE merit_list_no='$_GET[page]' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' and status='selected'");
$selectedCount = $selected_count->rowCount();
echo " Total Seats Left : ".$remaining = $_GET['remaining']-$selectedCount;
echo " <br>Total Selected Seats : ".$selectedCount;
$course_enrolled_query = $class->fetchdata("SELECT * FROM meritlist WHERE merit_list_no='$_GET[page]' and `p_id`='$_GET[pId]' and `admin_id`='$user_id' order by s_aggregate desc Limit $_GET[remaining]");

}
}
}
?>
<div class="row">
<div class="col-md-12">
<a class="btn btn-info" href="Genearate_Reports.php?pId=<?php echo $_GET['pId'];?>&merit_list_no=<?php echo $_GET['page'];?>">Genearate Reports</a>

<div class="row">
<div class="col-md-6">
<ul class="pagination <?php if($course_Merit_query->rowCount()==0){echo "hidden";}?>">
<li><a target="_blank" href="generateMeritlist.php?remaining=<?php echo $remaining; ?>&pId=<?php echo $_GET['pId'];?>&page=<?php echo $page+1;?>">Generate Merit List <?php echo $page+1;?></a></li>	
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
		//echo $course_enrolled_query->rowCount();
		while($data_course_enrolled_query=$course_enrolled_query->fetch(PDO::FETCH_ASSOC))
		{
		?>
									<tr class="odd gradeX">
                                        
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

if(isset($_GET['remaining']))
{?>
					<form method="post" action="generateMeritlist.php?remaining=<?php echo $_GET['remaining']; ?>&pId=<?php echo $_GET['pId'];?>&page=<?php echo $_GET['page'];?>">
<?php
}else{
?>
<form method="post" action="generateMeritlist.php?pId=<?php echo $_GET['pId'];?>&page=<?php echo $_GET['page'];?>">	
<?php
}
?>					<input type="hidden" name="p_id" value="<?php echo $data_course_enrolled_query['p_id'];?>"/>
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
}
include "assets/footer.php";
?>