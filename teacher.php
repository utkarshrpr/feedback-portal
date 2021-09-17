<?php
	
	session_start();
if(!isset($_SESSION['id'])){
	header("Location:index.php");
}
if($_SESSION['category']!='teacher'){
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
	$query="SELECT courses
	FROM `master_teacher`
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
 <form class="margintop" method="post" action="teacher.php">
					<div class="input-group">
						
						<span class="input-group-addon">Course</span>
						 <select id="cat" type="course" name="course" class="form-control" >
							<option value="" selected disabled style="display:none;">Select Course</option>
							
							<?php
								include("connection.php");
								$query="SELECT courses
								FROM `master_teacher`
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
				<br>
</div>


<div class="row">
<div class="col-md-8 col-md-offset-2 am" col-id="toprow">

   
<?php
if(isset($_POST['proceed']))
{
	$query="SELECT `status` FROM `master_teacher` WHERE 1";
	$result=mysqli_query($link,$query);
	$row=mysqli_fetch_array($result);
	if($row['status']==0)
	{
		echo "<div class='alert alert-warning'>The feedback portal for teachers is currently disabled. Please try again later.</div>";
	}

	else
	{

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

		end($row);
		$last_col=key($row);
		$last_col_num=substr($last_col,1);
		
		$course2=strtolower($_SESSION['course']);
		$query3="SELECT SUM(submission_status) AS sum FROM ".$course2;
		$result3=mysqli_query($link,$query3);
		$row3=mysqli_fetch_array($result3);

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
	echo "<h4 >Your Overall Rating for the course: ".$global_avg."</h4><br>";

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
}
?>

</div>
</div>


<script>


$('#newpassword').on('keyup', function (){
	var reg = new RegExp(`[A-Z]`);
	 var VAL=$(this).val();
	if ($(this).val().length<8){ 
			$('#error').html('Please enter a password with at least 8 characters');
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
