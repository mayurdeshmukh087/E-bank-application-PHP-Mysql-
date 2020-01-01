<?php 
session_start();

	require '../php_script/connect.inc.php';
    require 'encrypt.php';
	$con= mysqli_connect("localhost","root","","ibank");
//	if(!$_SESSION['acc_no'])
//	{
//		header("location: login.php");
//	}
	
	//{
		
			if(!empty($_POST['acc_no'])&&!empty($_POST['amt'])&&!empty($_POST['pass']))
			{
//				$acc_id = $_SESSION['acc_id'];
				$acc_no =$_POST['acc_no'];
				$password = $_POST['pass'];
				$amount = $_POST['amt'];

				if(is_numeric($acc_no))
				{
					if(is_numeric($amount))
					{
						$query = "SELECT * FROM customer WHERE acc_no='$acc_no'";
						$result =$con->query($query);
						if(!$result)
							echo "<center> <p style='padding: 5px;background-color:red;'> Something Went Wrong. Please Try Again. </p>	</center>";
						else
						{
								$query_1 = "SELECT * FROM customer WHERE acc_no='$acc_no'";
								$result_1 = $con->query($query_1);
								if($result_1->num_rows!=1)
									echo "<center> <p style='padding: 5px;background-color:red;'> Account Not Found. Please Enter Correct Account Number.</p>	</center>";
								else
								{
									$count =$result->num_rows;
									if($count==1)
									{
										while($row =$result->fetch_assoc())
										{
											$pass = $row['password'];
											$bal = $row['balance'];
										}
											if($password==$pass)
											{
												if($amount<=$bal)
												{
													$own_balance = $bal - $amount;	
													if($own_balance>='100')
													{
															$query_transfer = "UPDATE customer SET balance='$own_balance' WHERE acc_no='$acc_no'";
															$result_transfer = $con->query($query_transfer);

															$query_2 = "SELECT * FROM customer WHERE acc_no='$acc_no'";
															$result_2 = $con->query($query_2);
															$count_2 = $result_2->num_rows;
															if($count_2==1)
															{
																while($row2 =$result_2->fetch_assoc())
																{
																	$o_balance = $row2['balance'];
																}
																$other_balance = $amount+$o_balance;
																$query_transfer2 = "UPDATE customer SET balance='$other_balance' WHERE `acc_no`='$acc_no'";
																$result_transfer2 =$con->query($query_transfer2);
																if(!$result_transfer2)
																	echo "<center> <p style='padding: 5px;background-color:red;'> Something went wrong.Please try again. </p>	</center>";
																else
																{
																	$token_save = $token;
																	/*Your Account*/
																	$transfer_text = "Transfered Rs.".$amount." from Account Number - ".$acc_no.". Transaction ID - ".$token_save;
																	$query_3 = "INSERT INTO transaction(acc_no,tid) VALUES('$acc_no','$transfer_text');";
																		
																	/*Other's Account*/
																	$transfer_text_2 = "Transfered Rs.".$amount." into Account Number - ".$acc_no.". Transaction ID - ".$token_save;
																	$query_4 = "INSERT INTO transaction(acc_no,tid) VALUES('$acc_no','$transfer_text_2');";

																	if($con->query($query_4)&&$con->query($query_3))
																	{
																		echo "<center> <p style='padding: 5px;background-color:green; color: white;'> Transfered Amount to Account Number - ".$acc_no." Successfully.</p>	</center>";
																		echo "<center> <p style='padding: 5px;background-color:green; color: white;'> Transaction id - <strong><u>".$token_save."</u></strong></p>	</center>";
																	}
																	else
																	{
																		echo "<center> <p style='padding: 5px;background-color:red;'> Something went wrong.</p>	</center>";
																	}
																}
															}

															if(!$result_transfer)
																echo "<center> <p style='padding: 5px;background-color:red;'> Something went wrong.Please try again. </p>	</center>";
													}
													else
														echo "<center> <p style='padding: 5px;background-color:red;'> You do not have that much Balance to withdraw. Account should have minimum of Rs.100</p>	</center>";
												}
												else
												{
													echo "<center> <p style='padding: 5px;background-color:red;'> You do not have that much Balance to Transfer.</p>	</center>";
												}
											}
											else 
											{
												echo "<center> <p style='padding: 5px;background-color:red;'> Password Didnot match.</p>	</center>";
											}
										
									}
								}
						}
					}
					else
					{
						echo "<center> <p style='padding: 5px;background-color:red;'> Amount Must Be Numeric. Please Try Again.</p>	</center>";
					}
				}
				else
				{
					echo "<center> <p style='padding: 5px;background-color:red;'> Account Number Must Be Numeric. Please Try Again. </p>	</center>";
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

		<div class="about_comp_desc" style="border-radius: 10px;left: 25%; top: 8em;height: 15em; width: 20em; padding-top: 40px; padding-left: 40px;font-size: 25px;">
			<center>Enter the Details.</center>
			<br>
			<form action="transfer.php" method="post">
				Account Number : <input type="text" name="acc_no" placeholder="Enter the Account Number" size="25" style="border-radius:5px;padding: 5px;font-size: 18px;"></input>
				<br><br>
				Enter Password &nbsp;&nbsp;: <input type="password" name="pass" placeholder="Enter your Password." size="25" style="border-radius:5px;padding: 5px;font-size: 18px;"> </input>
				<br><br>
				Transfer Amount : <input type="text" name="amt" placeholder="Enter Amount" size="25" style="border-radius:5px;padding: 5px;font-size: 18px;"></input>
				<br><br>
				<center><input type="submit" class="register_id" name="transfer_check" value="Transfer"></center>
			</form>
		</div>

		<div class="footer" style="bottom: -5em">	
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