<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
               
    <?php      
    if(isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['CourseCode']) ## check if posted values from below are set or empty
            &&!$_POST['Year']=="" && !$_POST['Semester']=="" && !$_POST['CourseCode'] ==""){
        include './dbconnection.php';   ##establish connection
        $year = $_POST['Year']; # writing posted data from below into instances
        $semester= $_POST['Semester']; # writing posted data from below into instances
        $coursecode =$_POST['CourseCode']; # writing posted data from below into instances
        $query="SELECT s.studentname
            FROM enrollment e, student s
            WHERE e.yearr=$year and e.semester =$semester and e.courseCode ='$coursecode' and e.sssn = s.ssn;"; #address
        $result=mysqli_query($conn,$query); ##convert string into adress
        $num= mysqli_num_rows($result); ##return row number of the returned table from the address
        mysqli_close($conn);
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result);#return row
        $studentname= $row["studentname"]; ##return column value
        echo $studentname, "\n", "<br>"; #print output
        $index++;
        }
    }else {
            echo "Enter the datafields to List the students taking course  in a given year and semester."; #print if else condition does not activating
        }
        ?>
    
    <form method ="post" action =""><!-- post the datas below into itself-->
        <input type="text" name="Year" placeholder="Year"></input>  <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input>  <!-- Semester value input text area--> 
        <input type="text" name="CourseCode" placeholder="CourseCode"></input>  <!-- CourseCode value input text area--> 
        <input type="submit" value="Apply"></input>   <!-- Submit button-->
    </form>
    <h4>
    <P>
            <a href="InstructorView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
        </h4>        
</body>
</html>

