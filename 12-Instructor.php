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
    if(isset($_POST['issn'])&&isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['CourseCode'])&& isset($_POST['SectionId']) ## check if posted values from below are set or empty
            &&!$_POST['Year']=="" &&!$_POST['Semester']=="" &&!$_POST['CourseCode']=="" &&!$_POST['SectionId']==""){
        include './dbconnection.php';  ##establish connection
        $year = $_POST['Year']; #writing posted data from below into instances/variables
        $semester= $_POST['Semester']; #writing posted data from below into instances/variables
        $coursecode =$_POST['CourseCode']; #writing posted data from below into instances /variables
        $SectionId =$_POST['SectionId']; #writing posted data from below into instances /variables
        $InstructorSsn = $_POST['issn']; #writing posted data from below into instances /variables
        $query="select T.dayy, T.hourr
                from timeslot T
                where (T.dayy, T.hourr) not in (SELECT W.dayy, W.hourr
                           		from enrollment E NATURAL JOIN weeklyschedule W
                                	where E.yearr=$year and  
								E.semester = $semester and 
								E.sssn in (SELECT E2.sssn
											from enrollment E2
											where E2.sssn = E.sssn and E2.issn='$InstructorSsn' and 
											E2.courseCode='$coursecode' and E2.sectionId = $SectionId 
                                                                                            and E2.yearr=$year and  E2.semester = $semester))"; #address -query
        $result=mysqli_query($conn,$query); #convert query into tabl
        $num= mysqli_num_rows($result); #return row number of the returned table from the address-query
        mysqli_close($conn); #return row number of the returned table from the address-query
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result);#return row
        $day= $row["dayy"]; ##return given column value
        $hour= $row["hourr"];##return given column value
        echo $day," "," ",$hour ,"\n","<br>"; ##print output
        $index++;
        }
    }
    else {
            echo "Enter the data to create free hours report for students registered in selected section"; #print if else condition does not activating / when no data is submitted
        }
        ?>
    
    <form method ="post" action =""> <!-- post the datas below into itself-->
        <select name="issn"> <!-- establish connection -->
            <?php
        include './dbconnection.php';
        $queryy="select ssn
                from instructor"; #address -query   
        $resultt=mysqli_query($conn,$queryy);#convert query into table
        $numm= mysqli_num_rows($resultt); #return row number of the returned table from the address-query
        mysqli_close($conn); #return row number of the returned table from the address-query
        $indexs=0; ##counter for loop
        while ($indexs < $numm) {
        $roww = mysqli_fetch_assoc($resultt); #return row
        $issn= $roww["ssn"];  ##return given column value           
        echo "<option>",$issn," ","\n","<br>"; #print the selections
        $indexs++;
        }
        ?>
        </select>
        <input type="text" name="CourseCode" placeholder="CourseCode"></input> <!-- CourseCode value input text area-->
        <input type="text" name="Year" placeholder="Year"></input> <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input> <!-- Semester value input text area-->
        <input type="text" name="SectionId" placeholder="SectionId"></input>       <!-- SectionId value input text area-->     
        <input type="submit" value="Apply"></input>            <!-- Submit button-->
    </form>
    
    <h4>
    <P>
        <a href="InstructorView.php">Previous Page</a><!-- Link to previous page-->
    </p>
    </h4>
    
    
                
</body>
</html>


