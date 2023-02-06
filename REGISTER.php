<?php
	session_start();
	
	if(isset($_SESSION['userIn'])){
		echo "<script>window.open('MAIN.php','_self');</script>";
	}
	
	if(isset($_POST['submit']))
	{
		$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
		$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");
		
		$FIRST_NAME = $_POST['FirstName'];
		$LAST_NAME = $_POST['FamilyName'];
		$GENDER = $_POST['Gender'];
		$BIRTHDAY = $_POST['BirthDay'];
		$ADDRESS = $_POST['Address'];
		$PHONE = $_POST['Phone'];
		$MAIL = $_POST['Mail'];
		$FAMILY_STATUS = $_POST['FamilyStatus'];	
		$ID = $_POST['ID'];
		$PASSWORD = $_POST['Password'];
		$QUESTION = $_POST['Question'];
		
		$query = "select USER_ID from USER_DETAILS WHERE USER_ID = $ID";
		$result = mysqli_query($connection, $query);
		$idInf = mysqli_fetch_array($result);		
	}

?>

<html>
<head>
<title></title>

<style>
	#banner{
		background: linear-gradient(90deg,#e7edf2 ,#5991ad );
		height:180px;
	}
	
	#logo{
		background-image: url("images/logo.png");
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
</div>
<div class="line"></div>

<br>

<form name="register" action="register.php" method="post" onsubmit="return check();">
<div style="color: Red;"> Required Fields *</div>
	<fieldset style="font-size:15px;">
		<legend style="color:#5991ad; font-size:19px;"><B>Personal Details</B></legend>
		<span style="color: Red;">*</span>
		First Name: <input type="text" name="FirstName"> <span id="wrongName">Name needs to be more than 2 chars and smaller that 10 chars and only letters</span>
		<br>
		<span>*</span>
		Family Name: <input type="text" name="FamilyName"> <span id="wrongFamily">Family Name needs to be more than 2 chars and smaller that 12 chars and only letters</span>
		<br>
		<span>*</span>
		Gender:   <input type="radio" name="Gender" value="Male"> Male &nbsp;
				  <input type="radio" name="Gender" value="Female"> Female
				  
				  <span id="wrong">Not entered gender</span>
		<br>
		<span>*</span>
		BirthDay: <input type="date" name="BirthDay"> <span id="wrongDate">You need to fill the date</span>
		<br>
		<span>*</span>
		Address: <input type="text" name="Address"><span id="wrongAddress">Address needs to be more than 2 chars and smaller that 25 chars </span>
		<br>
		<span>*</span>
		Phone: <input type="text" name="Phone">	<span id="wrongPhone">Phone number needs to be only 10 numbers</span>
		<br>
		<span>*</span>
		Mail: <input type="text" name="Mail"> <span id="wrongMail">Mail need to include '@' and '.'</span>	
		<br>
		<span>*</span>
		Family Status:  <input type="radio" name="FamilyStatus" value="Single"> Single &nbsp;
						<input type="radio" name="FamilyStatus" value="Married"> Married  &nbsp;
						<input type="radio" name="FamilyStatus" value="Married+"> Married+
						
						<span id="wrong2">Not entered family status</span>
	</fieldset>
	
	<br>
	
	<fieldset style="font-size: 15px;">
		<legend style="color:#5991ad; font-size: 19px;"><B>Login Details</B></legend>
		<span>*</span>
		ID: <input type="text" name="ID">&nbsp;
			<span id="wrongID">ID needs to be only 9 numbers</span>
			<span id="existError">This user id is allready exist, try to <a href="LOGIN.php">login</a></span>
		<br>
		<span>*</span>
		Password: <input type="password" name="Password">&nbsp;<span id="wrongPassword">Password need to be more than 8 chars</span>
		<br>
		<span>*</span>
		Confirm Password: <input type="password" name="CPassword">&nbsp;<span id="wrongCPassword">Passwords not equal</span>
		<br>
		<span>*</span>
		What is the name of your grandpa: <input type="text" name="Question">&nbsp;<span id="wrongAns">Answer need to be 2-15 chars</span>	
	</fieldset>
	
	<br>
	
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
	
	<input type="submit" name="submit" value="Send" style="font-size:15px; width:70px;">
</form>

</body>
</html>

<script>
	
	onload = document.getElementById("wrong").hidden = true;
	onload = document.getElementById("wrong2").hidden = true;
	onload = document.getElementById("wrongName").hidden = true;
	onload = document.getElementById("wrongFamily").hidden = true;
	onload = document.getElementById("wrongDate").hidden = true;
	onload = document.getElementById("wrongAddress").hidden = true;
	onload = document.getElementById("wrongPhone").hidden = true;
	onload = document.getElementById("wrongMail").hidden = true;
	onload = document.getElementById("wrongID").hidden = true;
	onload = document.getElementById("wrongPassword").hidden = true;
	onload = document.getElementById("wrongCPassword").hidden = true;
	onload = document.getElementById("wrongAns").hidden = true;
	onload = document.getElementById("wrongCardN").hidden = true;
	onload = document.getElementById("wrongExpiryD").hidden = true;
	onload = document.getElementById("wrongCIV").hidden = true;	
	onload = document.getElementById("wrongOwnerID").hidden = true;	
	onload = document.getElementById("existError").hidden = true;	
	
	function check()
	{
		var flag = true;
		
		// בדיקת שם 
		var doc = document.register.FirstName;
		
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
		
		// בדיקת שם משפחה
		doc = document.register.FamilyName;
		
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
		
		// בדיקת מגדר
		doc = document.register.Gender;
		
		if(doc[0].checked == false && doc[1].checked == false)
		{
			flag = false;	
			document.getElementById("wrong").hidden = false;
		}
		else
		{
			document.getElementById("wrong").hidden = true;
		}
		
		// בדיקת תאריך לידה
		doc = document.register.BirthDay;
		
		if(doc.value == false)
		{
			flag = false;	
			doc.style.backgroundColor = "#ffdede";
			document.getElementById("wrongDate").hidden = false;
		}
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongDate").hidden = true;
		}
		
		//בדיקת כתובת 		
		doc = document.register.Address;
		
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
		
		// בדיקת פלאפון
		doc = document.register.Phone;
		
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
		
		//בדיקת מייל		
		doc = document.register.Mail;
		
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
		
		//בדיקת מצב משפחתי
		doc = document.register.FamilyStatus;
		
		if(doc[0].checked == false && doc[1].checked == false && doc[2].checked == false)
		{
			flag = false;	
			document.getElementById("wrong2").hidden = false;
		}
		else
		{
			document.getElementById("wrong2").hidden = true;
		}
		
		//בדיקת ת.ז
		doc = document.register.ID;
		
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
		doc = document.register.Password;
		
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
		
		//אימות סיסמא
		doc = document.register.CPassword;
		
		if(!(doc.value == document.register.Password.value))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";
			document.getElementById("wrongCPassword").hidden = false;
		}		
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongCPassword").hidden = true;
		}
		
		//שאלת אימות
		doc = document.register.Question;
	
		if(doc.value < 2 || doc.value > 15)
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";
			document.getElementById("wrongAns").hidden = false;
		}		
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongAns").hidden = true;	
		}
	
		// פרטי אשראי
		doc = document.register.CardNumber;
		var doc2 = document.register.ExpiryDate;
		var doc3 = document.register.CIV;
		var doc4 =document.register.OwnerID;
	
		if(!(doc.value == 0 && doc2.value == 0 && doc3.value == 0 && doc4.value == 0))
		{	
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
		}
		else
		{
			doc.style.backgroundColor = "#ffffff";
			document.getElementById("wrongCardN").hidden = true;
			doc2.style.backgroundColor = "#ffffff";
			document.getElementById("wrongExpiryD").hidden = true;
			doc3.style.backgroundColor = "#ffffff";
			document.getElementById("wrongCIV").hidden = true;
			doc4.style.backgroundColor = "#ffffff";
			document.getElementById("wrongOwnerID").hidden = true;
		}
		
		return flag;
	}
</script>

<?php
	if(isset($_POST['submit']))
		if($idInf['USER_ID'] == null)
		{
			$query = "INSERT INTO USER_DETAILS VALUES(NULL, '$FIRST_NAME', '$LAST_NAME', '$GENDER', '$BIRTHDAY', '$ADDRESS', '$PHONE', '$MAIL', '$FAMILY_STATUS', '$ID', '$PASSWORD', '$QUESTION', '0')";
			mysqli_query($connection, $query);
			
			if($_POST['CardNumber'] != "")
			{
				$CARD_NUMBER = $_POST['CardNumber'];
				$EXPIRY_DATE = $_POST['ExpiryDate'];
				$CIV = $_POST['CIV'];
				$OWNER_ID = $_POST['OwnerID'];
				
				$query = "INSERT INTO USER_CARD VALUES(NULL, '$ID','$CARD_NUMBER','$EXPIRY_DATE','$CIV','$OWNER_ID')";
				mysqli_query($connection, $query);
			}
			echo "<script>window.open('MAIN.php','_self');</script>";
		}
		else
		{
			echo "<script>document.register.FirstName.value = '$FIRST_NAME'</script>";
			echo "<script>document.register.FamilyName.value = '$LAST_NAME '</script>";
			echo "<script>document.register.Gender.value = '$GENDER'</script>";
			echo "<script>document.register.BirthDay.value = '$BIRTHDAY'</script>";
			echo "<script>document.register.Address.value = '$ADDRESS'</script>";
			echo "<script>document.register.Phone.value = '$PHONE'</script>";
			echo "<script>document.register.Mail.value = '$MAIL'</script>";
			echo "<script>document.register.FamilyStatus.value = '$FAMILY_STATUS'</script>";
			echo "<script>document.register.ID.value = '$ID'</script>";
			echo "<script>document.getElementById('existError').hidden = false;</script>";	
		}
?>


















