<?php session_start(); 

	if(!isset($_SESSION['userIn'])){
		echo "<script>window.open('LOGIN.php','_self');</script>";
	}

	$connection = mysqli_connect('localhost', 'root', '') or die("ERROR: CONNECTION NOT FOUND!");
	$db = mysqli_select_db($connection, 'eletra_shop') or die("ERROR: DATABASE NOT FOUND!");	
	
	$query = "select * from USER_DETAILS WHERE USER_ID = ".$_SESSION['userIn'];
	$result = mysqli_query($connection, $query);
	$idInf = mysqli_fetch_array($result);
	
	$providerCount = mysqli_num_rows(mysqli_query($connection, "select * from PROVIDERS"));	
	
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
	
	input.style1{
		text-align: center;
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

<table align="center">
	<tr>
		<td><img src="images/items/tv.png" style="width:300;"></td>
		<td><img src="images/items/phone.png" style="width:200;"></td>
		<td><img src="images/items/laptop.png" style="width:300;"></td>
		<td><img src="images/items/computer.png" style="width:300;"></td>
	</tr>
	<tr>
		<td align="center" style="font-family:Gisha; font-size:25px;"><b>Televitions</b></td>
		<td align="center" style="font-family:Gisha; font-size:25px;"><b>Phones</b></td>
		<td align="center" style="font-family:Gisha; font-size:25px;"><b>Laptops</b></td>
		<td align="center" style="font-family:Gisha; font-size:25px;"><b>Computers</b></td>
	</tr>	
</table>

<br>

	<?php
		if($idInf['ADMIN'] == "1")
		{
			echo "<fieldset style='font-size:15px;'>"; // חלון מנהל
			echo "<legend style='color:#5991ad; font-size:19px;'><B>Admin Options</B></legend>";
			
			echo "<table align='center' style='font-size:20; width:61%;'>";  // הוספת ספק חדש
				echo "<tr>";
					echo "<form action='ITEMS.php' method='post' name='AddProvider' onsubmit='return check1()'>";
					echo "<td> <b>Add Provider:</b> </td>";
					echo "<td> <input class='style1' type='text' name='PROVIDERID' placeholder='Provider id (5)'> </td>";
					echo "<td> <input class='style1' type='text' name='PROVIDERNAME' placeholder='Provider name (25)'> </td>";
					echo "<td> <input class='style1' type='text' name='PROVIDERPHONE' placeholder='Provider Phone (10)'> </td>";				
					echo "<td> <input type='submit' name='ProviderSubmit' value='Add Provider'></td>";
					echo "<td> <span id='msgError1' style='color:red; font-size:15px; visibility:hidden;'>Provider id allready exist</span> </td>";					
					echo "</form>";	
				echo "</tr>";
			echo "</table>";		

			
			echo "<table align='center' style='font-size:20; width:76%;'>";  // הוספת מוצר חדש
				echo "<tr>";
					echo "<form action='ITEMS.php' method='post' name='AddProduct' onsubmit='return check2()'>";
					echo "<td> <b>Add Product:</b> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTID' placeholder='Product id (5)'> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTNAME' placeholder='Product name (25)'> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTPRICE' placeholder='Product price'> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTAMOUNT' placeholder='Product amount'> </td>";				
					echo "<td> <select name='PRODUCTPROVIDER'>";
					for($i = 1 ; $i <= $providerCount ; $i++)
					{
						$result = mysqli_query($connection, "select * from PROVIDERS where NUM_OF_PROVIDER = $i");
						$providerInf = mysqli_fetch_array($result);
						$providerId = $providerInf['PROVIDER_ID'];
						echo "<option value='$providerId'>$providerId</option>";
					}
					echo "</select> </td>";	
					echo "<td> <input type='submit' name='ProductSubmit' value='Add Product'></td>";
					echo "<td> <span id='msgError2' style='color:red; font-size:15px; visibility:hidden;'>Product id allready exist</span> </td>";
					echo "</form>";	
				echo "</tr>";
			echo "</table>";	
			
			
			echo "<table align='center' style='font-size:20; width35%;'>";  // עידכון מלאי
				echo "<tr>";
					echo "<form action='ITEMS.php' method='post' name='UpdateStock' onsubmit='return check3()'>";
					echo "<td> <b>Update Stock:</b> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTID' placeholder='Product id (5)'> </td>";
					echo "<td> <input class='style1' type='text' name='PRODUCTAMOUNT' placeholder='Product amount'> </td>";					
					echo "<td> <input type='submit' name='StockSubmit' value='Update Stock'></td>";
					echo "<td> <span id='msgError3' style='color:red; font-size:15px; visibility:hidden;'>Product id not exist</span> </td>";
					echo "</form>";	
				echo "</tr>";
			echo "</table>";
			
			echo "</fieldset>";	
		}
	?>
	
	<br><br>
	
	<?php 
		$productCount = mysqli_num_rows(mysqli_query($connection, "select * from PRODUCTS"));
		
		echo "<table align='center' style='font-size:20; width:50%; text-align: center;'>"; // הצגת כל המוצרים
			echo "<tr style='color:#b2c8d4'>";
				echo "<td><b>Product ID</b></td>";
				echo "<td><b>Product Name</b></td>";
				echo "<td><b>Product Price</b></td>";
				echo "<td><b>Amount Of Product</b></td>";
			echo "</tr>";
			
			echo "<tr> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> </tr>";	
			
			echo "<form action='ITEMS.php' method='post' name='AddToCart'>";
				for($i = 1 ; $i <= $productCount ; $i++)
				{
					$result = mysqli_query($connection, "select * from PRODUCTS where NUM_OF_PRODUCT = $i");
					$productInf = mysqli_fetch_array($result);	
					echo "<tr>";
						echo "<td>".$productInf['PRODUCT_ID']."</td>";
						echo "<td><b>".$productInf['PRODUCT_NAME']."</b></td>";
						echo "<td>".$productInf['PRICE']."$</td>";
						echo "<td>".$productInf['AMOUNT']."</td>";
						$ProductId = $productInf['PRODUCT_ID'];
						
						if($productInf['AMOUNT'] > 0)
							echo "<td><input type='submit' name='$ProductId' value='Add to cart'></td>";
						else
							echo "<td><input type='submit' name='$ProductId' value='Add to cart' disabled></td>";
						
					echo "</tr>";
					echo "<tr> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> </tr>";
				}
			echo "</form>";
		echo "</table>";
		
		
		for($i = 1 ; $i <= $productCount ; $i++) // הוספה לסל קניות
		{	
			$result = mysqli_query($connection, "select * from PRODUCTS where NUM_OF_PRODUCT = $i");
			$productInf = mysqli_fetch_array($result);
			
			$ProductId = $productInf['PRODUCT_ID'];
			$MyId = $_SESSION['userIn'];
			$TodayDate = date('Y-m-d');
			$ExpTime = time() + 180; // תוקף מוצר בסל קניות - 3 דקות
			
			if(isset($_POST[$ProductId]))
			{
				$query = "INSERT INTO CART VALUE(null,'$MyId','$ProductId','$TodayDate','$ExpTime')";
				mysqli_query($connection, $query);
				echo "<script>window.open('ITEMS.php','_self');</script>";	
			}
		}
		
	?>


</body>
</html>

<style>
	.button2{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>

<script>

function check1(){
	var flag = true;
	
	// בדיקת קוד ספק
	var doc = document.AddProvider.PROVIDERID;
	
	if(!(doc.value.length == 5))
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}		
	else
	{
		doc.style.backgroundColor = "#ffffff";
	}		
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}	
	
	// בדיקת שם ספק
	doc = document.AddProvider.PROVIDERNAME;
	
	if(doc.value.length < 2 || doc.value.length > 25)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	else
	{
		doc.style.backgroundColor = "#ffffff";
	}	
	
	// בדיקת טלפון ספק
	var doc = document.AddProvider.PROVIDERPHONE;
	
	if(doc.value.length != 10)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	else
	{
		doc.style.backgroundColor = "#ffffff";		
	}
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}			
	
	return flag;
}

function check2(){
	var flag = true;
	
	// בדיקת קוד מוצר
	var doc = document.AddProduct.PRODUCTID;
	
	if(!(doc.value.length == 5))
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}		
	else
	{
		doc.style.backgroundColor = "#ffffff";
	}		
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}	
	
	// בדיקת שם מוצר
	doc = document.AddProduct.PRODUCTNAME;
	
	if(doc.value.length < 2 || doc.value.length > 25)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	else
	{
		doc.style.backgroundColor = "#ffffff";
	}	
	
	// בדיקת מחיר מוצר
	var doc = document.AddProduct.PRODUCTPRICE;
	
	if(doc.value.length == 0)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9' || doc.value[i] <= '.'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}		

	// בדיקת מלאי מוצר
	var doc = document.AddProduct.PRODUCTAMOUNT;
	
	if(doc.value.length == 0)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}
	
	return flag;
}

function check3(){
	var flag = true;

	// בדיקת קוד מוצר
	var doc = document.UpdateStock.PRODUCTID;
	
	if(!(doc.value.length == 5))
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}		
	else
	{
		doc.style.backgroundColor = "#ffffff";
	}		
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}		

	// בדיקת מלאי מוצר
	var doc = document.UpdateStock.PRODUCTAMOUNT;
	
	if(doc.value.length == 0)
	{
		flag = false;
		doc.style.backgroundColor = "#ffdede";
	}
	for(var i = 0; i < doc.value.length ; i++)
	{
		if(!(doc.value[i] >= '0' && doc.value[i] <= '9'))
		{
			flag = false;
			doc.style.backgroundColor = "#ffdede";	
		}			
	}

	return flag;
}
</script>

<?php

	if(isset($_POST['ProviderSubmit'])) // הוספת ספק
	{
		$PROVIDER_ID = $_POST['PROVIDERID'];
		$PROVIDER_NAME = $_POST['PROVIDERNAME'];
		$PROVIDER_PHONE = $_POST['PROVIDERPHONE'];

		$query = "select * from PROVIDERS WHERE PROVIDER_ID = ".$PROVIDER_ID;
		$result = mysqli_query($connection, $query);
		$providerInf = mysqli_fetch_array($result);
		
		if($providerInf['PROVIDER_ID'] == null) // במידה וספק לא קיים
		{
		$query = "INSERT INTO PROVIDERS VALUES(NULL, '$PROVIDER_ID', '$PROVIDER_NAME', '$PROVIDER_PHONE')";
		mysqli_query($connection, $query);
		echo "<script>window.open('ITEMS.php','_self');</script>";	
		}else echo "<script>document.getElementById('msgError1').style.visibility = 'visible'</script>";	
	}
	
	if(isset($_POST['ProductSubmit'])) // הוספת מוצר
	{
		$PRODUCT_ID = $_POST['PRODUCTID'];
		$PRODUCT_NAME = $_POST['PRODUCTNAME'];
		$PRODUCT_PRICE = $_POST['PRODUCTPRICE'];
		$PRODUCT_AMOUNT = $_POST['PRODUCTAMOUNT'];
		$PRODUCT_PROVIDER = $_POST['PRODUCTPROVIDER'];
		
		$query = "select * from PRODUCTS WHERE PRODUCT_ID = ".$PRODUCT_ID;
		$result = mysqli_query($connection, $query);
		$productInf = mysqli_fetch_array($result);
		
		if($productInf['PRODUCT_ID'] == null) // במידה והמוצר לא קיים
		{	
			$query = "INSERT INTO PRODUCTS VALUES(NULL, '$PRODUCT_ID', '$PRODUCT_NAME', '$PRODUCT_PRICE', '$PRODUCT_AMOUNT', '$PRODUCT_PROVIDER')";
			mysqli_query($connection, $query);
			echo "<script>window.open('ITEMS.php','_self');</script>";	
		}else echo "<script>document.getElementById('msgError2').style.visibility = 'visible'</script>";
	}
	
	if(isset($_POST['StockSubmit'])) // הוספת מלאי
	{
		$PRODUCT_ID = $_POST['PRODUCTID'];
		$PRODUCT_AMOUNT = $_POST['PRODUCTAMOUNT'];
	
		$query = "select * from PRODUCTS WHERE PRODUCT_ID = ".$PRODUCT_ID;
		$result = mysqli_query($connection, $query);
		$productInf = mysqli_fetch_array($result);
		
		if($productInf['PRODUCT_ID'] != null) // במידה והמוצר קיים
		{
			$newAmount = $productInf['AMOUNT'] + $PRODUCT_AMOUNT;
			
			$query = "update PRODUCTS set AMOUNT = '$newAmount' where PRODUCT_ID = ".$PRODUCT_ID;
			mysqli_query($connection, $query);
			
			echo "<script>window.open('ITEMS.php','_self');</script>";	
		}else echo "<script>document.getElementById('msgError3').style.visibility = 'visible'</script>";
	}	 
	
	
	
?>