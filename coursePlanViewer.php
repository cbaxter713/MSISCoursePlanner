<html>
<head>
<title>Administration Course Plan Viewer</title>
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
h3
{
font-size:20px;
text-align:right;
}
div.show{
        display: block; 
}
div.hide{
   display: none; 
}
</style>
<script type='text/javascript'>
var $=function(id){
        return document.getElementById(id);
}

var notesShowClickHandle=function(){
        $('notesDivID').setAttribute('class','show');
}
var notesHideClickHandle=function(){
        $('notesDivID').setAttribute('class','hide');
}

window.onload=function(){
        $('showNotesID').onclick = notesShowClickHandle;
        $('hideNotesID').onclick = notesHideClickHandle;
}
</script>


<?php
	include('functions.php');
	include('verifyAdmin.php');
	include('connect.php');
	include('secret/settings.conf');
?>

</head>

<body>
<form method='POST' name='adminForm'>
<img src="utahLogo3.jpg">
<img src="msis.jfif" align="right">
<br><br><br>
<h1>Administration Panel: Course Plan Viewer</h1>
<div align='right' ><input type='button' onclick="window.location='logout.php'" value='Logout'></div>
<hr>
<input type='button' onclick="window.location='adminPanel.php'" value='Back to Main Admin Panel'>

<br>
<br>

<?php 
	// First save data if this is a post-back
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
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");

		echo "<script type='text/javascript'>
				alert('Your course planner has been saved');
			</script>";
	}
?>


<?php //This is the code to build the course planner table for the searched student....details about student are taken from cookies. 
 if(isset($_COOKIE['StudentuNID']) and $_COOKIE['StudentuNID']!=""){
		
		$StudentuNID=$_COOKIE['StudentuNID'];
		$sql="SELECT capstoneViews,officialStart,officialFinish,status,IS4410,notes FROM user WHERE UID='$StudentuNID'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($capstoneViews,$officialStart,$officialFinish,$status,$IS4410,$notes)=mysqli_fetch_array($results);
		
		if($IS4410=="Y"){
			$IS4410="Yes";
		}
		else if($IS4410=="N"){
			$IS4410="No";
		}

		
		echo "<h2>Course Plan for $StudentuNID</h2>";

		echo "<form method='POST' name='courseSelector'>";
		
		echo "Show Notes: <input type='radio' name='notesRadio' id='showNotesID'> &nbsp&nbsp
				Hide Notes: <input type='radio' name='notesRadio' id='hideNotesID'><br><br>";
		echo "<div align='center' id='notesDivID' class='hide'>";
		echo "Notes: <br><textarea rows='10' cols='100' name='enteredNotes'>$notes</textarea><br><br>";
		echo "</div>";
		
		echo "Click <button type='button'>IS 6xxx</button> for course description.
			<table>
				<colgroup>
				<col width='500'>
				</colgroup>
				<tr>
					<th>Course & Credit Hours</th>
				</tr>";

		// first check to see if this form has posted back, with values already selected for the start and finish semesters
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

		printCoursesToTable($StudentuNID,$minTermId,$maxTermId);
		
		//This code searches through each Term that the student has courses saved, and add's up the selected courses Credit Hours
		$creditsArray=array();
		$totalCredits=0;
		$sql="SELECT CreditHours,TermID FROM usercourse WHERE UserID='$StudentUserID'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		while(list($CreditHours,$TermID)=mysqli_fetch_array($results)){
			@$creditsArray[$TermID] = $creditsArray[$TermID] + $CreditHours;
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
		echo "</table><br><br>";
		
		
		//All of the code below is for the Official Student Status Table at the bottom of the page. 
		$selected0="";
		$selected1="";
		$selected2="";
		if($capstoneViews==0){
			$selected0="selected";
		}
		else if($capstoneViews==1){
			$selected1="selected";
		}
		else if($capstoneViews==2){
			$selected2="selected";
		}
		
		$selectedYes="";
		$selectedNo="";
		if($IS4410=="Yes"){
			$selectedYes="selected";
		}
		else if($IS4410=="No"){
			$selectedNo="selected";
		}
		
		//The Table below is for the Administrator to view/set official student status information. 
		echo "<div align='center'>";
		echo "<b>Official Student Status</b><br>";
		echo "**Use the listboxes below to set student status. Be sure to save the course planner if any changes are made**<br>";
		echo "**After saving, be sure to refresh your browser to see updated status values**<br><br>";
		
		echo "<table>";
		echo "<tr>
				<td></td>
				<th>Student Status</th>
				<th>Set New Status</th>
			  </tr>";
		echo "<tr>
				<td align='right'>Needs IS 4410?</td>
				<td align='center'>$IS4410</td>
				<td align='center'><select name='IS4410'><option value='Y' $selectedYes>Yes</option><option value='N' $selectedNo>No</option></select></td>
			  </tr>"; 
		echo "<tr>
				<td align='right'>Capstone Presentations Viewed:</td>
				<td align='center'>$capstoneViews</td>
				<td align='center'><select name='capstoneViews'><option value=0 $selected0>0</option><option value=1 $selected1>1</option><option value=2 $selected2>2</option></select></td>
			  </tr>";  
		
		//This statement is to take the officialStart/Finish terms and translate them into Season and Year
		$officialStartSemester="--";
		$officialFinishSemester = "--";
		$sql="SELECT TermID,Year,Season FROM term";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		while(list($termID,$year,$season)=mysqli_fetch_array($results)){
			if($officialStart==$termID){
				$officialStartSemester="$season $year";
			}	
			else if($officialFinish==$termID){
				$officialFinishSemester = "$season $year";
			}	
		}
		
		echo "<tr>
		<td align='right'>Official Start Semester:</td>
		<td align='center'>$officialStartSemester</td>
		<td align='center'><select name='officialStart'><option value='0'>--</option>";
		$sql="SELECT TermID,Year,Season FROM term";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		while(list($termID,$year,$season)=mysqli_fetch_array($results)){
			if($officialStart==$termID){
				echo "<option value='$termID' selected>$season $year</option>";
			}	
			else{
				echo "<option value='$termID'>$season $year</option>";
			}
		}
		
		echo "<tr>
		<td align='right'>Official Finish Semester:</td>
		<td align='center'>$officialFinishSemester</td>
		<td align='center'><select name='officialFinish'><option value='0'>--</option>";
		$sql="SELECT TermID,Year,Season FROM term";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		while(list($termID,$year,$season)=mysqli_fetch_array($results)){
			if($officialFinish==$termID){
				echo "<option value='$termID' selected>$season $year</option>";
			}	
			else{
				echo "<option value='$termID'>$season $year</option>";
			}
		}
		
		$selectedStudent="";
		$selectedGrad="";
		$selectedDNF="";
		if($status=="Current Student"){
			$selectedStudent="selected";
		}
		else if($status=="Graduated"){
			$selectedGrad="selected";
		}
		else if($status=="Did Not Finish"){
			$selectedDNF="selected";
		}
		  
		echo "<tr>
				<td align='right'>Enrollment Status:</td>
				<td align='center'>$status</td>
				<td align='center'><select name='status'><option value='Current Student' $selectedStudent>Current Student</option><option value='Graduated' $selectedGrad>Graduated</option><option value='Did Not Finish' $selectedDNF>Did Not Finish</option></select></td>
			  </tr>";   
					  
		echo "</table><br>";
		
		echo "<input type='submit' value='Save Course Planner'></div>";
		echo "</form>";
		
		//THIS Code is to take any changes to the official student status and save it to the database. 
		$expirationTime = strtotime("+1 hour");

		if(isset($_POST['capstoneViews']) and $_POST['capstoneViews']!=""){
			$changedCapstone = @$_POST['capstoneViews'];
		
			$sql="UPDATE user SET capstoneViews='$changedCapstone' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// $_COOKIE['capstoneViews']=$changedCapstone;
		}
		if(isset($_POST['IS4410']) and $_POST['IS4410']!=""){
			$changedIS4410 = @$_POST['IS4410'];
			$sql="UPDATE user SET IS4410='$changedIS4410' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// setcookie('IS4410',$changedIS4410,$expirationTime);
		}
		if(isset($_POST['officialStart']) and $_POST['officialStart']!=""){
			$changedStart = @$_POST['officialStart'];
			$sql="UPDATE user SET officialStart='$changedStart' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// setcookie('officialStart',$changedStart,$expirationTime);
		}
		if(isset($_POST['officialFinish']) and $_POST['officialFinish']!=""){
			$changedFinish = @$_POST['officialFinish'];
			$sql="UPDATE user SET officialFinish='$changedFinish' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// setcookie('officialFinish',$changedFinish,$expirationTime);
		}
		if(isset($_POST['status']) and $_POST['status']!=""){
			$changedStatus = @$_POST['status'];
			$sql="UPDATE user SET status='$changedStatus' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// setcookie('status',$changedStatus,$expirationTime);
		}
		if(isset($_POST['enteredNotes']) and $_POST['enteredNotes']!=""){
			$changedNotes = @$_POST['enteredNotes'];
			$sql="UPDATE user SET notes='$changedNotes' WHERE UID='$StudentuNID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			// setcookie('status',$changedStatus,$expirationTime);
		}
	}
 ?>





</form>
</body>
</html>
