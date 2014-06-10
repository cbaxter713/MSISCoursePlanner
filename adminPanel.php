<html>
<head>
<title>Administration Panel</title>

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
background-color:DD3D3D;
color: #FFFFFF;
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

var studentSearchClickHandle=function(){
        $('studentSearchDiv').setAttribute('class','show');
		document.cookie="studentSearchDiv=show";
		
		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var coursePlannerReportClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','show');
		document.cookie="coursePlannerReportDiv=show";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var capstoneClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','show');
		document.cookie="capstoneDiv=show";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var IS4410ClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','show');
		document.cookie="IS4410Div=show";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var addCourseClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','show');
		document.cookie="addCourseDiv=show";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var modifyCourseClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','show');
		document.cookie="modifyCourseDiv=show";
		
		$('addUserDiv').setAttribute('class','hide');
		document.cookie="addUserDiv=hide";
}
var addUserClickHandle=function(){
		$('studentSearchDiv').setAttribute('class','hide');
		document.cookie="studentSearchDiv=hide";

		$('coursePlannerReportDiv').setAttribute('class','hide');
		document.cookie="coursePlannerReportDiv=hide";
		
		$('capstoneDiv').setAttribute('class','hide');
		document.cookie="capstoneDiv=hide";
		
		$('IS4410Div').setAttribute('class','hide');
		document.cookie="IS4410Div=hide";
		
		$('addCourseDiv').setAttribute('class','hide');
		document.cookie="addCourseDiv=hide";
		
		$('modifyCourseDiv').setAttribute('class','hide');
		document.cookie="modifyCourseDiv=hide";
		
		$('addUserDiv').setAttribute('class','show');
		document.cookie="addUserDiv=show";
}

window.onload=function(){
        $('studentSearchButton').onclick = studentSearchClickHandle;
        $('coursePlannerReportButton').onclick = coursePlannerReportClickHandle;
		$('capstoneButton').onclick = capstoneClickHandle;
        $('IS4410Button').onclick = IS4410ClickHandle;
        $('addCourseButton').onclick = addCourseClickHandle;
		$('modifyCourseButton').onclick = modifyCourseClickHandle;
        $('addUserButton').onclick = addUserClickHandle;

}
</script>

<?php
	// ob_start();
	// ob_flush();
	include('functions.php');
	include('verifyAdmin.php');
	include('connect.php');
	include('secret/settings.conf');
?>

</head>

<body>

<?php
//This code sets the show/hide attributes of each div in the page based on whether or not any cookies have been set by button clicks

	if(isset($_COOKIE['studentSearchDiv']) and $_COOKIE['studentSearchDiv']!="" and 
	isset($_COOKIE['coursePlannerReportDiv']) and $_COOKIE['coursePlannerReportDiv']!="" and 
	isset($_COOKIE['capstoneDiv']) and $_COOKIE['capstoneDiv']!="" and 
	isset($_COOKIE['IS4410Div']) and $_COOKIE['IS4410Div']!="" and 
	isset($_COOKIE['addCourseDiv']) and $_COOKIE['addCourseDiv']!="" and 
	isset($_COOKIE['modifyCourseDiv']) and $_COOKIE['modifyCourseDiv']!="" and 
	isset($_COOKIE['addUserDiv']) and $_COOKIE['addUserDiv']!=""){
		$reportDisplay = $_COOKIE['coursePlannerReportDiv'];
		$searchDisplay = $_COOKIE['studentSearchDiv'];
		$capstoneDisplay = $_COOKIE['capstoneDiv'];
		$IS4410Display = $_COOKIE['IS4410Div'];
		$addCourseDisplay = $_COOKIE['addCourseDiv'];
		$modifyCourseDisplay = $_COOKIE['modifyCourseDiv'];
		$addUserDisplay = $_COOKIE['addUserDiv'];
	}
	else{
		$reportDisplay = "hide";
		$searchDisplay = "hide";
		$capstoneDisplay = "hide";
		$IS4410Display = "hide";
		$addCourseDisplay = "hide";
		$modifyCourseDisplay = "hide";
		$addUserDisplay = "hide";
	}
?>


<img src="utahLogo3.jpg">
<img src="msis.jfif" align="right">
<br><br><br>
<h1>Administration Panel</h1>
<div align='right' ><input type='button' onclick="window.location='logout.php'" value='Logout'></div>
<div align='center' name='buttonBar' style="background-color:#EEEEEE;">
<hr>
<input type='button' id='studentSearchButton' value='Student Course Planner Search'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='coursePlannerReportButton' value='Course Planner Reports'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='capstoneButton' value='Capstone Views'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='IS4410Button' value='IS 4410 Students'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='addCourseButton' value='Add a Course to the Plan of Study'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='modifyCourseButton' value='Modify a Course'> &nbsp&nbsp | &nbsp&nbsp
<input type='button' id='addUserButton' value='Add a User to the System'>
<hr>
</div>

<div align='center' id='studentSearchDiv' class='<?php echo $searchDisplay; ?>'>
<form method='POST' name='studentSearchForm'>
<h2>Student Course Planner Search</h2>
Enter a uNID:
<input type='text' name='studentSearch'>
<input type='submit' value='Search'><br>
<br>

<?php
	// ob_start();
	// ob_flush();
	if(isset($_POST['studentSearch']) and $_POST['studentSearch']!="" ){
		$studentSearch=@$_POST['studentSearch'];
		$sql="SELECT UserID,UID,isAdmin,capstoneViews,officialStart,officialFinish,status,IS4410 FROM user WHERE UID='$studentSearch'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($UserID,$UID,$isAdmin,$capstoneViews,$officialStart,$officialFinish,$status,$IS4410)=mysqli_fetch_array($results);
		
		if($UID!="" AND $isAdmin=="N"){
		
			$expirationTime = strtotime("+10 years");
			// setcookie('StudentUserID',$UserID,$expirationTime);
			// setcookie('StudentuNID',$UID,$expirationTime);
			// setcookie('capstoneViews',$capstoneViews,$expirationTime);
			// setcookie('officialStart',$officialStart,$expirationTime);
			// setcookie('officialFinish',$officialFinish,$expirationTime);
			// setcookie('status',$status,$expirationTime);
			// setcookie('IS4410',$IS4410,$expirationTime);
			// header('location:coursePlanViewer.php');
			
			//Use this echo below to mimic the commented out code above...in order to side step the error of headers already being set earlier. 
			echo "<script>
					document.cookie='StudentUserID=$UserID';
					document.cookie='StudentuNID=$UID';
					document.cookie='capstoneViews=$capstoneViews';
					document.cookie='officialStart=$officialStart';
					document.cookie='officialFinish=$officialFinish';
					document.cookie='status=$status';
					document.cookie='IS4410=$IS4410';
				  
					window.location = 'coursePlanViewer.php'</script>";
		}
		else if($UID!="" AND $isAdmin=="Y"){
			echo "The user $UID is an Administrator for this site and does not have a saved course plan.";
		}
		else if($UID==null OR $UID==""){
			echo "The user $studentSearch does not exist in the system.";
		}
	}
?>
</form>
</div>

<div align='center' id='coursePlannerReportDiv' class='<?php echo $reportDisplay; ?>'>
<form method='POST' name='courseSearchForm'>
<h2>Course Planner Reports</h2>
<b>Number of Students Planning to Take a Course</b><br>
Select a course: 

<select name='selectedCourse'>
<?php
	$sql="SELECT CourseID,CourseNumber,Title FROM course";
	$results=mysqli_query($link,$sql);
	$numCourses=mysqli_num_rows($results);
	$selectedArray=array();
	for($i=1;$i<$numCourses+1;$i++){
		if(isset($_POST['currentCourse']) and $_POST['currentCourse']!="" and $_POST['currentCourse']==$i){
			$selectedArray[$i]="selected";
		}
		else{
			$selectedArray[$i]="";
		}
	}
	echo (!$results?die(mysqli_error($link)):"");
	
	while(list($courseID,$courseNumber,$courseTitle)=mysqli_fetch_array($results)){
		echo "<option value='$courseID' $selectedArray[$courseID]>$courseNumber: $courseTitle</option>";
	}
	echo "</select>";
 ?>
 </select>&nbsp&nbsp&nbsp
 
 Select a semester:
 <select name='semester'>
<?php
 $sql="SELECT TermID,Year,Season FROM term";
 $results=mysqli_query($link,$sql);
 echo (!$results?die(mysqli_error($link)):"");
 while(list($termID,$year,$season)=mysqli_fetch_array($results)){
	echo "<option value=$termID>$season $year</option>";
 }
 ?>
 </select>&nbsp&nbsp
 <input type='submit' id='coursePlannerReportSubmit' value='Submit'><br>
 <br>
 <?php
	if(isset($_POST['semester']) and $_POST['semester']!="" and 
	isset($_POST['selectedCourse']) and $_POST['selectedCourse']!=""){
		$courseID=@$_POST['selectedCourse'];
		$sql="SELECT CourseNumber FROM course WHERE CourseID='$courseID'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($courseNumber)=mysqli_fetch_array($results);
		
		$semester=@$_POST['semester'];
		$sql="SELECT Year,Season FROM term WHERE TermID='$semester'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($year,$season)=mysqli_fetch_array($results);
		$selectedSemester="$season $year";
		
		$sql="SELECT COUNT(UserID) FROM usercourse WHERE CourseID=$courseID AND TermID=$semester";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($count)=mysqli_fetch_array($results);
	 
		if(!$courseID==""){
			echo "<table>
					<tr>
						<th>Course</th>
						<th>Semester</th>
						<th># of Students</th>
					</tr>
					<tr align='center'>
						<td>$courseNumber</td>
						<td>$selectedSemester</td>
						<td>$count</td>
					</tr>
				  </table>";
			}
	}
 ?>
</form>
</div><!--End of coursePlannerReportsDiv-->

<div align='center' id='capstoneDiv' class='<?php echo $capstoneDisplay; ?>'>
<?php
	if(isset($_POST['capstoneViewsSelector']) and $_POST['capstoneViewsSelector']!=""){
		$numberViews = $_POST['capstoneViewsSelector'];
		if($numberViews==1){
			$selected1="selected";
			$selected2="";
			$selectedAny="";
		}
		else if($numberViews==2){
			$selected2="selected";
			$selected1="";
			$selectedAny="";
		}
		elseif($numberViews=="Any"){
			$selectedAny="selected";
			$selected1="";
			$selected2="";
		}	
	}
	else{
		$selectedAny="selected";
		$selected1="";
		$selected2="";
	}
?>

<form method='POST' name='capstoneForm'>
<h2>Capstone Views</h2>
<b>Students who still need to view 
<select name='capstoneViewsSelector'>
	<option value=1 <?php echo $selected1; ?>>1</option>
	<option value=2 <?php echo $selected2; ?>>2</option>
	<option value="Any" <?php echo $selectedAny; ?>>Any</option>
</select>
Capstone Presentations</b>&nbsp&nbsp
<input type='submit' value='Search Students'><br><br>

<?php
	if(isset($_POST['capstoneViewsSelector']) and $_POST['capstoneViewsSelector']!=""){
		$numberViews = $_POST['capstoneViewsSelector'];
		
		if($numberViews==1){
			$sql="SELECT UID FROM user WHERE capstoneViews='1' AND isAdmin='N'";
		}
		else if($numberViews==2){
			$sql="SELECT UID FROM user WHERE capstoneViews='0' AND isAdmin='N'";
		}
		else{
			$sql="SELECT UID FROM user WHERE capstoneViews<'2' AND isAdmin='N'";
		}
			
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		$numberOfStudents = mysqli_num_rows($results);
		echo "Number of Students: $numberOfStudents <br>";
		while(list($capstoneStudents)=mysqli_fetch_array($results)){
			echo "$capstoneStudents <br>";
		}
	}
?>
</form>
</div>

<div align='center' id='IS4410Div' class='<?php echo $IS4410Display; ?>'>
<form method='POST' name='IS4410Form'>
<h2>IS 4410 Students</h2>
<b>Students who still need to take IS 4410</b>&nbsp&nbsp
<br><br>

<?php		
		$sql="SELECT UID FROM user WHERE IS4410='Y' AND isAdmin='N'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		$numberOfStudents = mysqli_num_rows($results);
		echo "Number of Students: $numberOfStudents <br>";
		while(list($IS4410Students)=mysqli_fetch_array($results)){
			echo "$IS4410Students <br>";
		}
?>
</form>
</div>

<div align='center' id='addCourseDiv' class='<?php echo $addCourseDisplay; ?>'>
<form method='POST' name='addCourseForm'>
<h2>Add a Course to the Plan of Study</h2>

<div align='center'>**Fields in <b>BOLD</b> are required**</div>
<table style="border: 0px solid black;">
	<tr bgcolor='#F0EDED'>
		<td><b>Course Number (i.e. IS 4410 or ACCTG 6520):</b> <input type='text' name='courseNumber'></td>
	</tr>
	<tr>
		<td><b>Course Title (i.e. Web Based Applications):</b><input type='text' name='courseTitle' size=50></td>
	</tr>
	<tr bgcolor='#F0EDED'>
		<td><b>Classification:</b> <select name='classification'>
											<?php
												$sql="SELECT ClassificationID,ClassDescription FROM Classification";
													$results=mysqli_query($link,$sql);
													echo (!$results?die(mysqli_error($link)):"");
													while(list($ClassID,$ClassName)=mysqli_fetch_array($results)){
														echo "<option value='$ClassID'>$ClassName</option>";
													}
											?>
											</select></td>
	</tr>
	<tr>
		<td><b>Credit Hours:</b>
							<select name='creditHours'>
								<option value='1.0'>1.0</option>
								<option value='1.5'>1.5</option>
								<option value='3.0'>3.0</option>
							</select></td>
	</tr>
	<tr bgcolor='#F0EDED'>
		<td>Description URL (<a href='http://catalog.utah.edu/preview_course_nopop.php?catoid=4&coid=39855'>Utah Course Catalog</a>):
			<input type='text' name='hyperlink' size=40 value='http://'></td>
	</tr>
	<tr>
		<td>Term(s) Offered:&nbsp&nbsp Spring <input type='checkbox' name='termCheck[]' value='Spring'> &nbsp&nbsp|
						&nbsp&nbsp Summer <input type='checkbox' name='termCheck[]' value='Summer'> &nbsp&nbsp|
						&nbsp&nbsp Fall <input type='checkbox' name='termCheck[]' value='Fall'></td>
	</tr>
	</table><br>
	<div align='center'><input type='submit' value='Add Course to Plan of Study'></div>
<br>

<?php
	if(isset($_POST['courseNumber']) and $_POST['courseNumber']!="" and 
	isset($_POST['courseTitle']) and $_POST['courseTitle']!="" and 
	isset($_POST['classification']) and $_POST['classification']!="" and 
	isset($_POST['creditHours']) and $_POST['creditHours']!=""){
		
		$courseNumber = $_POST['courseNumber'];
		$courseTitle = $_POST['courseTitle'];
		$classification = $_POST['classification'];
		$creditHours = $_POST['creditHours'];
		$hyperlink = @$_POST['hyperlink'];
		$terms = @$_POST['termCheck'];
		
		$sqlInsert="INSERT INTO course(CourseNumber,Title,ClassificationID,CreditHours,Hyperlink) 
					VALUES('$courseNumber','$courseTitle','$classification','$creditHours','$hyperlink')";
		$resultsInsert=mysqli_query($link,$sqlInsert);
		echo (!$resultsInsert?die(mysqli_error($link)):"");
		
		$sql="SELECT CourseID FROM course WHERE Title='$courseTitle'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		list($courseID)=mysqli_fetch_array($results);
		
		$termCount = count($terms);
		for($i=0;$i<$termCount;$i++){
			$season = $terms[$i];
			if($season=="Fall"){
				$j=1;
			}
			else if($season=="Spring"){
				$j=2;
			}
			else if($season=="Summer"){
				$j=3;
			}
			
			for($j;$j<26;$j=$j+3){
				$sqlInsert="INSERT INTO courseterm(CourseID,TermID,CreditHours) VALUES('$courseID','$j','$creditHours')";
				$resultsInsert=mysqli_query($link,$sqlInsert);
				echo (!$resultsInsert?die(mysqli_error($link)):"");
			}
		}
		
		echo "The course: $courseNumber $courseTitle was successfully added to the database!";
	}
	else{
		echo "<div align='center'>Please fill out all required fields.</div>";
	}
			
?>

</form>
</div>

<div align='center' id='modifyCourseDiv' class='<?php echo $modifyCourseDisplay; ?>'>
<form method='POST' name='modifyCourseForm'>
<h2>Modify a Course</h2>

<b>Select a Current Course: </b>
<select name='currentCourse'>
<?php
	$sql="SELECT CourseID,CourseNumber,Title,CreditHours FROM course";
	$results=mysqli_query($link,$sql);
	$numCourses=mysqli_num_rows($results);
	$selectedArray=array();
	for($i=1;$i<$numCourses+1;$i++){
		if(isset($_POST['currentCourse']) and $_POST['currentCourse']!="" and $_POST['currentCourse']==$i){
			$selectedArray[$i]="selected";
		}
		else{
			$selectedArray[$i]="";
		}
	}
	echo (!$results?die(mysqli_error($link)):"");
	
	while(list($courseID,$courseNumber,$courseTitle,$creditHours)=mysqli_fetch_array($results)){
		echo "<option value='$courseID' $selectedArray[$courseID]>$courseNumber: $courseTitle ($creditHours)</option>";
	}
	echo "</select>";

	echo "<input type='submit' value='Select'><br><br>";

	if(isset($_POST['currentCourse']) and $_POST['currentCourse']!=""){
		$selectedCourseID=$_POST['currentCourse'];
		$sql="SELECT CourseID,CourseNumber,Title,CreditHours,Hyperlink FROM course WHERE CourseID='$selectedCourseID'";
		$results=mysqli_query($link,$sql);
		list($courseID,$courseNumber,$courseTitle,$creditHours,$hyperlink)=mysqli_fetch_array($results);
		
		echo "<b><u>Your Selected Course</u></b><br><br>";
		echo "Course Number: <input type='text' name='newCourseNumber' value='$courseNumber'>&nbsp&nbsp";
		echo "Course Title: <input type='text' name='newCourseTitle' value='$courseTitle' size=45>&nbsp&nbsp";
		
		//The code below is to determine what the selected value for Credit Hours list box should be. 
		$selected1="";
		$selected15="";
		$selected3="";
		if($creditHours=="1.0"){
			$selected1="selected";
		}
		else if($creditHours=="1.5"){
			$selected15="selected";
		}
		if($creditHours=="3.0"){
			$selected3="selected";
		}
		echo "Credit Hours: <select name='newCreditHours'>
								<option value='1.0' $selected1>1.0</option>
								<option value='1.5' $selected15>1.5</option>
								<option value='3.0' $selected3>3.0</option>
							 </select><br>";
    	echo "Description URL: <input type='text' name='newHyperlink' value='$hyperlink' size=70><br>";
		
		$sql="SELECT TermID FROM courseterm WHERE CourseID='$selectedCourseID'";
		$results=mysqli_query($link,$sql);
		$termArrLength = mysqli_num_rows($results);
		if($termArrLength>0){
			$termCounter=0;
			$fall="";
			$spring="";
			$summer="";
			while(list($termID)=mysqli_fetch_array($results) and $termCounter<4){
				if($termID==2){
					$spring="checked";
				}
				else if($termID==3){
					$summer="checked";
				}
				else if($termID==1){
					$fall="checked";
				}
				
				$termCounter++;
			}
			echo "Term(s) Offered:&nbsp&nbsp Spring <input type='checkbox' name='termCheck[]' value='2' $spring> &nbsp&nbsp|
						&nbsp&nbsp Summer <input type='checkbox' name='termCheck[]' value='3' $summer> &nbsp&nbsp|
						&nbsp&nbsp Fall <input type='checkbox' name='termCheck[]' value='1' $fall><br><br>";
		}
		else{
			echo "Term(s) Offered:&nbsp&nbsp Spring <input type='checkbox' name='termCheck[]' value='2'> &nbsp&nbsp|
						&nbsp&nbsp Summer <input type='checkbox' name='termCheck[]' value='3'> &nbsp&nbsp|
						&nbsp&nbsp Fall <input type='checkbox' name='termCheck[]' value='1'><br><br>";
		}
		
		echo "<input type='submit' value='Modify Course in Database'><br>";
		echo "**Browser must be refreshed to see any changes made to a course**<br>";
		
		$changeMade=false;
		if(isset($_POST['newCourseNumber']) and $_POST['newCourseNumber']!="" and $_POST['newCourseNumber']!='$courseNumber'){
			$newCourseNumber = @$_POST['newCourseNumber'];
			$sql="UPDATE course SET CourseNumber='$newCourseNumber' WHERE CourseID='$selectedCourseID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			$changeMade=true;
		}
		if(isset($_POST['newCourseTitle']) and $_POST['newCourseTitle']!="" and $_POST['newCourseTitle']!='$courseTitle'){
			$newCourseTitle = @$_POST['newCourseTitle'];
			$sql="UPDATE course SET Title='$newCourseTitle' WHERE CourseID='$selectedCourseID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			$changeMade=true;
		}
		if(isset($_POST['newCreditHours']) and $_POST['newCreditHours']!="" and $_POST['newCreditHours']!='$creditHours'){
			$newCreditHours = @$_POST['newCreditHours'];
			$sql="UPDATE course SET CreditHours='$newCreditHours' WHERE CourseID='$selectedCourseID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			$changeMade=true;
		}
		if(isset($_POST['newHyperlink']) and $_POST['newHyperlink']!="" and $_POST['newHyperlink']!='$hyperlink'){
			$newHyperlink = @$_POST['newHyperlink'];
			$sql="UPDATE course SET Hyperlink='$newHyperlink' WHERE CourseID='$selectedCourseID'";
			$results=mysqli_query($link,$sql);
			echo (!$results?die(mysqli_error($link)):"");
			$changeMade=true;
		}
		
		$sql="DELETE FROM courseterm WHERE CourseID='$courseID'";
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		
		$terms=@$_POST['termCheck'];
		$termCount = count($terms);
		for($i=0;$i<$termCount;$i++){
			$season = $terms[$i];
			if($season=="1"){
				$j=1;
			}
			else if($season=="2"){
				$j=2;
			}
			else if($season=="3"){
				$j=3;
			}
			
			for($j;$j<26;$j=$j+3){
				$sqlInsert="INSERT INTO courseterm(CourseID,TermID,CreditHours) VALUES('$courseID','$j','$newCreditHours')";
				$resultsInsert=mysqli_query($link,$sqlInsert);
				echo (!$resultsInsert?die(mysqli_error($link)):"");
			}
		}
		if($changeMade==true){
			echo "<b>The changes you made to $courseNumber: $courseTitle were successfully saved to the database.</b>";
		}
	}
	
		
?>

</form>
</div>

<div align='center' id='addUserDiv' class='<?php echo $addUserDisplay; ?>'>
<form method='POST' name='addUserForm'>
<h2>Add a User to the System</h2>
Enter a uNID (or Username for Admin): <input type='text' name='UID'> &nbsp&nbsp Enter a password: <input type='password' name='pwd'> &nbsp&nbsp
Type of User: <select name='isAdmin'>
					<option value='N'>Student</option>
					<option value='Y'>Administrator</option>
			  </select><br><br>
<input type='submit' value='Add User to System'>

<?php
	if(isset($_POST['UID']) and $_POST['UID']!="" and 
	isset($_POST['pwd']) and $_POST['pwd']!="" and 
	isset($_POST['isAdmin']) and $_POST['isAdmin']!=""){
		
		$UID = $_POST['UID'];
		$pwd = sha1($_POST['pwd']);
		$isAdmin = $_POST['isAdmin'];
		
		$sqlInsert="INSERT INTO user(UID,Password,isAdmin) VALUES('$UID','$pwd','$isAdmin')";
		$resultsInsert=mysqli_query($link,$sqlInsert);
		echo (!$resultsInsert?die(mysqli_error($link)):"");
		echo "<br><br>";
		echo "The user $UID was successfully added to the system.";	
	}
?>

</form>
</div>

</body>
</html>

