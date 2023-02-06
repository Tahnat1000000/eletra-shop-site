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
<center>
</br></br></br>
<span style="font-size: 30px; color:#193366; font-family:Gisha; ">
<b>Welcome to our site ELETRA</b>,</br></br>
We offer here lots of new and advanced products</br></br>
like TV, best PHONES, COMPUTERS and LAPTOPS </br></br>
Your'e more than welcome to start look for the perfect match for you! </br></br>
We wish you the BEST buy!!
</span>
</center>

<img src="images/items/laptopp.png" style="width:300; margin-top:-100">

</body>
</html>

<style>
	.button1{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>
