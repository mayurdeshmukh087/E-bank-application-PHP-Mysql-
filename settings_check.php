<?php 
	session_start();
	//require '../php_script/connect.inc.php';
	if(!$_SESSION['acc_no'])
{
	header("location: login.php");
	}
	else
	{
	$con = new mysqli('localhost', 'root', '', 'ibank');
		
			if(!empty($_POST['newpassword1'])&&!empty($_POST['newpassword2']))
			{
				$newpassword1 =$_POST['newpassword1'];
				$newpassword2 =$_POST['newpassword2'];
				if($newpassword1!=$newpassword2)
					echo "<center> <p style='padding: 5px;background-color:red;'> Both the password didnot match! Please enter Again.</p>	</center>";
				else
				{
					$acc_id = $_SESSION['acc_no'];
					$newpassword = md5($newpassword1);
					$query = "UPDATE customer SET password='$newpassword1' WHERE acc_no='$acc_no'";
					$result = $con->query($query);
					if(!$result)
						echo "<center> <p style='padding: 5px;background-color:red;'> Something Went Wrong. Please try again.</p>	</center>";	
					else
					{
						session_destroy();
						echo "<center> <p style='padding: 5px;background-color:green;'> Password Changed Successfully. Please log in Again.</p>	</center>";
						header('Refresh: 2; url=login.php');
					}
				}
			}
}		
	
?>
