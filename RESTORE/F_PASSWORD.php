<?php
	session_start();
?>

<html>
<head>
<title>Forget Password</title>
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
		background-color:#f7cbcb;
		border:1px solid red;
		width:30%;
		visibility:hidden;
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

<br><br>

<center>
	<div style="font-size:100px; font-family:impact;">PASSWORD RESOTRE</div>
	<br>
	<b>Enter ID number</b>
	<form action="F_PASSWORD.php" method="post" name="restore" onsubmit="return check()">
		<input type="text" name="ID" style="width:270px; height:35px; font-size:30; text-align:center;">
		<br><br>
		<input type="submit" name="submit" value="Show Question" style="width:200px; height:30px; font-size:20px;">
	</form>
	
	<br><br><br>
	
	<div id="msgError"></div>
</center>



</body>
</html>

<script>
function check()
{
	var flag = true;
	
	// בדיקת ת.ז
	var doc = document.restore.ID;
	if(!(doc.value.length == 9))
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
		document.getElementById('msgError').innerHTML = "<b>USER ID:</b> ID needs to be only 9 numbers!";
		document.getElementById('msgError').style.visibility = 'visible';
	}		
	else
	{
		doc.style.backgroundColor = "#ffffff";
		document.getElementById('msgError').style.visibility = 'hidden';
	}		
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
			document.getElementById('msgError').innerHTML = "<b>USER ID:</b> ID needs to be only 9 numbers!";
			document.getElementById('msgError').style.visibility = 'visible';
		}			
	}
	return flag;
}
</script>

<?php
	if(isset($_POST['submit']))
	{
		$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
		$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");	

		$ID = $_POST['ID'];
		
		$query = "select * from USER_DETAILS WHERE USER_ID = $ID";
		$result = mysqli_query($connection, $query);
		$idInf = mysqli_fetch_array($result);	

		if($idInf['USER_ID'] == null)
		{
			echo "<script>document.getElementById('msgError').innerHTML = '<b>USER ID:</b> This id is not exist in the system'</script>";
			echo "<script>document.getElementById('msgError').style.visibility = 'visible';</script>";	
			echo "<script>document.login.ID.value = $ID</script>";
		}
		else
		{
			$_SESSION['restorePassword'] = $ID;
			echo "<script>window.open('QUESTION.php','_self');</script>";
		}		
	}
?>