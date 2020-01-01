<?php 
	session_start();
	require '../php_script/connect.inc.php';
	$con=mysqli_connect("localhost","root","","ibank");
//	if(!$_SESSION['acc_no'])
//	{
//		header("location: login.php");
//	}
//	else
//	{	
		$acc_number = $_SESSION['acc_no'];
	//	$query_withdraw = "SELECT * FROM $mysql_db.$mysql_transaction_withdraw WHERE `acc_no`='$acc_number' ORDER BY `dow` DESC LIMIT 5";
	//	$result1 = mysql_query($query_withdraw);

		$query_transfer = "SELECT * FROM transactiont WHERE acc_no='$acc_number' ORDER BY dot DESC LIMIT 5;";
		$result2 = $con->query($query_transfer);

		if(!$result2){
			echo "<center> <p style='padding: 5px;background-color:red;'> Something went wrong.Please try again. </p>	</center>";
		}
		else
		{
			//$display_withdraw = array();
			//$index1 = 0;
			//while($row1 == result1->fetch_assoc())
			//{
			//	$display_withdraw[$index1] = $row1;
		//		$index1++;
		//	}


			$display_transfer = array();
			$index2 = 0;
			while($row2 =$result2->fetch_assoc())
			{
				$display_transfer[$index2] = $row2;
				$index2++;
			}
		}
		
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<TITLE>iBank Inc:. Personal Banking</TITLE>
		<link rel="icon" type="image/png" href="../images/head-icon.png" />
		<link type="text/css" rel="stylesheet" href="../style.css" />
		<link type="text/css" rel="stylesheet" href="../style_about.css" />
	</HEAD>
	<BODY>
		<div class="header">
			<div class="headerlogo">
				<img src="../images/header-logo.png" alt="LOGO" style="height: 80px; width: 80px;" ></img>
			</div>
			<div class="headername">
				iBANK.
			</div>
			<div class="headerDesc">
				The Only Bank You Can Trust.
			</div>
			<a href="../acc_info.php" alt="Home Page">
				<div class="hometab">
					HOME
				</div>
			</a>
			<a href="../account/settings.php" alt="login">
				<div class="logintab" style="width: 6em;">
					&nbsp;SETTINGS&nbsp;
				</div>
			</a>
			<a href="../logout.php" alt="Register">
					<div class="registertab" style="left: 55em;">
						LOGOUT
					</div>
			</a>

			<div class="about_tab" style="left: 61.4em;">
				<ul id="menu-nav">
					<li> &nbsp;TRANSACTION
							<ul>
								<a href="./transfer.php"><li style="margin-left: -9px;">TRANSFER</li></a>
								<a href="./withdraw.php"><li style="margin-left: -9px;">WITHDRAW</li></a>
								<a href="./ministatement.php"><li style="margin-left: -9px;">MINI-STATEMENT</li></a>
							</ul>
					</li>
				</ul>
			</div>

			
		</div>

		<div class="about_comp_desc" style="margin-bottom: 5em;position: absolute; border-radius: 10px;left: 20%; top: 8em;height: auto; width: 20em; padding-top: 40px;font-size: 25px;">
			<center>Mini - Statement of Last 5 Transactions.</center>
				<div class="mini_statement">

<table border="50px">
	<tr>
			
			<th class="info_table"> Withdraw Transaction Information (Last 5)</th>
			<th class="date_table"> Date </th>
	</tr>
</table>

<br>

<table border="50px">
	<tr>
			
			<th class="info_table"> Transfer Transaction Information (Last 5)</th>
			<th class="date_table"> Date </th>
	</tr>
		<?php
		if(count($display_transfer)==0)
		{
			echo "<tr>";
					echo "<td class='info_table' colspan='2'><center> --- No Transfers From Your Account --- </center></td>";
			echo "</tr>";
		}
		for($i=0;$i<count($display_transfer);$i++)
		{
			echo "<tr>";
					echo "<td class='info_table'>".$display_transfer[$i]['tid']."</td>";
					echo "<td class='date_table'>".$display_transfer[$i]['dot']."</td>";
			echo "</tr>";
		}
	?>
</table>
				</div>
		</div>
		<div class="footer" style="bottom: 0; position: fixed;">	
			<div class="footer_elements">
				<ul>
					<li style="margin-left: 10px;float: left; margin-top: 19px;"><?php
							$user_ip = $_SERVER['REMOTE_ADDR'];
							echo 'Your IP ADDRESS : '.$user_ip;
						?>
					</li>
					<li> While using this site, you agree to have read and accepted our terms of use, cookie and privacy policy.
						<br/>
						&copy; Copyright 1999-2015 by iBank.Ltd. &reg; All Rights Reserved.
					</li>
				<ul>
			</div>
		</div>
	</BODY>
</HTML>