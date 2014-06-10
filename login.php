<?php
include('connect.php');
include('secret/settings.conf');
?>

<html>
    <head>
        <title>Course Planner Login</title>
		<style>
			table,th,td
			{
			border:1px solid black;
			border-collapse:collapse

			}
			th,td
			{
			padding:5px;
			}
			th,h1
			{
			text-align:center;
			}
			h2
			{
			font-size:20px;
			text-align:center;
			}
	</style>
	</head>
	<body>
	
		<img src="utahLogo3.jpg">
		<img src="msis.jfif" align="right">
		<br><br><br>
		<h1>Login</h1>
		<h1>MSIS Course Planner</h1>
		<hr>
		<br><br><br>
		<form method='POST' name='plannerForm'>
		
		<div align='center' name='loginDiv'>
		<b>Enter your uNID:</b> <input type='text' name='uNID'> &nbsp&nbsp <b>Enter your password:</b> <input type='password' name='pwd'><br><br>
		<input type='submit' value='Login'><br>
		</div>
	
	</body>
</html>
<?php
if(isset($_POST['uNID']) and isset($_POST['pwd']) and $_POST['uNID']!="" and $_POST['pwd']!=""){
	$LoginuNID = $_POST['uNID'];
	$pwd = sha1($_POST['pwd']);
	$invalidCredentials = "N";

	$sql="SELECT UserID,IsAdmin,startSemester,finishSemester FROM user WHERE UID='$LoginuNID' AND Password='$pwd'";
	$results=mysqli_query($link,$sql);
	echo (!$results?die(mysqli_error($link)."<br>".$sql):"");
	$count = mysqli_num_rows($results);
	if($count>0){
		list($LoginUserID,$IsAdmin,$startSemester,$finishSemester)=mysqli_fetch_array($results);
		$timeOfLogin = time();
		$hash=sha1($IsAdmin.$secret.$LoginUserID.$LoginuNID.$timeOfLogin);
		$expirationTime = strtotime("+10 years");
		setcookie('IsAdmin',$IsAdmin,$expirationTime);
		setcookie('LoginUserID',$LoginUserID,$expirationTime);
		setcookie('LoginuNID',$LoginuNID,$expirationTime);
		setcookie('timeOfLogin',$timeOfLogin,$expirationTime);
		setcookie('hash',$hash,$expirationTime);
		if ($IsAdmin=="Y"){
			header('location:adminPanel.php');
		} else {
			header('location:CoursePlanner.php');
		}
		setcookie('StudentUserID',$LoginUserID,$expirationTime); //These two cookies will be reset to students later if the user is an admin
		setcookie('StudentuNID',$LoginuNID,$expirationTime);
		if($startSemester!=0 AND $finishSemester!=0){
			
		}
		
	} else {
		$invalidCredentials = "Y";
		echo "<div align='center'>Your login credentials are invalid. Please try again.</div>";
	}
}
?>
