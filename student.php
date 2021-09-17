<?php
	
	session_start();
if(!isset($_SESSION['id'])){
	header("Location:index.php");
}
if($_SESSION['category']!='student'){
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
	$query="SELECT courses
	FROM `master_student`
	WHERE id='".mysqli_real_escape_string($link,$_SESSION['id'])."'
	LIMIT 0 , 30";
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
	function findCourses($str) {
	    return explode(",",$str);
	}
	$courses=findCourses($row['courses']);
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
<br>
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
 <form class="margintop" method="post" action="student.php">
					<div class="input-group">
						
						<span class="input-group-addon">Course</span>
						 <select id="cat" type="course" name="course" class="form-control" >
							<option value="" selected disabled style="display:none;">Select Course</option>
							
							<?php
								include("connection.php");
								$query="SELECT courses
								FROM `master_student`
								WHERE username='".mysqli_real_escape_string($link,$_SESSION['username'])."'
								LIMIT 0 , 30";
								$result=mysqli_query($link,$query);
								$row=mysqli_fetch_array($result);
								 $courses=findCourses($row['courses']);
								foreach ($courses as $value){
									echo "<option value=".$value.">".$value."</option>";
								}
							?>
						</select> 
					</div>	
					<label></label>
					<br>
					<input type="submit" name="proceed" class="btn btn-success btn-bg margintop an" value="Proceed" />
				</form>  
				<hr>
				<!-- <br> -->
</div>

	<div class="container contentcontainer" id="topcontainer">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 am" id="toprow">
			<div class="questions">
			<form method="post">

<?php

if(isset($_POST['proceed']))
{
	$query="SELECT `status` FROM `master_student` WHERE 1";
	$result=mysqli_query($link,$query);
	$row=mysqli_fetch_array($result);
	if($row['status']==0)
	{
		echo "<div class='alert alert-warning'>The feedback submission for students is currently disabled. Please try again later.</div>";
	}

	else
	{
		$course=$_POST['course'];
		$_SESSION['course']=$course;
		echo '<h2 style="text-align:center">'.$course.'</h2><br><br>';
		// $type=$course[2];
		$query="SELECT `category` FROM `roll_list` WHERE `course`='".strtolower($course)."'";
		// echo $query;
		$row=mysqli_query($link,$query);
		$result=mysqli_fetch_array($row);
		$type=$result[0];
		// echo $type;
		$query="SELECT `submission_status` FROM `".strtolower($course)."` WHERE `entryno` = '".$_SESSION['username']."'";
		// echo $query;
		$result=mysqli_query($link,$query);
		$row=mysqli_fetch_array($result);
		// print_r($row);
		if($row['submission_status']=='1')
		{
			echo "<div class='alert alert-success'>You have already submitted the feedback for this course !!!</div>";
		}
		else
		{
			if(isset($type))
			{
				$query="SELECT * FROM `questions` WHERE type='".$type."'";
			}
			else
			{
				continue;
			}
			$result=mysqli_query($link,$query);
			$row=mysqli_fetch_array($result);
			 // print_r($row);
			
			end($row);
			$last_col=key($row);
			$last_col_num=substr($last_col,1);
			
			// q1
			// echo "<p text-align='left'>";
			echo "<div class=form-group>
					<fieldset id=q1><p><strong>1. ".$row[q1]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q1 value=0> CSE ";
			echo "<input type=radio name=q1 value=1> EE ";
			echo "<input type=radio name=q1 value=2> ME ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			// q2
			echo "<div class=form-group>
					<fieldset id=q2><p><strong>2. ".$row[q2]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q2 value=0> 0-5 ";
			echo "<input type=radio name=q2 value=1> 5-6 ";
			echo "<input type=radio name=q2 value=2> 6-7 ";
			echo "<input type=radio name=q2 value=3> 7-8 ";
			echo "<input type=radio name=q2 value=4> 8-9 ";
			echo "<input type=radio name=q2 value=5> 9-10 ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			// q3
			echo "<div class=form-group>
					<fieldset id=q3><p><strong>3. ".$row[q3]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q3 value=0> 0%-50% ";
			echo "<input type=radio name=q3 value=1> 50%-60% ";
			echo "<input type=radio name=q3 value=2> 60%-70% ";
			echo "<input type=radio name=q3 value=2> 70%-80% ";
			echo "<input type=radio name=q3 value=2> 80%-90% ";
			echo "<input type=radio name=q3 value=2> 90%-100% ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			// q4
			echo "<div class=form-group>
					<fieldset id=q4><p><strong>4. ".$row[q4]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q4 value=0> More than the scheduled lectures ";
			echo "<input type=radio name=q4 value=1> All scheduled lectures ";
			echo "<input type=radio name=q4 value=2> Less than the scheduled lectures ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			// q5
			echo "<div class=form-group>
					<fieldset id=q5><p><strong>5. ".$row[q5]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q5 value=0> Compulsory course ";
			echo "<input type=radio name=q5 value=1> Fit my interests ";
			echo "<input type=radio name=q5 value=2> Heard the professor is good ";
			echo "<input type=radio name=q5 value=3> Fit my schedule ";
			echo "<input type=radio name=q5 value=4> Other ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			// q6
			echo "<div class=form-group>
					<fieldset id=q6><p><strong>6. ".$row[q6]."</strong></p>"; 
			echo "<div class=radioButtonList>";
			echo "<input type=radio name=q6 value=1> Yes ";
			echo "<input type=radio name=q6 value=0> No ";
			// echo "<input type=radio name=q6 value=2> ME ";
			echo "</div>";
			echo "</fieldset>
						</div>
						<br><br>";

			

			$k=7;
			for ($i=7; $i <=$last_col_num ; $i++)
			{
				$temp="q".$i;
				$temp=$row[$temp];
				// echo $temp;
				if(isset($temp))
				{	
					echo "<div class=form-group>
					<fieldset id=q".$i."><p><strong>".$k.". ".$temp."</strong></p>";
					$k=$k+1;
						
					for ($j=0; $j <=5 ; $j++)
					{ 
						echo "<div class=radioButtonList >
						<input type=radio name=q".$i." value=".$j.">"." ".$j."
						</div>";
					}
					// print_r($_SESSION);

					echo "</fieldset>
						</div>
						<br><br>";
				}
			}
					
			// echo $k;
			echo '<div class=form-group>
				<div class="input-group">
				<span class="input-group-addon"><strong>'.$k.'. Comments</strong></span>
				<textarea style="resize: none;height:70px;width:400px;" name="comments" type="text" class="form-control"></textarea>
				</div>
				<br>
				<input type="submit" name="submit" class="btn btn-success feedback_submit" value="Submit"/>';
		}		
	}
}
if(isset($_POST['submit']))
{
	echo '<h2 style="text-align:center">'.$_SESSION['course'].'</h2><br><br>';
	echo '<div class="alert alert-success">You have successfully submitted the feedback for this course !!!</div>';

	$query1="SELECT * FROM `".strtolower($_SESSION['course'])."` WHERE `entryno`='".$_SESSION['username']."'";
	$result1=mysqli_query($link,$query1);
	$row1=mysqli_fetch_array($result1);
	// print_r($row);
			
	end($row1);
	$last_col=key($row1);
	$last_col_num=substr($last_col,1);
	
	// echo $last_col_num;
	
	$query="UPDATE `".strtolower($_SESSION['course'])."` SET `submission_status`=1,";
	
	// unset($_SESSION['course']);	
	// print_r($_POST);
	$k=1;
	// echo $k;
	// echo $type;

	// echo $last_col_num;
	for ($i=1; $i <=$last_col_num ; $i++)
	{
		$temp="q".$i;
		// echo $temp; 
		// $temp=$_POST[$temp];
		// echo $temp;
		if(isset($_POST[$temp]))
		{	
			$query.="`q".$k."`=".$_POST[$temp].",";
			$k=$k+1;
		}

	}
		$temp="comments";
		$query.="`comments`='".$_POST[$temp]."' WHERE `entryno`='".$_SESSION['username']."'";
	  	
	  // echo $query;
		mysqli_query($link,$query);
	// $query="UPDATE "	

}

?>
	</form>	
			</div>
			</div>
		</div>
	</div>

<br>
							<!-- <input type="submit" name="Select Course" class="btn btn-success " value="Course"/> -->
</div>
</div>
</div>
	<br>
		<br>
		<br>
		<br>

<script>


$(function () {
    var button = $('.feedback_submit').prop('disabled', true);
    var radios = $('input[type="radio"]');
    var arr    = $.map(radios, function(el) { 
                return el.name; 
              });

    var groups = $.grep(arr, function(v, k){
            return $.inArray(v ,arr) === k;
    }).length;

    radios.on('change', function () {
        button.prop('disabled', radios.filter(':checked').length < groups);
    });
});


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
</script>
  </body>

</html>
