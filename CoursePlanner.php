<?php
	include('verify.php');	// note that verify.php sets the variables $StudentUserID, $uNID, and $IsAdmin based on cookies
	include('functions.php');
	include('connect.php');
	include('secret/settings.conf');

	// The following code assumes that ID values for entries in the Term table are consecutively numbered in chronological order

	if (isset($_POST['courses'])){
		$courses=$_POST['courses'];
		$lastMinTermId=$_COOKIE['lastMinTermId'];
		$lastMaxTermId=$_COOKIE['lastMaxTermId'];

		for($termId=$lastMinTermId;$termId<$lastMaxTermId+1;$termId++){
			$sql="SELECT CourseID, CreditHours FROM UserCourse WHERE UserID=$StudentUserID AND TermID=$termId";
			$resultsSelect=mysqli_query($link,$sql);
			echo (!$resultsSelect?die(mysqli_error($link)):"");
			
			if (count(@$courses[$termId])>0){
				foreach($courses[$termId] as $tableCourseId){ // first look to add new records
					$isFound = 0;
					while(list($courseId,$hours)=mysqli_fetch_array($resultsSelect)){
						if($courseId==$tableCourseId){
							$isFound = 1;
							break;
						}
					}
					mysqli_data_seek($resultsSelect, 0);	//resets the array pointer to the beginning of the array
					if($isFound==0){	// a new selection in the table, needs to be entered into the DB
						$sql="INSERT INTO UserCourse (UserID,CourseID,TermID,CreditHours) (SELECT $StudentUserID, $tableCourseId, $termId, CreditHours FROM CourseTerm WHERE CourseID=$tableCourseId AND TermID=$termId)";
						$resultsInsert=mysqli_query($link,$sql);
						echo (!$resultsInsert?die(mysqli_error($link)):"");
					}
				}
			}

			while(list($courseId,$hours)=mysqli_fetch_array($resultsSelect)){ // now look to delete records for classes removed
				$isFound = 0;
				if (count(@$courses[$termId])>0){
					foreach($courses[$termId] as $tableCourseId){
						if($courseId==$tableCourseId){
							$isFound = 1;
							break;
						}
					}
				}
				if($isFound==0){	// a record needs to be removed from the DB
					$sql="DELETE FROM UserCourse WHERE UserID=$StudentUserID AND CourseID=$courseId AND TermID=$termId";
					$resultsDelete=mysqli_query($link,$sql);
					echo (!$resultsDelete?die(mysqli_error($link)):"");
				}
			}
		}

		$sql="UPDATE User SET startSemester=$lastMinTermId WHERE UserID=$StudentUserID";
		$resultsUpdate=mysqli_query($link,$sql);
		echo (!$resultsUpdate?die(mysqli_error($link)):"");

		echo "<script type='text/javascript'>
				alert('Your course planner has been saved');
			</script>";
	}

	// first check to see if this form has posted back, with values already selected for the start and finish semesters
	if (isset($_POST['startSemester']) and isset($_POST['finishSemester'])) {
		$minTermId = $_POST['startSemester'];
		$maxTermId = $_POST['finishSemester'];
	} else {	// if the form isn't posting back, then try to get start and finish semesters from a saved plan in the database
		$sql="SELECT MIN(TermID),MAX(TermID) FROM UserCourse WHERE UserID = $StudentUserID";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");

		list($minTermId, $maxTermId)=mysqli_fetch_array($results);	// these TermId values will be 0 if there was no saved plan found
		if ($minTermId == 0){
			// finally, if start and finish semesters are still not determined, simply set them to cover the current year
			$sql="SELECT MIN(TermID),MAX(TermID) FROM Term WHERE Year=".date('Y');
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");

			list($minTermId, $maxTermId)=mysqli_fetch_array($results);
		}
	}

	// limit the selected terms to no fewer than 3, careful not to exceed the last entry in the Term table
	if ($maxTermId-$minTermId < 2){
		$maxTermId = $minTermId + 2;

		$sql="SELECT MAX(TermID) FROM Term";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");

		list($lastTermEntry)=mysqli_fetch_array($results);
		if ($lastTermEntry < $maxTermId){
			$maxTermId = $lastTermEntry;
			$minTermId = $maxTermId - 2;
		}
	}
	setcookie('lastMinTermId',$minTermId,strtotime("+10 years"));
	setcookie('lastMaxTermId',$maxTermId,strtotime("+10 years"));
?>

<html>
<head>
<title>MSIS Course Planner</title>

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
<form method='POST' name='plannerForm'>
<img src="utahLogo3.jpg">
<img src="msis.jfif" align="right">
<br><br><br>
<h1>MSIS Course Planner</h1>
<div align='right' ><input type='button' onclick="window.location='logout.php'" value='Logout'></div>
<hr>
Select your starting semester: 
<select name='startSemester'>
<?php
 $sql="SELECT TermID,Year,Season FROM term ORDER BY TermID";
 $results=mysqli_query($link,$sql);
 echo (!$results?die(mysqli_error($link)):"");
 while(list($termId,$year,$season)=mysqli_fetch_array($results)){
	if($minTermId==$termId){
		echo "<option value='$termId' selected>$season $year</option>";
	}
	else{
		echo "<option value='$termId'>$season $year</option>";
	}
 }
 ?>
 </select>
 
 &nbsp&nbsp&nbsp Select the semester you expect to finish in: 
 <select name='finishSemester'>
<?php
mysqli_data_seek($results, 0);	//resets the array pointer to the beginning of the array
while(list($termId,$year,$season)=mysqli_fetch_array($results)){
	if($maxTermId==$termId){
		echo "<option value='$termId' selected>$season $year</option>";
	}
	else{
		echo "<option value='$termId'>$season $year</option>";
	}
}
?>
</select>
&nbsp&nbsp&nbsp <input type='submit' value='Build Course Planner'>
</form>
<br>

<?php
	$totalCredits=0;
	echo "<form method='POST' name='courseSelector'>";
	echo "<h2>Course Plan for $StudentuNID</h2>";
	echo "Click <button type='button'>IS 6xxx</button> for course description.
		<table>
			<colgroup>
			<col width='500'>
			</colgroup>
			<tr>
				<th>Course & Credit Hours</th>
			</tr>";
	printCoursesToTable($StudentuNID,$minTermId,$maxTermId);
	
	//This code searches through each Term that the student has courses saved, and add's up the selected courses Credit Hours
	$creditsArray=array();
	$totalCredits=0;
	$sql="SELECT CreditHours,TermID FROM usercourse WHERE UserID='$StudentUserID'";
	$results=mysqli_query($link,$sql);
	echo (!$results?die(mysqli_error($link)):"");
	while(list($CreditHours,$termId)=mysqli_fetch_array($results)){
		@$creditsArray[$termId] = $creditsArray[$termId] + $CreditHours;
		$totalCredits=$totalCredits+@$creditsArray[$i];
	 }
	if((count($creditsArray))>0){ 
		echo "<tr>
				<td align='right'><b>Total Credits Each Semester:</b></td>";
				for($i=$minTermId;$i<$maxTermId+1;$i++){
					if(@$creditsArray[$i]>0){
						echo "<td align='center'>$creditsArray[$i]</td>";
						$totalCredits=$totalCredits+@$creditsArray[$i];
					}
					else{
						echo "<td align='center'>0</td>";
					}
				}
		echo "<td>Total: $totalCredits</td>";
		echo "</tr>";
	}
	else{
		echo "<tr>
				<td align='right'><b>Total Credits Each Semester:</b></td>";
				for($i=$minTermId;$i<$maxTermId+1;$i++){
					echo "<td align='center'>0</td>";
					$totalCredits=$totalCredits+@$creditsArray[$i];
				}
		echo "<td>Total: $totalCredits</td>";
		echo "</tr>";
	}
	echo "</table><br>";
	echo "<table>
			<tr>
				<td width='100'><b>Area of focus:</b></td>
				<td width='150' bgcolor='#FA9494'>Software Systems & Architecture</td>
				<td width='150' bgcolor='#FFFC00'>IT Security</td>
				<td width='150' bgcolor='#3B9ABD'>Business Intelligence & Analytics</td>
				<td width='150' bgcolor='#3BBD48'>Product & Process Management</td>
			</tr>
		   </table><br>";
	echo "<div align='center'><input type='submit' value='Save Course Planner'></div>";
	echo "</form>";
?>
</form>
</body>
</html>
