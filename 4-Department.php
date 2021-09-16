<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php 
if(isset($_POST['Year']) && isset($_POST['Semester'])  && isset($_POST['ssn'])&&  ## check if posted values are set or empty
         !$_POST['Year']=="" && !$_POST['Year']=="" && !$_POST['ssn']){
        include './dbconnection.php';        ##establish connection
        $year = $_POST['Year'];            #writing posted data from below into instances /variables
        $semester= $_POST['Semester'];      #writing posted data from below into instances /variables        
        $ssn =$_POST['ssn'];                 #writing posted data from below into instances /variables
        $query="select distinct c.courseCode, c.courseName, c.ects 
                from course c, sectionn s
                where s.issn = '$ssn' and s.yearr=$year and s.semester = $semester and s.courseCode = c.courseCode;";  ##address -query
        $result=mysqli_query($conn,$query); ##convert string into adress
        $num= mysqli_num_rows($result);  ##return row number of the returned table from the address
        mysqli_close($conn);#close mysql connection
        $index=0;##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result);
        $courseCode= $row["courseCode"]; ##return column value
        $courseName= $row["courseName"]; ##return column value
        $ects= $row["ects"]; ##return column value
        echo $courseCode, " " ,$courseName, " " , $ects; ##print the values 
        $index++;
        echo "<br>";
        }    
}
 else {
            echo "Enter the Values To see courses of Instructors";#print if else condition does not activating / when no data is submitted
        }
        ?>
                
                <form method ="post" action ="4-Department.php"> <!-- post the datas below into itself-->
                                    
                <select name="ssn"> <?php
                include './dbconnection.php'; ##establish connection
                $query1="SELECT ssn FROM instructor";               #select the instructor among all instructors by their ssn
        $result1=mysqli_query($conn,$query1);##convert string into adress
        $num1= mysqli_num_rows($result1);##return row number of the returned table from the address
        mysqli_close($conn);#close mysql connection
        $index1=0;##counter for loop
        while ($index1 < $num1) {
        $row1 = mysqli_fetch_assoc($result1);#return row
        $ssn= $row1["ssn"];   ##return column value    
        echo "<option>",$ssn;  ##lists intructor ssns to select
        $index1++;
        }           
                     ?>  </select>      
        <input type="text" name="Year" placeholder="Year"></input>   <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input>  <!-- Semester value input text area-->              
        <input type="submit" value="Apply"></input>  <!-- Submit button-->
        
    </form>
                
                <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
                
</body>
</html>
