<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php 
if(isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['courseCode']) && isset($_POST['SectionId']) && isset($_POST['iname']) ## check if posted values from below are set or empty
        &&!$_POST['Year']=="" &&$_POST['Semester']!=="" && !$_POST['SectionId']=="" ){
        include './dbconnection.php'; ##establish connection
        $year = $_POST['Year'];  #writing posted data from below into instances /variables
        $semester= $_POST['Semester'];  #writing posted data from below into instances /variables
        $coursecode =$_POST['courseCode']; #writing posted data from below into instances /variables
        $SectionId =$_POST['SectionId']; #writing posted data from below into instances /variables
        $InstructorName =$_POST['iname']; #writing posted data from below into instances /variables
        $query="select s.studentname
                from enrollment e, student s, instructor i
                where e.yearr=$year and e.semester = $semester and e.courseCode = '$coursecode' and e.sssn = s.ssn and 
	i.iname ='$InstructorName' and i.ssn= e.issn and e.sectionId =$SectionId"; #address -query
        $result=mysqli_query($conn,$query); #convert query into table
        $num= mysqli_num_rows($result); ##return row number of the returned table from the address-query
        mysqli_close($conn);#close mysql connection
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result); #return row
        $studentname= $row["studentname"]; ##return given column value from row
        echo $studentname, "<br>"; ##print output
        $index++;
        }    
}
else {
            echo "Enter the data to List the students taking a particular section"; #print if else condition does not activating / when no data is submitted
        }
        ?>
                
                <form method ="post" action =""> <!-- post the datas below into itself-->
                <select name="courseCode"> <?php
                include './dbconnection.php'; #establish connection
                     $query2="SELECT courseCode FROM course";   #address -query            
        $result2=mysqli_query($conn,$query2); ##convert string into adress
        $num2= mysqli_num_rows($result2); ##return row number of the returned table from the address
        mysqli_close($conn);#close mysql connection
        $index2=0; ##counter for loop
        while ($index2 < $num2) {
        $row2 = mysqli_fetch_assoc($result2); #return row
        $courseCode= $row2["courseCode"];        ##return column value
        echo "<option>",$courseCode; #print the selections
        $index2++;
        }         
                   ?> </select>                
                <select name="iname">  <!--select name of value to post-->
                    <?php 
                include './dbconnection.php';
                $query1="SELECT iname FROM instructor";      #address   -query      
        $result1=mysqli_query($conn,$query1); ##convert string into adress
        $num1= mysqli_num_rows($result1); ##return row number of the returned table from the address
        mysqli_close($conn); #close mysql connection
        $index1=0; ##counter for loop
        while ($index1 < $num1) {
        $row1 = mysqli_fetch_assoc($result1); #return row
        $iname= $row1["iname"];       ##return column value
        echo "<option>",$iname; #print the selections
        $index1++;
        }           
                     ?>  </select>      
        <input type="text" name="Year" placeholder="Year"></input>  <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input>  <!-- Semester value input text area--> 
        <input type="text" name="SectionId" placeholder="SectionId"></input>  <!-- SectionId value input text area--> 
        <input type="submit" value="Apply"></input> <!-- Submit button-->
        
    </form>
                <h4>
                <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>

