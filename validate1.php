<?php 

$acc_no=$_POST['acc_no'];
$email_id = $_POST['email_id'];
$pass = $_POST['pass'];

//database connection
$con = new mysqli('localhost', 'root', '', 'ibank');

$a = "SELECT * FROM customer WHERE  acc_no='$acc_no' AND email_id='$email_id' AND password='$pass'";


$result = $con->query($a);

if($result->num_rows == 1){
//	session_start();
//	$_SESSION['id'] = session_id();
	while ($row=$result->fetch_assoc()) {
		# code...
		echo "success";
			echo "NAME  :". $row["first_name"]." ".$row["last_name"];
			echo "EMAIL :". $row["email_id"]; echo "ACCOUNT_NO :".$row["acc_no"]; ;
	//}
	//header("location: acc_info.php");
}
}
else{
	echo "Invalid Email or Password";
}


 ?>