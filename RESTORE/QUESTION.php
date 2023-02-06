<?php
	session_start();
	
	$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
	$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");
	
	if(!isset($_SESSION['restorePassword'])){
		echo "<script>window.open('../LOGIN.php','_self');</script>";
	}	
	
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
	<b>What is the name of your grandpa: </b>
	<form action="QUESTION.php" method="post" name="restore" onsubmit="return check()">
		<input type="text" name="Answer" style="width:270px; height:35px; font-size:30; text-align:center;">
		<br><br>
		<input type="submit" name="submit" value="Send" style="width:200px; height:30px; font-size:20px;">
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
	
	// בדיקת שאלת אימות
	var doc = document.restore.Answer;
	if(doc.value < 2 || doc.value > 15)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
		document.getElementById('msgError').innerHTML = "<b>Answer need to be 2-15 chars!</b>";
		document.getElementById('msgError').style.visibility = 'visible';
	}		
	else
	{
		doc.style.backgroundColor = "#ffffff";
		document.getElementById('msgError').style.visibility = 'hidden';
	}
	return flag;
}
</script>

<?php
	if(isset($_POST['submit']))
	{	

		$ANSWER = $_POST['Answer'];
		
		$query = "select * from USER_DETAILS WHERE USER_ID = ". $_SESSION['restorePassword'];
		$result = mysqli_query($connection, $query);
		$idInf = mysqli_fetch_array($result);	

		if($idInf['QUESTION'] == $ANSWER)
		{
			$_SESSION['restorePasswordA'] = 1;
			echo "<script>window.open('CHANGEPASS.php','_self');</script>";	
		}
		else
		{
			echo "<script>document.getElementById('msgError').innerHTML = '<b>Answer is not correct!</b>'</script>";
			echo "<script>document.getElementById('msgError').style.visibility = 'visible';</script>";	
		}		
	}
?>