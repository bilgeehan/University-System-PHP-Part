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
    if(isset($_POST['deptName'])){ ## check if posted values from below are set or empty
    include './dbconnection.php';  #to made connection with database
    $departmentName=$_POST['deptName'];#writing posted data from below into instances /variables 
    $query= "select i.iname
            from instructor i
            where i.dname = '$departmentName'"; #address -query
    $result=mysqli_query($conn,$query); #convert query into table
    $num= mysqli_num_rows($result); ##return row number of the returned table from the address-query
    mysqli_close($conn); #close mysql connection
    $index = 0;  ##counter for loop
    while($index < $num){
    $row = mysqli_fetch_assoc($result);#return row
    $instructorName = $row["iname"]; ##return given column value      
    echo $instructorName,"\n","<br>"; ##print output
    $index++;
    }
    }else{
        echo "Please select a department to see the Instructors of The Department<b>"; #print if else condition does not activating / when no data is submitted
    }
    ?>
    
    <form method="post" action="3-Department.php"> <!-- post the datas below into itself-->
                    <select name ="deptName">  <!--to select department name -->
                        <?php
        include './dbconnection.php'; #to made connection with database               
        $queryx1="select dName from department;"; #address -query
        $resultx1=mysqli_query($conn,$queryx1); #convert query into table
        $numx1= mysqli_num_rows($resultx1); ##return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connection
        $indexx1=0; ##counter for loop
        while ($indexx1 < $numx1) {
        $rowx1 = mysqli_fetch_assoc($resultx1); #return row
        $deptName= $rowx1["dName"];##return given column value 
        echo "<option>",$deptName, "\n", "<br>"; #print the selections
        $indexx1++;
        }
        ?>
                    </select>
        <input type="submit" value="Apply"></input>     <!-- Submit button-->       
                </form>
    
    <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>
