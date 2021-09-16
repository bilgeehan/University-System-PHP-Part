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
    <h4> Welcome <h4>
            <h4>
                
    <?php    
    if(isset($_POST['deptName'])){  # check if user selected any value 
        include './dbconnection.php'; ##establish connection
        $departmentName = $_POST['deptName']; # take posted value from the form below
        $query="select s.studentid, s.studentname, i.iname
                from Student s, instructor i
                where s.dname = '$departmentName' and i.ssn = s.advisorSsn";
        $result=mysqli_query($conn,$query);   # transform querry address into table
        $num= mysqli_num_rows($result);   #return row number of returned table
        mysqli_close($conn);  #close mysql connection
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result);          #return rows
        $iName= $row["iname"];   #return column value
        if(empty($iName) || $iName ==null || !isset($iName) || $iName==""){
            echo "No student Registered into $departmentName";
            break;
        }
        $studentid = $row["studentid"]; ##return given column value
        $studentname = $row["studentname"]; ##return given column value
        echo $studentid," ",$studentname," ",$iName, "\n", "<br>";  #output as studentid , studentname, instructorname
        $index++;
        }    
    }
        else {
            echo "Please a department to see the Students of the Department"; #print if else condition does not activating / when no data is submitted
        }
            
        ?> 
                <form method="post" action="1-Department.php">  <!-- post values to itself -->
                    <select name ="deptName"> <!-- post department name to istself -->
                        <?php
        include './dbconnection.php';        ##establish connection        
        $queryx="select dName from department;";  #select department names to show
        $resultx=mysqli_query($conn,$queryx); # transform querry address into table
        $numx= mysqli_num_rows($resultx); #return row number of returned table
        mysqli_close($conn);#close mysql connection
        $indexx=0;##counter for loop
        while ($indexx < $numx) {
        $rowx = mysqli_fetch_assoc($resultx); #return rows
        $deptName= $rowx["dName"];  #return column value     
        echo "<option>",$deptName, "\n", "<br>"; # choose department name
        $indexx++;
        }
        ?>
                    </select>
        <input type="submit" value="Apply"></input>              <!-- submit button-->
                </form>
                
                <P>
            <a href="DepartmentView.php">Previous Page</a>  <!-- Back to previous page link-->
               </select>
</body>
</html>
