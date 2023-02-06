<?php	
	session_start(); 

	if(!isset($_SESSION['userIn'])){
		echo "<script>window.open('LOGIN.php','_self');</script>";
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
	td.Style1{
		text-align:center;
		width:150px;
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

<br>

<fieldset style="font-size:15px;">
<legend style="color:#5991ad; font-size:19px;"><B>Personal Details</B></legend>
<table align="center" style="font-size:20; width:30%;">
	<tr>
		<td><b>First Name: </b></td> <td class="Style1"><?php echo $idInf['FIRST_NAME'];?></td>
	</tr>
	
	<tr>
		<td><b>Last Name: </b></td> <td class="Style1"><?php echo $idInf['FAMILY_NAME'];?></td>
	</tr>
	
	<tr>
		<td><b>Gender: </b></td> <td class="Style1"><?php echo $idInf['GENDER'];?></td>
	</tr>
	
	<tr>
		<td><b>Birthday: </b></td> <td class="Style1"><?php echo $idInf['BIRTHDAY'];?></td>
	</tr>
	
	<tr>
		<td><b>Adress: </b></td> <td class="Style1"><?php echo $idInf['ADDRESS'];?></td>
	</tr>
	
	<tr>
		<td><b>Phone: </b></td> <td class="Style1"><?php echo $idInf['PHONE'];?></td>
	</tr>
	
	<tr>
		<td><b>Mail: </b></td> <td class="Style1"><?php echo $idInf['MAIL'];?></td>
	</tr>	
	
	<tr>
		<td><b>Family Status: </b></td> <td class="Style1"><?php echo $idInf['FAMILY_STATUS'];?></td>
	</tr>
	
	<tr>
		<td><b>ID: </b></td> <td class="Style1"><?php echo $idInf['USER_ID'];?></td>
	</tr>
	
	<tr>
		<td><b>PASSWORD: </b></td> <td class="Style1"><?php echo $idInf['PASSWORD'];?></td>
	</tr>
	</table>
	<center>
	</br>
	<a href="UPDATE-DETAILS/UPDATE-PERSONAL.php"> <input type="button" value="Update Personal Details" style="width:200; height: 25px; font-size:15px;"> </a>
	</center>
	</fieldset>

	
	<?php 
		if($cardInf['USER_ID'] != ""){
			echo "<fieldset style='font-size:15px;'>";
			echo "<legend style='color:#5991ad; font-size:19px;'><B>Card Details</B></legend>";
			echo "<table align='center' style='font-size:20; width:30%;'>";
				echo "<tr>";
					echo "<td><b> Card Number:</b>"."</td>";	
					echo "<td class='Style1'>". $cardInf['CARD_NUMBER']."</td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td><b> Expiry Date:</b>"."</td>";	
					echo "<td class='Style1'>".$cardInf['EXPIRY_DATE']."</td>";				
				echo "</tr>";
				echo "<tr>";
					echo "<td><b> CIV:</b>"."</td>";	
					echo "<td class='Style1'>".$cardInf['CIV']."</td>";					
				echo "</tr>";
				echo "<tr>";
					echo "<td><b> Owner ID:</b>"."</td>";	
					echo "<td class='Style1'>".$cardInf['OWNER_ID']."</td>";					
				echo "</tr>";
			echo "</table>";
		
			echo "<center>";
			echo "</br>";
			echo "<a href='UPDATE-DETAILS/UPDATE-CARD.php'><input type='button' value='Update Credit Crad Details' style='width:200; height: 25px; font-size:15px;'> </a>";
			echo "</center>";		
			echo "</fieldset>";	
	}else{
		echo "<br>";
		echo "Card details not entered, <a href='UPDATE-DETAILS/UPDATE-CARD.php'>Enter Card details</a>.";
		echo "<br><br>";
	}
	?>
	
</body>
</html>

<style>
	.button5{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>
