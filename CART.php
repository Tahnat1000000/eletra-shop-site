<?php session_start(); 

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
		<a href="LOGOUT.php">Log out &nbsp;</a>
	</div>
</div>
<div class="line"></div>
<?php include('menubar.php');?>

<br><br>

<?php
	$cartCount = mysqli_num_rows(mysqli_query($connection, "select * from CART WHERE USER_ID = ".$_SESSION['userIn']));

	$query = "select * from CART WHERE USER_ID = ".$_SESSION['userIn']." order by NUM_OF_CART ASC";
	$result = mysqli_query($connection, $query);
	$cartInf = mysqli_fetch_array($result);
	
	if($cartCount > 0) // יש מוצרים בסל קניות
	{
		
		echo "<center><span><b> - Products are saved for 3 minutes in the cart - </b></span></center>";
		echo "<br>";
		
		$NeedToPay = 0;
		$index = $cartInf['NUM_OF_CART'];
		
		echo "<table align='center' style='font-size:20; width:50%; text-align: center;'>";
		
			echo "<tr style='color:#b2c8d4;'><td><b>Date</b></td>"."<td><b>Product Id</b></td>"."<td><b>Product Name</b></td>"."<td><b>Product Price<b/></td></tr>";	
			echo "<tr> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> </tr>";			
		
			for($i = 1 ; $i <= $cartCount ; $i++) // הצגת המוצרים בסל הקניות של המשתמש
			{
				if($i == 1) // לקיחת מוצרים ספציפיים של המשתמש עצמו מהסל קניות
				{
					$result = mysqli_query($connection, "select * from CART WHERE USER_ID = ".$_SESSION['userIn']." AND NUM_OF_CART = ".$index);
					$rawDetails = mysqli_fetch_array($result);	
				}
				else
				{
					$result = mysqli_query($connection, "select * from CART WHERE USER_ID = ".$_SESSION['userIn']." AND NUM_OF_CART > ".$index); 
					$rawDetails = mysqli_fetch_array($result);
					$index = $rawDetails['NUM_OF_CART'];					
				}
				
				$ProductId = $rawDetails['PRODUCT_ID'];
				$AddDate = $rawDetails['DATE'];
				$ExpDate = $rawDetails['EXP'];
				
				$result = mysqli_query($connection, "select * from PRODUCTS where NUM_OF_PRODUCT = $ProductId"); // נתונים של המוצר שנמצא בעגלת קניות
				
				if($result)
				{
					$productInf = mysqli_fetch_array($result);
					
					$ProductName = $productInf['PRODUCT_NAME'];
					$ProductPrice = $productInf['PRICE'];
					$NeedToPay += $ProductPrice;
					
					if(time() > $ExpDate) // מחיקת מוצרים שפג תוקפם מסל הקניות
						mysqli_query($connection, "DELETE FROM CART WHERE NUM_OF_CART = ".$index);
				
					echo "<tr> <td>".$AddDate."</td>"."<td>".$ProductId."</td>"."<td><b>".$ProductName."<b></td>"."<td>".$ProductPrice."$</td></tr>";
					echo "<tr> <td><hr></td> <td><hr></td> <td><hr></td> <td><hr></td> </tr>";	
				}
			}
			
			echo "<tr> <td></td> <td></td> <td></td> <td><b>$NeedToPay$</b></td> </tr>";
		echo "</table>";
		
		echo "<br>";
		
		// תשלום לקניית המוצרים בסל הקניות
		echo "<center>";
		echo "<fieldset id='CardWin' style='font-size:15px; width:650px; text-align:left;'>";
		echo "<legend style='color:#5991ad; font-size:19px;'><B>Payment Details</B></legend>";
			echo "<form name='PaymentDetails' action='CART.php' method='post' onsubmit='return check();'>";
			
			if($cardInf['CARD_NUMBER'] != null) // הוכנס פרטי כרטיס אשראי
			{
				echo "<input type='checkbox' name='UseMyDefCard' value='UseMyDefCard' onclick='check2()'> Use my defult card details";
				echo "<br><br>";
			}
			
				echo "Card Number: <input type='text' name='CardNumber'>&nbsp;<span id='wrongCardN'>Credit card number need to be 16 numbers</span>";
				echo "<br>";
				echo "Expiry Date: <input type='text' name='ExpiryDate'>&nbsp;<span id='wrongExpiryD'>Expiry date need to be 4 numbers, month and year(0120)</span>";
				echo "<br>";
				echo "CIV: <input type='text' name='CIV'>&nbsp;<span id='wrongCIV'>CIV need to be 3 numbers</span>";
				echo "<br>";
				echo "Owner ID: <input type='text' name='OwnerID'>&nbsp;<span id='wrongOwnerID'>ID needs to be only 9 numbers</span>";
				echo "<br><br>";
				echo "<input type='submit' name='submit' value='Buy items'>";
			echo "</form>";
		echo "</fieldset>";
		echo "</center>";
		
	}
	else // אין מוצרים בסל קניות
	{		
		echo "<center> <b style='font-size:25px;'>There is not items in the cart</b>";
		echo "<br>";
		echo "for add products to cart <a href='ITEMS.php'>Click here</a> </center>";
	}
?>

</body>
</html>

<style>
	.button3{
		background-color:#5991ad;
		border:1px solid #5991ad;
		color:#e7edf2;	
	}
</style>

<script>
	onload = document.getElementById("wrongExpiryD").hidden = true;
	onload = document.getElementById("wrongCardN").hidden = true;	
	onload = document.getElementById("wrongCIV").hidden = true;	
	onload = document.getElementById("wrongOwnerID").hidden = true;	
	
	function check()
	{
		var flag = true;

		// פרטי אשראי
		var DefCard = document.getElementsByName("UseMyDefCard")[0];
		var doc = document.PaymentDetails.CardNumber;
		var doc2 = document.PaymentDetails.ExpiryDate;
		var doc3 = document.PaymentDetails.CIV;
		var doc4 =document.PaymentDetails.OwnerID;
	
		if(DefCard.checked == true)
			return flag;
		
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
	
	
	function check2()
	{
		var DefCard = document.getElementsByName("UseMyDefCard")[0];
		var doc = document.PaymentDetails.CardNumber;
		var doc2 = document.PaymentDetails.ExpiryDate;
		var doc3 = document.PaymentDetails.CIV;
		var doc4 =document.PaymentDetails.OwnerID;
		
		if(DefCard.checked == true)
		{
			doc.disabled = true;
			doc2.disabled = true;
			doc3.disabled = true;
			doc4.disabled = true;
		}
		else
		{
			doc.disabled = false;
			doc2.disabled = false;
			doc3.disabled = false;
			doc4.disabled = false;		
		}
	}
</script>

<?php
	if(isset($_POST['submit']))
	{
		
		if(isset($_POST['CardNumber']))
		{
			$CARD_NUMBER = $_POST['CardNumber'];
			$EXPIRY_DATE = $_POST['ExpiryDate'];
			$CIV = $_POST['CIV'];
			$OWNER_ID = $_POST['OwnerID'];
		}
		else
		{
			$CARD_NUMBER = $cardInf['CARD_NUMBER'];
			$EXPIRY_DATE = $cardInf['EXPIRY_DATE'];
			$CIV = $cardInf['CIV'];
			$OWNER_ID = $cardInf['OWNER_ID'];				
		}
		
		
		$userId = $_SESSION['userIn'];
		$Date = date('Y-m-d');
		
		$index = $cartInf['NUM_OF_CART'];
		for($i = 1 ; $i <= $cartCount ; $i++) // קנייה של המוצרים ומחיקתם
		{
			if($i == 1) // לקיחת מוצרים ספציפיים של המשתמש עצמו מהסל קניות
			{
				$result = mysqli_query($connection, "select * from CART WHERE USER_ID = ".$_SESSION['userIn']." AND NUM_OF_CART = ".$index);
				$rawDetails = mysqli_fetch_array($result);	
			}
			else
			{
				$result = mysqli_query($connection, "select * from CART WHERE USER_ID = ".$_SESSION['userIn']." AND NUM_OF_CART > ".$index); 
				$rawDetails = mysqli_fetch_array($result);
				$index = $rawDetails['NUM_OF_CART'];					
			}
					
			$ProductId = $rawDetails['PRODUCT_ID'];
			
			$query = "insert into PURCHASE VALUE(null,'$userId','$ProductId','$Date','$CARD_NUMBER','$EXPIRY_DATE','$CIV','$OWNER_ID')"; // הכנסה לטבלת נקנה
			mysqli_query($connection, $query);
			
			$query = "select * from PRODUCTS WHERE PRODUCT_ID = $ProductId"; // הורדה מהמלאי
			$result = mysqli_query($connection, $query);
			$productInf = mysqli_fetch_array($result); 
			$newAmount = $productInf['AMOUNT'] - 1;
			$query = "update PRODUCTS set AMOUNT = '$newAmount' where PRODUCT_ID = $ProductId";
			mysqli_query($connection, $query);
			
			mysqli_query($connection, "DELETE FROM CART WHERE NUM_OF_CART = ".$index); // מחיקה מסל קניות
		}	
		echo "<script>window.open('CART.php','_self');</script>";	
	}
?>