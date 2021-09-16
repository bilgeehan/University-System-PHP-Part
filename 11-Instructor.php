<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
               
    <?php  
     include './dbconnection.php';
    if(isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['CourseCode']) && !$_POST['Year']=="" && !$_POST['Semester']=="" && !$_POST['CourseCode']==""){## check if posted values from below are set or empty
        include './dbconnection.php'; ##establish connection
        $year = $_POST['Year']; #writing posted data from below into instances
        $semester= $_POST['Semester']; #writing posted data from below into instances
        $coursecode =$_POST['CourseCode']; #writing posted data from below into instances
        $query="select E.courseCode, E.sectionId,E.sssn, E.grade
                from enrollment E
                where E.courseCode = '$coursecode' and E.yearr =$year and E.semester = $semester"; #address -query
        $result=mysqli_query($conn,$query);#convert query into table
        $num= mysqli_num_rows($result); #return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connectio
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result); #return row
        $courseCode= $row["courseCode"]; ##return given column value
        $csectionId= $row["sectionId"]; ##return given column value
        $sssn= $row["sssn"]; ##return given column value
        $grade= $row["grade"]; ##return given column value
        echo $courseCode," ",$csectionId," ",$sssn," ",$grade,"\n", "<br>"; ##print output
        $index++;
        }
    }
        ?>
    
    <form method ="post" action =""> <!-- post the datas below into itself-->
        <input type="text" name="CourseCode" placeholder="CourseCode"></input> <!-- CourseCode value input text area-->
        <input type="text" name="Year" placeholder="Year"></input>  <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input>      <!-- Semestervalue input text area-->  
        <input type="submit" value="Apply"></input> <!-- Submit button-->
    </form>
    
    <h4>
    <P>
        <a href="InstructorView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </p>
    </h4>
    
    
                
</body>
</html>
