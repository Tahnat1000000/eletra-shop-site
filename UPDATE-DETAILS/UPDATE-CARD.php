<?php 
	session_start(); 
	
	if(!isset($_SESSION['userIn'])){
		echo "<script>window.open('../LOGIN.php','_self');</script>";
	}
	
	$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
	$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");
	
	$query = "select * from USER_DETAILS WHERE USER_ID = ".$_SESSION['userIn'];
	$result = mysqli_query($connection, $query);
	$idInf = mysqli_fetch_array($result);
		
	$query = "select * from USER_CARD WHERE USER_ID = ".$_SESSION['userIn'];
	$result = mysqli_query($connection, $query);
	$cardInf = mysqli_fetch_array($result);
?>

<html>
<head>
<title>Main Page</title>
<style>
	#banner{
		background: linear-gradient(90deg,#e7edf2 ,#5991ad );
		height:180px;
	}
	
	#logo{
		background-image: url("../images/logo.png");
		width:131px;
		height:144px;
		position:absolute;
		margin-left:20px;
		margin-top:10px;
	}
	
	#bannerTitle{
		font-size:100px;
		font-family:gisha;
		position:absolute;
		margin-left:200px;
		margin-top:35px;
	}

	.line{
		height:3px;
		background-color:black;
	}
	
	a:link, a:visited, a:active{
		text-decoration:none;
		color:black;
	}
	
	a:hover{
		font-weight:700;
	}
	
	#msgError{
		text-align:center;
		background-color:#f7cbcb;
		border:1px solid red;
		color:red;
		width:30%;
	}
	
	span{
		color:red;
	}	
</style>
</head>

<body style="background-color:#edeff0; font-family:arial;" dir="ltr">

<div class="line"></div>
<div id="banner">
	<div id="logo"></div>
	<div id="bannerTitle">E&nbsp;&nbsp;	 L&nbsp;&nbsp;   E&nbsp;&nbsp;   T&nbsp;&nbsp;   R&nbsp;&nbsp;   A</div>
	<div style="text-align:right; padding-top: 160px; font-family: Gisha; font-size:15px;">
		<span style="font-weight:700;  color:black;">Hello <?php echo $idInf['FIRST_NAME']?>&nbsp;:)&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<a href="../LOGOUT.php">Log out &nbsp;</a>
	</div>
</div>
<div class="line"></div>
<?php include('menubar.php');?>

<br>

<form name="InsertCardNum" action="UPDATE-CARD.php" method="post" onsubmit="return check();">
	<fieldset style="font-size: 15px;">
		<legend style="color:#5991ad; font-size: 19px;"><B>Confirm</B></legend>
		<span>*</span>
		ID: <input type="text" name="ID">&nbsp;
			<span id="wrongID">ID needs to be only 9 numbers</span>
		<br>
		<span>*</span>
		Password: <input type="password" name="Password">&nbsp;<span id="wrongPassword">Password need to be more than 8 chars</span>
		<br>
	</fieldset>
	
	<fieldset style="font-size:15px;">
		<legend style="color:#5991ad; font-size:19px;"><B>Credit Card Details</B></legend>
		Card Number: <input type="text" name="CardNumber">&nbsp;<span id="wrongCardN">Credit card number need to be 16 numbers</span>
		<br>
		Expiry Date: <input type="text" name="ExpiryDate">&nbsp;<span id="wrongExpiryD">Expiry date need to be 4 numbers, month and year(0120)</span>
		<br>
		CIV: <input type="text" name="CIV">&nbsp;<span id="wrongCIV">CIV need to be 3 numbers</span>
		<br>
		Owner ID: <input type="text" name="OwnerID">&nbsp;<span id="wrongOwnerID">ID needs to be only 9 numbers</span>
	</fieldset>
	<br>
	<input type="submit" name="submit" value="send">
</form>

<center>
	<div id="msgError">Confirm Details Are Not Good</div>
</center>

</body>
</html>

<style>
	.button5{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>

<script>
	onload = document.getElementById("wrongID").hidden = true;
	onload = document.getElementById("wrongPassword").hidden = true;
	onload = document.getElementById("wrongExpiryD").hidden = true;
	onload = document.getElementById("wrongCardN").hidden = true;	
	onload = document.getElementById("wrongCIV").hidden = true;	
	onload = document.getElementById("wrongOwnerID").hidden = true;	
	onload = document.getElementById("msgError").hidden = true;	
	
		function check()
	{
		var flag = true;

		//בדיקת ת.ז
		doc = document.InsertCardNum.ID;
		
		if(!(doc.value.length == 9))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";
			document.getElementById("wrongID").hidden = false;
		}		
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongID").hidden = true;
		}
		
		for(var i = 0; i < doc.value.length ; i++)
		{
			if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";	
				document.getElementById("wrongID").hidden = false;
			}			
		}
		
		//בדיקת סיסמא
		doc = document.InsertCardNum.Password;
		
		if(doc.value.length < 8)
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
			document.getElementById("wrongPassword").hidden = false;
		}		
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongPassword").hidden = true;
		}
		
	
		// פרטי אשראי
		doc = document.InsertCardNum.CardNumber;
		var doc2 = document.InsertCardNum.ExpiryDate;
		var doc3 = document.InsertCardNum.CIV;
		var doc4 =document.InsertCardNum.OwnerID;
	
	
		//מספר כרטיס
		if(doc.value.length != 16)
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";
			document.getElementById("wrongCardN").hidden = false;	
		}
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongCardN").hidden = true;	
		}
			
		for(var i = 0; i < doc.value.length ; i++)
		{
			if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				document.getElementById("wrongCardN").hidden = false;					
			}			
		}
			
			
		//בדיקת תאריך תפוגה			
		if(doc2.value.length != 4)
		{
			flag = false;
			doc2.style.backgroundColor = "#ffdede";
			document.getElementById("wrongExpiryD").hidden = false;
		}
		else
		{
			doc2.style.backgroundColor = "#ffffff";
			document.getElementById("wrongExpiryD").hidden = true;
		}
			
		for(i = 0; i < doc2.value.length ; i++)
		{
			if(!(doc2.value[i] >= '0' && doc2.value[i] <= '9'))
			{
				flag = false;
				doc2.style.backgroundColor = "#ffdede";	
				document.getElementById("wrongExpiryD").hidden = false;
			}			
		}
			
		
		//מספר CIV
		if(doc3.value.length != 3)
		{
			flag = false;
			doc3.style.backgroundColor = "#ffdede";
			document.getElementById("wrongCIV").hidden = false;
		}
		else
		{
			doc3.style.backgroundColor = "#ffffff";
			document.getElementById("wrongCIV").hidden = true;
		}
			
		for(var i = 0; i < doc3.value.length ; i++)
		{
			if(!(doc3.value[i] >= '0' && doc3.value[i] <= '9'))
			{
				flag = false;
				doc3.style.backgroundColor = "#ffdede";	
				document.getElementById("wrongCIV").hidden = false;
			}			
		}
			
			
		//ת.ז כרטיס
		if(!(doc4.value.length == 9))
		{
			flag = false;
			doc4.style.backgroundColor = "#ffdede";
			document.getElementById("wrongOwnerID").hidden = false;
		}		
		else
		{
			doc4.style.backgroundColor = "#ffffff";
			document.getElementById("wrongOwnerID").hidden = true;
		}
			
		for(var i = 0; i < doc4.value.length ; i++)
		{
			if(!(doc4.value[i] >= '0' && doc4.value[i] <= '9'))
			{
				flag = false;
				doc4.style.backgroundColor = "#ffdede";	
				document.getElementById("wrongOwnerID").hidden = false;
			}			
		}
		
	return flag;
	}
</script>

<?php
	if(isset($_POST['submit'])){
		$ID = $_POST['ID'];
		$PASSWORD = $_POST['Password'];
		$CARD_NUMBER = $_POST['CardNumber'];
		$EXPIRY_DATE = $_POST['ExpiryDate'];
		$CIV = $_POST['CIV'];
		$OWNER_ID = $_POST['OwnerID'];
				
		if($_SESSION['userIn'] == $ID){
			if($idInf['PASSWORD'] == $PASSWORD)
			{
				if($cardInf['USER_ID'] == null)
				{
					$query = "INSERT INTO USER_CARD VALUES(NULL, '$ID','$CARD_NUMBER','$EXPIRY_DATE','$CIV','$OWNER_ID')";
					mysqli_query($connection, $query);
					echo "<script>window.open('../USERSETTINGS.php','_self');</script>";	
				}
				else
				{
					$query = "DELETE FROM USER_CARD WHERE USER_ID =".$_SESSION['userIn'];
					mysqli_query($connection, $query);	
					$query = "INSERT INTO USER_CARD VALUES(NULL, '$ID','$CARD_NUMBER','$EXPIRY_DATE','$CIV','$OWNER_ID')";
					mysqli_query($connection, $query);					
					echo "<script>window.open('../USERSETTINGS.php','_self');</script>";					
				}			
			} else echo "<script>document.getElementById('msgError').hidden = false;</script>";
		} else echo "<script>document.getElementById('msgError').hidden = false;</script>";
	}
?>