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
   if(isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['ssn'])  ## check if posted values from below are set or empty
       && !$_POST['Year']=="" && !$_POST['Semester']=="" && !$_POST['ssn']==""){
                include './dbconnection.php';##establish connection
                $Sssn = $_POST['ssn']; #writing posted data from below into instances
                $query = "SELECT E.courseCode, E.sectionId, W.buildingName, W.roomNumber, W.dayy,W.hourr
                FROM weeklyschedule W NATURAL JOIN enrollment E 
                where E.sssn = '$Sssn' and E.semester = 2 and E.yearr=2020;"; #address -query 
                $result = mysqli_query($conn, $query); #convert query into table
                $num = mysqli_num_rows($result); ##return row number of the returned table from the address-query
                mysqli_close($conn);#close mysql connection
                $index = 0; ##counter for loop
                while ($index < $num) {
                    $row = mysqli_fetch_assoc($result);#return row
                    $courseCode = $row["courseCode"];##return given column value
                    $sectionId = $row["sectionId"]; ##return given column value
                    $buildingName = $row["buildingName"]; ##return given column value
                    $roomNumber = $row["roomNumber"]; ##return given column value
                    $dayy = $row["dayy"]; ##return given column value
                    $hourr = $row["hourr"]; ##return given column value
                    echo $courseCode, " ", $sectionId, " ", $buildingName, " ", $roomNumber, " ", $dayy, "", $hourr, "\n", "<br>"; ##print output
                    $index++;
                }
   }
    else {
            echo "Fill The Blankets";
        }
                ?>
    
    <form method ="post" action =""> <!-- post the datas below into itself-->
        </select>                
                <select name="ssn"> <?php
                include './dbconnection.php'; ##establish connection
                $query1="SELECT ssn FROM Student";   #address -query              
        $result1=mysqli_query($conn,$query1);#convert query into table
        $num1= mysqli_num_rows($result1); ##return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connection
        $index1=0; ##counter for loop
        while ($index1 < $num1) {
        $row1 = mysqli_fetch_assoc($result1); #return row
        $ssn= $row1["ssn"];       ##return given column value
        echo "<option>",$ssn,"<br>"; #print the selections
        $index1++;
        }           
                     ?>  </select>
        <input type="text" name="Year" placeholder="Year"></input> <!-- year value input text area-->
        <input type="text" name="Semester" placeholder="Semester"></input> <!-- Semester value input text area-->
        <input type="submit" value="Apply"></input> <!-- Applye button -->
    </form>
    <h4>
    <P>
            <a href="StudentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>