<?php
include("connection.php");
// $str = $row['students'];
// $students=explode(",",$str);
// foreach ($students as $entry_no){
// 	$entry_no=trim($entry_no);
//   $add_query.="`".$entry_no."` int(11) NOT NULL DEFAULT '0',";
//  }
//   $add_query.="PRIMARY KEY (`id`)
// ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1" ;


$sql="SELECT * FROM `roll_list` WHERE '1'";
$result=mysqli_query($link, $sql);
while($row=mysqli_fetch_array($result)){
$add_query="CREATE TABLE IF NOT EXISTS `".$row['course']."` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entryno` text NOT NULL,
  `submission_status` tinyint(1) NOT NULL DEFAULT '0',";
  
  for ($i=1; $i<=15; $i+=1)
  { 
    $add_query.="`q".$i."`tinyint(1),";
  }
  $add_query.="`q16` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

mysqli_query($link, $add_query);

$str = $row['students'];
$students=explode(",",$str);
foreach ($students as $entry_no){
  $entry_no=trim($entry_no);
  $add_query="INSERT INTO `feedback`.`".$row['course']."`(`id`, `entryno`, `submission_status`) VALUES (NULL,'".$entry_no."','0')";
  mysqli_query($link, $add_query);
}

$add_query="CREATE TABLE IF NOT EXISTS `master_student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` text NOT NULL,
  `courses` text,
  `username` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `forgot_code` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
mysqli_query($link, $add_query);

$add_query="CREATE TABLE IF NOT EXISTS `master_teacher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `courses` text,
  `forgot_code` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
mysqli_query($link, $add_query);


// $add_query="CREATE TABLE IF NOT EXISTS `questions` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `type` text,";
  
//   for ($i=1; $i<=15; $i+=1)
//   { 
//     $add_query.="`q".$i."`text,";
//   }
//   $add_query.=" PRIMARY KEY (`id`)
// ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
// mysqli_query($link, $add_query);

// $add_query="CREATE TABLE IF NOT EXISTS `questions` (
//   `id` int(11) NOT NULL AUTO_INCREMENT,
//   `teacher` text NOT NULL,
//   `student` text NOT NULL,
//   `message` text NOT NULL,
//   `show_teacher` tinyint(1) NOT NULL DEFAULT '1',
//   `show_student` tinyint(1) NOT NULL DEFAULT '1',
//   PRIMARY KEY (`id`)
// ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
// mysqli_query($link, $add_query);


}
?>