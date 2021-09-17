<?php
	
	session_start();
if(!isset($_SESSION['id'])){
	header("Location:index.php");
}
if($_SESSION['category']!='admin'){
	if(isset($_SESSION['category']))
	{
		header("Location:".$_SESSION['category'].".php");
	}
	else{
		header("Location:index.php");
	}
}
// print_r($_SESSION);
?>

<?php
	include("login.php");
	// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-2.1.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style type="text/css">
	.container{
		text-align: center;
	}
/*	.red:hover{
		background-color: red;
	}
*/
.radioButtonList {
    display:inline;
}
	.red{
    color: red;
}
.borderround {
	border:1px solid #DEDEDE;
	border-radius: 10px;

}
.righticon {
	float: right;
	
}
.table th{
	text-align: center;
}

.table td{
	text-align: center;
}


.smallfont {
	font-size: .8em;
}
.navbar{
	position: relative;
}
.logoimg {
			float: left;
			margin-right: 20px; 
			margin-top: -5px;
		}
	.linknone,.linknone:hover,.linknone:visited,.linknone:active,.linknone:link {
					text-decoration:none;
					color: #777;
	}
	tr.red:hover {
		color: red;
	}
	th.rotate {
  /* Something you can count on */
  height: 140px;
  white-space: nowrap;
}

th.rotate > div {
  transform: 
    /* Magic Numbers */
    
    /* 45 is really 360 - 45 */
    rotate(270deg);
  width: 30px;
}
th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 15px 10px;
}
.clearicon {
	float:right;
	margin-right: 20px;
	
}	
.borderbottom {
margin: 0;
}
  </style>
  </head>
 <body>
 	<?php 

 	// print_r($_SESSION);
	include("connection.php");
	$query="SELECT course
	FROM `roll_list`
	WHERE 1";
	$result=mysqli_query($link,$query);
	$allcourses=array();
	while ($row=mysqli_fetch_array($result)) {
		array_push($allcourses, $row[0]);
	}
	?>
	<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header pull-left">
			<div class="navbar-brand">Feedback Portal<a href="http://www.iitrpr.ac.in/" target="blank"><img class="logoimg" src="img/iitrpr.png" width="30px" height="30px"></a></div>
			
		</div>
		<div class="pull-right">
			<ul class="navbar-nav nav">
			<li><a href="logout.php">Log Out<?php echo " ".$_SESSION['username'] ?></a></li>
			</ul>
			
		</div>
	</div>
	</div>
<br>
<div class="container">
	<div class="row"><div class="col-md-2 col-md-offset-9">
	
<button type="button" class="btn btn-success btn-bg" data-toggle="modal" data-target="#myModal1">
  Update password
</button>
</div></div></div>


<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Password</h4>
      </div>
      <div class="modal-body">
        <form action="update_password.php" method="post">
			<label for="oldpassword"></label>
					<div class="input-group">
						<span class="input-group-addon">Old Password</span>
				<input id="oldpassword" name="oldpassword" type="password"  class="form-control">
			</div>
			<label for="newpassword"></label>
					<div class="input-group">
						<span class="input-group-addon">New Password</span>
				<input id="newpassword" name="newpassword" type="password"  class="form-control">
			</div>
			<div id="error" class="alert alert-danger" style="display:none;"></div>
			<label for="confirmpassword"></label>
					<div class="input-group">
						<span class="input-group-addon">Confirm Password</span>
				<input id="confirmpassword" name="confirmpassword" type="password"  class="form-control">
			</div>
					<br>

			<div id="message1" class="alert alert-danger" style="display:none;">Does not match</div>
			<div id="message2" class="alert alert-success" style="display:none;">Matching</div>
			
			<br>
      	<div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<input type="submit" id="changepassword" name="changepassword" class="btn btn-success btn-bg margintop an" value="Change password" />
      </div>
  </form>
      </div>
      
    </div>
  </div>
</div>


	<div class="container">
<div class="row">
<div class="col-md-4 am" id="toprow">
 <form class="margintop" method="post" action="admin.php">
					<div class="input-group">
						
						<span class="input-group-addon">Course</span>
						 <select id="cat" type="course" name="course" class="form-control" >
							<option value="" selected disabled style="display:none;">Select Course</option>
							
							<?php
								foreach ($allcourses as $value){
									echo "<option value=".$value.">".$value."</option>";
								}
							?>
						</select> 
					</div>	
					<label></label>
					<br>
					<input type="submit" name="proceed" class="btn btn-success btn-bg margintop an" value="Proceed" />
					<input type="submit" name="view_submit" class="btn btn-success btn-bg margintop an" value="View Students" />
					<input type="submit" name="subj_categ" class="btn btn-success btn-bg margintop an" value="Set Category" />
					<!-- <input type="submit" name="change_teacher" class="btn btn-success btn-bg margintop an" value="Change Teacher" /> -->
				</form>  
				<hr>
				<br>
</div>


<div class="col-md-4 am" id="toprow">
 <form class="margintop" method="post" action="admin.php">
					<div class="input-group">			
						<span class="input-group-addon">Category</span>
						 <select id="cat" type="category" name="category" class="form-control" >
							<option value="" selected disabled style="display:none;">Select Category</option>
							<option value="lecture">Lecture Only</option>
							<option value="practical">Practical Only</option>
							<option value="lecture_tutorial">Lecture and Tutorial</option>
							<option value="lecture_practical">Lecture and Practical</option>
							<option value="lecture_tutorial_practical">Lecture, Tutorial and Practical</option>
						</select> 
					</div>	
					<label></label>
					<br>
					<input type="submit" name="add_question" class="btn btn-success btn-bg margintop an" value="Add/Delete Question" />
				</form>  
				<hr>
				<br>
</div>

<div class="col-md-4">
	<br>
<form class="margintop" method="post" action="admin.php">
<div class=radioButtonList >
<p><b>Student Enable:</b>
	<?php

		$query="SELECT `status` FROM `master_student` WHERE 1";
		$row=mysqli_query($link,$query);
		$result=mysqli_fetch_array($row);
		if($result[0]==0)
		{
			echo '<input type="radio" name="student_enable" value=on> Enable
	<input type="radio" name="student_enable" value=off checked> Disable';
		}
		else
		{
			echo '<input type="radio" name="student_enable" value=on checked> Enable
	<input type="radio" name="student_enable" value=off> Disable';
		}

	?>
	
</div>
</p>

<br>
<div class=radioButtonList >
<p><b>Teacher Enable:</b>
		<?php

		$query="SELECT `status` FROM `master_teacher` WHERE 1";
		$row=mysqli_query($link,$query);
		$result=mysqli_fetch_array($row);
		if($result[0]==0)
		{
			echo '<input type="radio" name="teacher_enable" value=on> Enable
	<input type="radio" name="teacher_enable" value=off checked> Disable';
		}
		else
		{
			echo '<input type="radio" name="teacher_enable" value=on checked> Enable
	<input type="radio" name="teacher_enable" value=off> Disable';
		}

	?>

</div>
</p>
<input type="submit"  id="submit_button" name="stud_teach" class="btn btn-success btn-bg margintop an" value="Enable/Disable" />
</form>
</div>

<div class="row">
<div class="col-md-8 col-md-offset-2 am" col-id="toprow">

   
<?php
if(isset($_POST['proceed'])){
	$course=$_POST['course'];
	$_SESSION['course']=$course;
	echo '<h2 style="text-align:center">'.$course.'</h2><br>';

	$query="SELECT `category` FROM `roll_list` WHERE `course`='".strtolower($course)."'";
	// echo $query;
	$row=mysqli_query($link,$query);
	$result=mysqli_fetch_array($row);
	$type=$result[0];
	
	
	if(isset($type))
	{
		$query="SELECT * FROM `questions` WHERE type='".$type."'";
	}
	else
	{
		continue;
	}
		
	echo "<table class='table table-bordered'>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Question</th>
        <th>Average Rating</th>
      </tr>
    </thead>
        <tbody>
";
		

		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		// print_r($row);

		end($row);
		$last_col=key($row);
		$last_col_num=substr($last_col,1);
		// echo $last_col_num;
		// echo $last_col;

		$course2=strtolower($_SESSION['course']);
		$query3="SELECT SUM(submission_status) AS sum FROM ".$course2;
		$result3=mysqli_query($link,$query3);
		$row3=mysqli_fetch_array($result3);
		// print_r($row3);
		$iter=$row3['sum'];
		$total_students="SELECT COUNT(*) FROM feedback.".$course2;
		$total_students=mysqli_query($link,$total_students);
		$total_students=mysqli_fetch_array($total_students);

			echo "<h4>Number of Submissions: ".$iter."/".$total_students[0]."<h4>";

		
		
		$j=1;
		$global_sum=0;
		for ($i=7; $i <=$last_col_num ; $i++) 
		{
			$temp1="q".$i;
			$temp=$row[$temp1];
			if(isset($temp))
			{	
				$query3="SELECT SUM(".$temp1.") AS sum FROM ".$course2;
				$result3=mysqli_query($link,$query3);
				$row3=mysqli_fetch_array($result3);
				$global_sum=$global_sum+$row3['sum'];

				echo "<tr>
	        			<td>".$j."</td>
	        			<td>".$temp."</td>
	        			<td>".$row3['sum']/$iter."</td>
	      			</tr>";
	      		$j=$j+1;
			}
		}
		$num_ques=$j-1;

	echo " </tbody>
 	 </table>";

	$global_avg=$global_sum/$num_ques;
	echo "<h4 >Overall Rating of the teacher for the course: ".$global_avg."</h4><br>";				


echo "<table class='table table-bordered'>
    <thead>
      <tr>
        <th>Sr. No.</th>
        <th>Comments by Students</th>
      </tr>
    </thead>
        <tbody>";

$com=array();
$query="SELECT `comments` FROM `".$course2."` WHERE 1";
$result=mysqli_query($link,$query);
while ($row=mysqli_fetch_array($result)){
array_push($com, $row[0]);
}

for ($i=0; $i < sizeof($com); $i++) { 			
if (isset($com[$i])){
$j=$i+1;	
echo "<tr>
        <td>".$j."</td>
        <td>".$com[$i]."</td>
      </tr>";
}
}
	echo " </tbody>
 	 </table>
	<br><br>";
}
else if (isset($_POST['view_submit'])) {
	$course=$_POST['course'];
	$_SESSION['course']=$course;
	echo '<h2 style="text-align:center">'.$course.'</h2><br><br>';

	$query="SELECT `entryno`,`submission_status` FROM `".strtolower($_SESSION['course'])."` WHERE 1";
	$result=mysqli_query($link,$query);
	// echo $query;
	$entrynos=array();
	$submission_status=array();
	$disp_arr=array();
	while ($row=mysqli_fetch_array($result)) {
		// array_push($entrynos, $row[0]);
 		// array_push($submission_status, $row[1]);
 		$disp_arr[$row[0]]=$row[1];
 	}
 	ksort($disp_arr);
$i=0;
if (sizeof($disp_arr)>0) {

echo "<table class='table table-bordered'>
    <thead>
      <tr>
        <th>Entry Number</th>
        <th>Submission Status</th>
      </tr>
    </thead>
        <tbody>";
}
foreach ($disp_arr as $key => $value)
{
	     echo '<tr> 
        <td>'.$key.'</td><td';
	if($disp_arr[$key]==1){
			echo ' style="color: green">';
			echo '&nbsp &#x2713;';
		}
	else{
			echo ' style="color: red">';
			echo '&nbsp &#x2717;';
		}
		echo "</td>";
		$i++;

}
echo"</tbody>
</table>";
}


else if (isset($_POST['subj_categ']))
{
	$course=$_POST['course'];
	$_SESSION['course']=$course;
	if(isset($course))
	{
		$query="SELECT `category` FROM `roll_list` WHERE course='".strtolower($course)."'";
		$row=mysqli_query($link,$query);
		$result=mysqli_fetch_array($row);
		echo '<form action=admin.php method=POST>';
		echo '<h2 style="text-align:center">'.$course.'</h2><br><br>';
	
		if ($result[0]=='lecture_tutorial'){
		echo '<input type="checkbox" name="lec" checked> Lecture ';
		echo '<input type="checkbox" name="tut" checked> Tutorial ';
		echo '<input type="checkbox" name="prac" > Practical' ;
		} else if ($result[0]=='lecture'){
		echo '<input type="checkbox" name="lec" checked> Lecture ';
		echo '<input type="checkbox" name="tut" > Tutorial ';
		echo '<input type="checkbox" name="prac" > Practical' ;
		
		} else if($result[0]=='lecture_tutorial_practical'){
		echo '<input type="checkbox" name="lec" checked> Lecture ';
		echo '<input type="checkbox" name="tut" checked> Tutorial ';
		echo '<input type="checkbox" name="prac" checked > Practical' ;
		
		} else if ($result[0]=='lecture_practical'){
		echo '<input type="checkbox" name="lec" checked> Lecture ';
		echo '<input type="checkbox" name="tut" > Tutorial ';
		echo '<input type="checkbox" name="prac" checked> Practical' ;
		
		} else if ($result[0]=='practical'){
		echo '<input type="checkbox" name="lec" > Lecture ';
		echo '<input type="checkbox" name="tut" > Tutorial ';
		echo '<input type="checkbox" name="prac" checked> Practical' ;
		
		} 
		else {
		echo '<input type="checkbox" name="lec" > Lecture ';
		echo '<input type="checkbox" name="tut" > Tutorial ';
		echo '<input type="checkbox" name="prac"> Practical' ;
			
		}
		echo '<br><br><input type="submit" name="apply" class="btn btn-success btn-bg margintop an" value="Apply">';
		echo '</form>';
	}
}


if(isset($_POST['apply']))
{
	$course=$_SESSION['course'];
	$lec=$_POST['lec'];
	$tut=$_POST['tut'];
	$prac=$_POST['prac'];
	if($lec=='on' && !isset($tut) && !isset($prac))
	{
		$query="UPDATE `roll_list` SET `category`='lecture' WHERE `course`='".$course."'";
		mysqli_query($link,$query);
		$check=1;
	}
	elseif($lec=='on' && $tut=='on' && !isset($prac))
	{
		$query="UPDATE `roll_list` SET `category`='lecture_tutorial' WHERE `course`='".$course."'";
		mysqli_query($link,$query);
		$check=1;
	}
	elseif($lec=='on' && !isset($tut) && $prac=='on')
	{
		$query="UPDATE `roll_list` SET `category`='lecture_practical' WHERE `course`='".$course."'";
		mysqli_query($link,$query);
		$check=1;
	}
	elseif($lec=='on' && $tut=='on' && $prac=='on')
	{
		$query="UPDATE `roll_list` SET `category`='lecture_tutorial_practical' WHERE `course`='".$course."'";
		mysqli_query($link,$query);
		$check=1;
	}
	elseif(!isset($lec) && !isset($tut) && $prac=='on')
	{
		$query="UPDATE `roll_list` SET `category`='practical' WHERE `course`='".$course."'";
		mysqli_query($link,$query);
		$check=1;
	}

	if(!isset($check))
	{
		echo "<br>";
		echo "<br>";
		echo "<div class='alert alert-warning'>Please select a valid course category !!!</div>";
	}

}

if (isset($_POST['add_question']))
{
	if(isset($_POST['category']))
	{
	 
	 $_SESSION['type']=$_POST['category'];
		// echo $_POST['category'];
	$query="SELECT * FROM `questions` WHERE `type`='".$_POST['category']."'";
	$row=mysqli_query($link,$query);
	$result=mysqli_fetch_array($row);
	
    
    $i=1;
    echo "<table class='table table-bordered'>
		    		<thead>
		      		<tr>
		        	<th>Sr. No.</th>
		        	<th>Question</th>
		      		</tr>
		    		</thead>
		        	<tbody>";
    foreach ($result as $key=>$value)
	{	
		if($key[0]=='q')
		{	
			if(isset($value))
	    	{
		    	echo '<tr> 
	        	<td>'.$i.'</td>
	        	<td>'.$result[$key].'</td></tr>';
	        	$i++;
    		}
    	}
	}


echo"</tbody>
</table>";
echo '<form method="POST" action="admin.php">';
echo '<div class="input-group">
	<span class="input-group-addon">New Question</span>
	<textarea style="resize: none;height:70px;width:400px;" name="new_q" type="text" class="form-control"></textarea>
	</div><br>';

echo '<input type="submit" name="add" class="btn btn-success btn-bg margintop an" value="Add"> </form>';

}
}

if(isset($_POST['add']))
{
	// echo "dfsdfdg ".$categ;
	$query="SELECT * FROM `questions` WHERE 1";
	$row=mysqli_query($link,$query);
	$result=mysqli_fetch_array($row);
	
	end($result);
	$last_col_num=key($result);
	$last_col_num=substr($last_col_num,1);
	if(!is_numeric($last_col_num))
	{
		$last_col_num=0;
	}
	// $last_col_num=$last_col_num+1;
	$last_col="q".$last_col_num;
	
	// echo $last_col_num;
	$type=$_SESSION['type'];

	$newquery="SELECT * FROM `questions` WHERE `type`='".$type."'";
	// echo $newquery;
	$newrow=mysqli_query($link,$newquery);
	$newresult=mysqli_fetch_array($newrow);

	// print_r($newresult);
	// echo $last_col_num;
	// $updated=0;
	$i=1;
	$updated=0;
	for($i=1;$i<=$last_col_num;$i=$i+1)
	{
		$temp="q".$i;
		$updated=0;
		// echo $temp;
		if( array_key_exists($temp,$newresult) && !isset($newresult[$temp]))
		{
			$query="UPDATE `questions` SET `".$temp."`='".$_POST['new_q']."' WHERE `type`='".$type."'";
			// echo $query;
			mysqli_query($link,$query);
			$updated=1;
			break;
		}
	}
	// echo " ".$last_col_num;
	// echo " ".$updated;
	// echo " ".$i;
	if($i==1 && $updated!=1)
	{
		$temp="q".$i;
		$query="ALTER TABLE `questions`
		ADD ".$temp." text";		
	
		mysqli_query($link,$query);
		$query="UPDATE `questions` SET `".$temp."`='".$_POST['new_q']."' WHERE `type`='".$type."'";
		mysqli_query($link,$query);

	}
	elseif($i==($last_col_num+1) && $updated!=1)
	{
		$temp="q".$i;
		$temp1="q".($i-1);
		// echo $temp;
		if(isset($newresult[$temp1]))
		{
			$query="ALTER TABLE `questions`
			ADD ".$temp." text";		
	
			mysqli_query($link,$query);
			$query="UPDATE `questions` SET `".$temp."`='".$_POST['new_q']."' WHERE `type`='".$type."'";
			mysqli_query($link,$query);
			
		}
	}


	// $type=$_SESSION['type'];
	 // echo $type;
	unset($_SESSION['type']);
	$query="SELECT `course` FROM `roll_list` WHERE `category`='".$type."'";
	// echo $query;
	$row=mysqli_query($link,$query);
	while($result=mysqli_fetch_array($row))
		{
			$query2="SELECT * FROM `".strtolower($result[0])."` WHERE 1";
			$row2=mysqli_query($link,$query2);
			$result2=mysqli_fetch_array($row2);
	
			end($result2);
			$last_col=key($result2);
			$last_col="q".(substr($last_col,1)+1);
			$query="ALTER TABLE `".strtolower($result[0])."` ADD ".$last_col." int";
		 	mysqli_query($link,$query);
		 	// mysqli_query($link,$query);
			$query3="UPDATE `".strtolower($result[0])."` SET `".$last_col."`='".$_POST['new_q']."' WHERE `type`='".$type."'";
			mysqli_query($link,$query3);
	
			// echo $result[0];
		}
}


if (isset($_POST['stud_teach']))
{
	
	 if($_POST['student_enable']=="on")
	 {
	 	$query="UPDATE `master_student` SET `status`=1";
	 	mysqli_query($link,$query);
		// $_SESSION['student_value']=1;
	 }
	 elseif ($_POST['student_enable']=="off")
	 {
	 	$query="UPDATE `master_student` SET `status`=0";
	 	mysqli_query($link,$query);
	 	// $_SESSION['student_value']=0;
	 }

	 if($_POST['teacher_enable']=="on")
	 {
	 	$query="UPDATE `master_teacher` SET `status`=1";
		mysqli_query($link,$query); 
			 	// $_SESSION['teacher_value']=1;

	 }
	 elseif ($_POST['teacher_enable']=="off") 
	 {
	 	$query="UPDATE `master_teacher` SET `status`=0";
	 	mysqli_query($link,$query);
	 				 	// $_SESSION['teacher_value']=0;

	 }
	// echo "<script> DoPost(); </script>";
}
?>


</div>
</div>

<?php


?>
<script>


$('#newpassword').on('keyup', function (){
	var reg = new RegExp(`[A-Z]`);
	 var VAL=$(this).val();
	if ($(this).val().length<8){ 
			$('#error').html('Please enter a password with at least 8 character');
			$('#error').show();
			}
	
     else if (!reg.test(VAL)) {
      		$('#error').html('Please enter at least one capital letter');
     		$('#error').show();
	 }

	else {
		$("#error").hide();
	}
});

$('#confirmpassword').on('keyup', function () {
    if ($(this).val() == $('#newpassword').val() && $('#newpassword').val().length>7 ) {
        // $('#message').html('matching').css('color', 'green');
   		if ($('#oldpassword').val().length!=0) {
   		$('#message1').hide();
   		$('#message2').show();
   		$('#changepassword').prop('disabled', false);	   		
	   	}
	   } else  {

    	$('#message2').hide();
    	$('#message1').show();
   		$('#changepassword').prop('disabled', true);
    }
    // $('#message').html('not matching').css('color', 'red');
});
// var q="<?php echo (isset($_GET['changepass']))?$_GET['changepass']:'';?>";
if ($('#confirmpassword').val().length==0 || $('#newpassword').val().length==0 || $('#oldpassword').val().length==0 || $('#newpassword').val().length<8)
{
	   		$('#changepassword').prop('disabled', true);

 }

$('#submit_button').click(
	setTimeout(function(){ location.reload(admin.php); }, 1000)});
// $('#submit_button').click.setTimeout(function(){location.reload(true)},20000);

</script>
  </body>

</html>
