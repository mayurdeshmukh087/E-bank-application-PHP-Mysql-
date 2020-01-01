<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_id =$_POST['email_id'];
$password = $_POST['password1'];
$mobile_no = $_POST['mobile_no'];

$con= mysqli_connect('localhost','root','','ibank');
$query="INSERT INTO customer(acc_no,first_name,last_name,email_id,password,mobile_no,balance) VALUES(NULL,'$first_name','$last_name','$email_id','$password','$mobile_no','1000')";

if(isset($_POST['register']))
	{
		if(!empty($_POST['first_name'])&&!empty($_POST['last_name'])&&!empty($_POST['email_id'])&&!empty($_POST['password1'])&&!empty($_POST['password2'])&&!empty($_POST['mobile_no']))
		{
			if(isset($_POST['first_name'])&&isset($_POST['last_name'])&&isset($_POST['email_id'])&&isset($_POST['password1'])&&isset($_POST['password2'])&&isset($_POST['mobile_no']))
			{

				if($_POST['password1']===$_POST['password2'])
				{
					if(strlen($_POST['password1'])>=8&&is_numeric($_POST['mobile_no'])&&strlen($_POST['mobile_no'])==10)
					{
if($con->query($query)){
	echo "<center> <p style='padding: 5px;background-color:green; color: white;'> Transfered Amount to Account Number - ".$acc_no." Successfully.</p>	</center>";
    echo "<center> <p style='padding: 5px;background-color:green; color: white;'> Transaction id - <strong><u>".$token_save."</u></strong></p>	</center>";
header("location:register.php");
}
}
}
}
}
}
else if(strlen($_POST['password1'])<8){
echo "<center> <p style='padding: 5px;background-color:red;'>Password too short. (Min 8 characters length)</p>	</center>";
}
else if(!is_numeric($_POST['mobile_no'])||strlen($_POST['mobile_no'])!=10){
							echo "<center> <p style='padding: 5px;background-color:red;'>Enter a valid Mobile Number.</p>	</center>";
					}
								else
				{
					echo "<center> <p style='padding: 5px;background-color:red;'>Password didn't match. Please try again.</p>	</center>";
				}

 ?>