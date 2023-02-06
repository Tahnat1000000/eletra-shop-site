<?php session_start(); 

	if(!isset($_SESSION['userIn'])){
		echo "<script>window.open('../LOGIN.php','_self');</script>";
	}
	
	$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
	$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");	
	
	$query = "select * from USER_DETAILS WHERE USER_ID = ".$_SESSION['userIn'];
	$result = mysqli_query($connection, $query);
	$idInf = mysqli_fetch_array($result);
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
		<span style="font-weight:700; color:black;">Hello <?php echo $idInf['FIRST_NAME']?>&nbsp;:)&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<a href="../LOGOUT.php">Log out &nbsp;</a>
	</div>
</div>
<div class="line"></div>
<?php include('menubar.php');?>

<br>

<form name="update" action="UPDATE-PERSONAL.php" method="post" onsubmit="return check();">

	<fieldset style="font-size: 15px;">
		<legend style="color:#5991ad; font-size: 19px;"><B>Confirm</B></legend>
		ID: <input type="text" name="ID">&nbsp;
			<span id="wrongID">ID needs to be only 9 numbers</span>
		<br>
		Password: <input type="password" name="Password">&nbsp;<span id="wrongPassword">Password need to be more than 8 chars</span>
		<br>
	</fieldset>
	
	<fieldset style="font-size:15px;">
		<legend style="color:#5991ad; font-size:19px;"><B>Change Personal Details</B></legend>
		
		First Name: <input type="text" name="FirstName"> <span id="wrongName">Name needs to be more than 2 chars and smaller that 10 chars and only letters</span>
		<br>
		Family Name: <input type="text" name="FamilyName"> <span id="wrongFamily">Family Name needs to be more than 2 chars and smaller that 12 chars and only letters</span>
		<br>
		Gender:   <input type="radio" name="Gender" value="Male"> Male &nbsp;
				  <input type="radio" name="Gender" value="Female"> Female
		<br>
		BirthDay: <input type="date" name="BirthDay"> <span id="wrongDate">You need to fill the date</span>
		<br>
		Address: <input type="text" name="Address"><span id="wrongAddress">Address needs to be more than 2 chars and smaller that 25 chars </span>
		<br>
		Phone: <input type="text" name="Phone">	<span id="wrongPhone">Phone number needs to be only 10 numbers</span>
		<br>
		Mail: <input type="text" name="Mail"> <span id="wrongMail">Mail need to include '@' and '.'</span>	
		<br>
		Family Status:  <input type="radio" name="FamilyStatus" value="Single"> Single &nbsp;
						<input type="radio" name="FamilyStatus" value="Married"> Married  &nbsp;
						<input type="radio" name="FamilyStatus" value="Married+"> Married+
	</fieldset>
	
	<br>
	
	<fieldset style="font-size: 15px;">
		<legend style="color:#5991ad; font-size: 19px;"><B>Change Password</B></legend>
		Password: <input type="password" name="CPassword1">&nbsp;<span id="wrongCPassword1">Password need to be more than 8 chars</span>
		<br>
		Confirm Password: <input type="password" name="CPassword2">&nbsp;<span id="wrongCPassword2">Passwords not equal</span>
		<br>
	</fieldset>
	
	<br>
	
	<input type="submit" name="submit" value="Update" style="font-size:15px; width:70px;">
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
	onload = document.getElementById("wrongName").hidden = true;
	onload = document.getElementById("wrongFamily").hidden = true;
	onload = document.getElementById("wrongDate").hidden = true;
	onload = document.getElementById("wrongAddress").hidden = true;
	onload = document.getElementById("wrongPhone").hidden = true;
	onload = document.getElementById("wrongMail").hidden = true;
	onload = document.getElementById("wrongCPassword1").hidden = true;
	onload = document.getElementById("wrongCPassword2").hidden = true;	
	onload = document.getElementById("msgError").hidden = true;	

	
	function check()
	{
		var flag = true;
		
		//בדיקת ת.ז
		doc = document.update.ID;
		
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
		doc = document.update.Password;
		
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
		
		
		// בדיקת שם 
		var doc = document.update.FirstName;
		
		if(doc.value.length != 0)
		{
			if(doc.value.length < 2 || doc.value.length > 10)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				onload = document.getElementById("wrongName").hidden = false;
			}
			else
			{
				doc.style.backgroundColor = "#ffffff";
				onload = document.getElementById("wrongName").hidden = true;
			}
			
			for(var i = 0; i < doc.value.length ; i++)
			{
				if(!(doc.value[i] >= 'a' && doc.value[i] <= 'z' || doc.value[i] >= 'A' && doc.value[i] <= 'Z'))
				{
					flag = false;
					doc.style.backgroundColor = "#ffdede";
					onload = document.getElementById("wrongName").hidden = false;				
				}
			}
		}
		
		// בדיקת שם משפחה
		doc = document.update.FamilyName;
		
		if(doc.value.length != 0)
		{
			if(doc.value.length < 2 || doc.value.length > 12)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				onload = document.getElementById("wrongFamily").hidden = false;
			}
			else
			{
				doc.style.backgroundColor = "#ffffff";
				onload = document.getElementById("wrongFamily").hidden = true;
			}
			
			for(var i = 0; i < doc.value.length ; i++)
			{
				if(!(doc.value[i] >= 'a' && doc.value[i] <= 'z' || doc.value[i] >= 'A' && doc.value[i] <= 'Z'))
				{
					flag = false;
					doc.style.backgroundColor = "#ffdede";
					onload = document.getElementById("wrongFamily").hidden = false;				
				}			
			}
		}
		
		
		//בדיקת כתובת 		
		doc = document.update.Address;
		
		if(doc.value.length != 0)
		{
			if(doc.value.length < 2 || doc.value.length > 25)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				onload = document.getElementById("wrongAddress").hidden = false;
			}		
			else
			{
				doc.style.backgroundColor = "#ffffff";
				onload = document.getElementById("wrongAddress").hidden = true;
			}
		}
		// בדיקת פלאפון
		doc = document.update.Phone;
		
		if(doc.value.length != 0)
		{
			if(!(doc.value.length == 10))
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				onload = document.getElementById("wrongPhone").hidden = false;
			}		
			else
			{
				doc.style.backgroundColor = "#ffffff";
				onload = document.getElementById("wrongPhone").hidden = true;
			}
			
			for(var i = 0; i < doc.value.length ; i++)
			{
				if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
				{
					flag = false;
					doc.style.backgroundColor = "#ffdede";	
					onload = document.getElementById("wrongPhone").hidden = false;
				}			
			}
		}
		//בדיקת מייל		
		doc = document.update.Mail;
		
		if(doc.value.length != 0)
		{			
			if(doc.value.length < 2)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				onload = document.getElementById("wrongMail").hidden = false;
			}		
			else
			{
				doc.style.backgroundColor = "#ffffff";
				onload = document.getElementById("wrongMail").hidden = true;
			}
			
			if(doc.value.indexOf("@") == -1 && doc.value.indexOf(".") == -1)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";	
				onload = document.getElementById("wrongMail").hidden = false;
			}			
		}
		
		//שינוי סיסמא
		doc = document.update.CPassword1;
		if(doc.value.length != 0)
		{
			if(doc.value.length < 8)
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";	
				document.getElementById("wrongCPassword1").hidden = false;
			}		
			else
			{
				doc.style.backgroundColor = "#ffffff";
				document.getElementById("wrongCPassword1").hidden = true;
			}
		}
		
		//אימות סיסמא
		doc = document.update.CPassword2;
		
		if(document.update.CPassword1.value.length != 0)
		{
			if(!(doc.value == document.update.CPassword1.value))
			{
				flag = false;
				doc.style.backgroundColor = "#ffdede";
				document.getElementById("wrongCPassword2").hidden = false;
			}		
			else
			{
				doc.style.backgroundColor = "#ffffff";
				document.getElementById("wrongCPassword2").hidden = true;
			}
		}
		
		
		return flag;
	}
</script>

<?php
	if(isset($_POST['submit']))
	{
		$ID = $_POST['ID'];
		$PASSWORD = $_POST['Password'];
		$FIRST_NAME = $_POST['FirstName'];
		$LAST_NAME = $_POST['FamilyName'];
		$BIRTHDAY = $_POST['BirthDay'];
		$ADDRESS = $_POST['Address'];
		$PHONE = $_POST['Phone'];
		$MAIL = $_POST['Mail'];
		$NEWPASSWORD = $_POST['CPassword2'];
		
		if(isset($_POST['Gender']))
			$GENDER = $_POST['Gender'];
		if(isset($_POST['FamilyStatus']))
			$FAMILY_STATUS = $_POST['FamilyStatus'];

		if($_SESSION['userIn'] == $ID)
		{
			if($idInf['PASSWORD'] == $PASSWORD)
			{
				if($FIRST_NAME != '')
				{
					$update = "update USER_DETAILS set FIRST_NAME = '$FIRST_NAME' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}
				
				if($LAST_NAME != '')
				{
					$update = "update USER_DETAILS set FAMILY_NAME = '$LAST_NAME' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}	
				
				if(isset($GENDER))
				{
					$update = "update USER_DETAILS set GENDER = '$GENDER' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);						
				}
				
				if($BIRTHDAY != '')
				{
					$update = "update USER_DETAILS set BIRTHDAY = '$BIRTHDAY' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}	
				
				if($ADRESS != '')
				{
					$update = "update USER_DETAILS set ADRESS = '$ADRESS' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}
				
				if($PHONE != '')
				{
					$update = "update USER_DETAILS set PHONE = '$PHONE' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}
				
				if($MAIL != '')
				{
					$update = "update USER_DETAILS set MAIL = '$MAIL' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}	
				
				if(isset($FAMILY_STATUS))
				{
					$update = "update USER_DETAILS set FAMILY_STATUS = '$FAMILY_STATUS' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);						
				}	
				
				if($NEWPASSWORD != '')
				{
					$update = "update USER_DETAILS set PASSWORD = '$NEWPASSWORD' where USER_ID = ".$_SESSION['userIn'];
					mysqli_query($connection, $update);					
				}				
				echo "<script>window.open('../USERSETTINGS.php','_self');</script>";	
				
			} else echo "<script>document.getElementById('msgError').hidden = false;</script>";
		} else echo "<script>document.getElementById('msgError').hidden = false;</script>";
	}
?>