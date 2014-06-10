<html>
<head>

<script type='text/javascript'>
	function getDescription(hyperlink){
		window.open(hyperlink, "Course Description", "location=1,status=1,scrollbars=1,resizable=no,width=1200,height=800,menubar=no,toolbar=no");
	}	
</script>
</head>
<body>

<?php //DEFINE FUNCTIONS BELOW
	ob_start();
	function printCoursesToTable($uNID,$startSemester,$finishSemester){
		include('connect.php');

		$sql="SELECT c.CourseID, c.CourseNumber, c.Title, c.Description, c.Note, c.ClassificationID, c.Hyperlink, c.SortOrder, t.TermID, IFNULL(IFNULL(uc.CreditHours,ct.CreditHours),c.CreditHours) AS CreditHours, IFNULL(uc.TermID,ct.TermID) AS CheckboxIndicator, cl.BGColor, ca.CategoryName, ca.HeaderBGColor, ca.SortOrder, cl.SortOrder, CASE WHEN uc.CreditHours > 0 THEN 'bgcolor=\'#FF6F00\'><input type=\'checkbox\' checked' ELSE '><input type=\'checkbox\'' END AS IsChecked
		FROM Course c
		JOIN Classification cl
			ON cl.ClassificationID = c.ClassificationID
		JOIN Category ca
			ON ca.CategoryID = cl.CategoryID
		CROSS JOIN Term t
			ON t.TermID >= $startSemester
			AND t.TermID <= $finishSemester
		JOIN User u
			ON u.UID = '$uNID'
		LEFT OUTER JOIN UserCourse uc
			ON uc.UserID = u.UserID
			AND uc.CourseID = c.CourseID
			AND uc.TermID = t.TermID
		LEFT OUTER JOIN CourseTerm ct
			ON ct.CourseID = c.CourseID
			AND ct.TermID = t.TermID
		WHERE c.CourseID IN (SELECT cti.CourseID
							 FROM CourseTerm cti
							 WHERE cti.TermID >= $startSemester
								AND cti.TermID <= $finishSemester
							 UNION DISTINCT
							 SELECT uci.CourseID
							 FROM UserCourse uci
							 WHERE uci.TermID >= $startSemester
								AND uci.TermID <= $finishSemester
								AND uci.UserID = 1)
		ORDER BY ca.SortOrder, cl.SortOrder, c.SortOrder, c.CourseID, t.TermID";//including c.CourseID is just in case c.SortOrder data are not structured correctly
		$results=mysqli_query($link,$sql);
		echo (!$results?die(mysqli_error($link)):"");
		$lastCourseNumber="";
		$alternator=0; //Used to set every other row background color to gray.
		while(list($courseID,$courseNumber,$title,$description,$note,$classID,$hyperlink,,$termID,$hours,$checkboxIndicator,$color,$catName,$catColor,,,$isChecked)=mysqli_fetch_array($results)){
			${$classID.'header'} = isset(${$classID.'header'})?${$classID.'header'}:0;
			if($alternator % 2 == 0){
				if($lastCourseNumber==$courseNumber){
					if($checkboxIndicator > 0){	// $checkboxIndicator > 0 only when there is a course selection in this cell
						echo "<td align='center' $isChecked name='courses[$termID][]' value='$courseID'> </td>";
					}
					else{
						echo "<td></td>";
					}
				}
				else{
					if(${$classID.'header'}==0 AND $classID<4){	// maybe test for $catColor to be non-null instead of checking the $classID value
						echo "<tr bgcolor='$catColor'><th>$catName</th>";
						$termRowsPrinted=printSelectedSemesters($startSemester, $finishSemester);
						echo "</tr>";
						${$classID.'header'}++;
					}
					echo "<tr><td bgcolor='$color'><input type='button' id=$courseID onclick=\"getDescription('$hyperlink')\" name='buttonName' value='$courseNumber'> $title ($hours".(strlen($note)>0?", ":"").$note.")</td>";
					if($checkboxIndicator > 0){	// $checkboxIndicator > 0 only when there is a course selection in this cell
						echo "<td align='center' $isChecked name='courses[$termID][]' value='$courseID'> </td>";
					}
					else{
						echo "<td></td>";
					}
				}
			}
			else{
				if($lastCourseNumber==$courseNumber){
					if($checkboxIndicator > 0){	// $checkboxIndicator > 0 only when there is a course selection in this cell
						echo "<td align='center' $isChecked name='courses[$termID][]' value='$courseID'> </td>";
					}
					else{
						echo "<td></td>";
					}
				}
				else{
					if(${$classID.'header'}==0 AND $classID<4){	// maybe test for $catColor to be non-null instead of checking the $classID value
						echo "<tr bgcolor='$catColor'><th>$catName</th>";
						$termRowsPrinted=printSelectedSemesters($startSemester, $finishSemester);
						echo "</tr>";
						${$classID.'header'}++;
					}
					echo "<tr bgcolor='#F0EDED'><td bgcolor='$color'><input type='button' id='$courseID' onclick=\"getDescription('$hyperlink')\" name='buttonName' value='$courseNumber'> $title ($hours)</td>";
					if($checkboxIndicator > 0){	// $checkboxIndicator > 0 only when there is a course selection in this cell
						echo "<td align='center' $isChecked name='courses[$termID][]' value='$courseID'> </td>";
					}
					else{
						echo "<td></td>";
					}
				}
			}
			$alternator++;
			$lastCourseNumber=$courseNumber;
		}
	}
	
	function printSelectedSemesters($startSemester, $finishSemester){
	//Get the semesters the user wants to display. 
		include('connect.php');
		$sql="SELECT Year, Season FROM term WHERE TermID >= '$startSemester' AND TermID <= '$finishSemester'";
		 $results=mysqli_query($link,$sql);
		 $columnCounter=0;
		 echo (!$results?die(mysqli_error($link)):"");
		 while(list($year,$season)=mysqli_fetch_array($results)){
			echo "<th width='95px'>$season $year</th>";
			$columnCounter++;
		 }
		 return $columnCounter;
	}
?>
</body>
</html>
