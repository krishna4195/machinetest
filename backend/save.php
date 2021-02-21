<?php
include 'database.php';

if(count($_POST)>0){
	
	if($_POST['type']==1){
		
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=md5($_POST['password']);
		$uploaddir = 'uploads/;';
    $uploadfile = $uploaddir . basename($_FILES['userImage']['name']);

    
    if (move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadfile)) {
        //echo "File is valid, and was successfully uploaded.\n";
    } 
	$t=time();
	$filename=basename($_FILES['userImage']['name']);
	$filearray=explode(".",$filename);
	$filename=$filearray[0].$t;
	
		$sql = "INSERT INTO `users`( `name`, `email`,`password`,`phone`,`filename`,`user_type`) 
		VALUES ('$name','$email','$password','$phone','$filename','0')";
		
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$password=md5($_POST['password']);
		$uploaddir = 'uploads/;';
   		$uploadfile = $uploaddir . basename($_FILES['userImage']['name']);

    
    if (move_uploaded_file($_FILES['userImage']['tmp_name'], $uploadfile)) {
        //echo "File is valid, and was successfully uploaded.\n";
    } 
	$t=time();
	$filename=basename($_FILES['userImage']['name']);
	$filearray=explode(".",$filename);
	$filenamewithouttime=$filearray[0];
	$filename=$filearray[0].$t;
	$sql = "UPDATE `users` SET `name`='$name',`email`='$email',`phone`='$phone'";
	if($_POST['password']!=""){
		$sql = $sql.",`password`='$password' ";
	}

	if($filenamewithouttime !=""){
		$sql =$sql. ",`filename`= '$filename' ";

	}
		$sql =$sql. " WHERE id=$id";

	
	
		if (mysqli_query($conn, $sql)) {
			echo json_encode(array("statusCode"=>200));
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `users` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM users WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>