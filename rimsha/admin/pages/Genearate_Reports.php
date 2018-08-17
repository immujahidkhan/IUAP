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
		$p_id = $_GET['pId'];
		$merit_list_no = $_GET['merit_list_no'];
		$reportsQuery=$class->fetchdata("SELECT * FROM `reports` WHERE p_id ='$p_id' and merit_list_no = '$merit_list_no'");
		$Details=$reportsQuery->fetch(PDO::FETCH_ASSOC);
		
		$Query1=$class->fetchdata("SELECT * FROM `programs` WHERE id ='$p_id'");
		$PDetails=$Query1->fetch(PDO::FETCH_ASSOC);
		$p_name = $PDetails['title'];


include "assets/main_header.php";		
?>
<div class="row">
<div class="col-md-12">
<h3><a >Reports</a></h3>
 <div class="table-responsive">
 <table class="table table-hover table-bordered">
    <thead>
      <tr>
        <th><?php echo $p_name;?></th>
      </tr>
    </thead>
    <tbody>
	<?php 
	if(!empty($Details['starting_and_closing']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_and_closing'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and ".$pieces[1]." ";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_punjab']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_punjab'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and ".$pieces[1]." of Punjab";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_sindh']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_sindh'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and  ".$pieces[1]." of Sindh";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_kpk']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_kpk'];
		$pieces = explode("_", $string);
	echo $pieces[0]." and ".$pieces[1]." of KPK";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_bal']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_bal'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and  ".$pieces[1]." of Balochistan";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_fed']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_fed'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and ".$pieces[1]." of Federal";
	?>
	</td>
	</tr>
	<?php
	}
	if(!empty($Details['starting_n_end_fata']))
	{?>
	<tr>
	<td>
	<?php
	$string = $Details['starting_n_end_fata'];
	$pieces = explode("_", $string);
	echo $pieces[0]." and ".$pieces[1]." of Fata";
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