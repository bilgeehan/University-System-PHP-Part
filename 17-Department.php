<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php 
        if(isset($_POST['Year']) && isset($_POST['Semester']) && !$_POST['Year']=="" && !$_POST['Semester']==""){ ## check if posted values from below are set or empty
        include './dbconnection.php'; ##establish connection
        $year = $_POST['Year']; #writing posted data from below into instances /variables
        $semester= $_POST['Semester'];#writing posted data from below into instances /variables
        $query="select I.ssn, (sum(course.numHours)-10)*50 as extraCoursePayment, COUNT(DISTINCT gradstudent.ssn)*25 as gradStudentsPayment, sum(PI.workinghour)*100 as projectPayment
                from ((instructor I left outer JOIN (sectionn NATURAL JOIN course )on I.ssn = sectionn.issn)  
                        left outer join gradstudent on I.ssn = gradstudent.supervisorSsn)
                        left outer join project_has_instructor PI on I.ssn = PI.issn
                where (sectionn.yearr = $year and sectionn.semester=$semester ) or (sectionn.yearr is null and sectionn.semester is null)
                        GROUP BY I.ssn;"; #address -query
        $result=mysqli_query($conn,$query);#convert query into table
        $num= mysqli_num_rows($result);##return row number of the returned table from the address-query
        mysqli_close($conn);#close mysql connection
        $index=0;##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result);#return row
        $ssn= $row["ssn"]; ##return given column value
        $gradStudentsPayment= $row["gradStudentsPayment"]; ##return given column value
        $extraCoursePayment =$row["extraCoursePayment"]; ##return given column value
        $projectPayment= $row["projectPayment"]; ##return given column value
        echo $ssn, " ", $extraCoursePayment," ",$gradStudentsPayment, " " ,$projectPayment; ##print outpu
        $index++;
        echo "<br>";
        }    
}
else {
            echo "Enter the data Display overall extra payment of insturctors"; #print if else condition does not activating / when no data is submitted
        }
        ?>
                
                <form method ="post" action =""><!-- post the datas below into itself-->                                                                      
        <input type="text" name="Year" placeholder="Year"></input> <!-- Year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input>  <!-- Semester value input text area-->        
        <input type="submit" value="Apply"></input> <!-- Submit button-->
        
    </form>
                
                
                <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
                
</body>
</html>
