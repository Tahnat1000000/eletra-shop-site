<?php session_start(); 

if(!isset($_SESSION['userIn'])){
	echo "<script>window.open('LOGIN.php','_self');</script>";
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
	<div style="text-align:right; padding-top: 160px; font-family: Gisha; font-size:15px;">
		<span style="font-weight:700;">Hello <?php echo $idInf['FIRST_NAME']?>&nbsp;:)&nbsp;&nbsp;|&nbsp;&nbsp;</span>
		<a href="LOGOUT.php">Log out &nbsp;</a>
	</div>
</div>
<div class="line"></div>
<?php include('menubar.php');?>

</br></br>
&nbsp;&nbsp;<span style="font-family: Gisha; font-size:40px; color:#193366;"><b> Contact us: </b></span></br></br>
&nbsp;&nbsp;&nbsp;<span style="font-family: Gisha; font-size:25px; color:#193366;"> You can catch us on our Phone : 04-9982651&nbsp; <img src="images\icons\c1.png"></br></br>
&nbsp;&nbsp;&nbsp;You can catch us on our Mobile : 054-6843009 / Eden | 054-3316721 / Ilan &nbsp; <img src="images\icons\c1.png"></br></br>
&nbsp;&nbsp;&nbsp;You can write us on our Mail : Eletra@gmail.com &nbsp; <img src="images\icons\mail.png" style="width:25;"></br></br>
&nbsp;&nbsp;&nbsp;We will love to help any time &nbsp; <img src="images\icons\heart.png" style="width:20;"></span></br>

<img src="images/items/iphone.png" style="width:180; margin-left:1220; margin-top:-90">


</body>
</html>

<style>
	.button4{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>
