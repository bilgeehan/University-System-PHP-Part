<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php    
    if(isset($_POST['deptName'])){ # check if user selected any value 
        include './dbconnection.php';##establish connection
        $departmentName=$_POST['deptName'];        # take posted value from the form below
        $query="select s.studentid, s.studentname, i.iname
                from Student s, instructor i
                where s.dname = '$departmentName' and i.ssn = s.advisorSsn";
        $result=mysqli_query($conn,$query); # transform querry address into table
        $num= mysqli_num_rows($result); #return row number of returned tabl
        mysqli_close($conn); #close mysql
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result); #return rows
        $iName= $row["iname"]; #return column value
        $studentid = $row["studentid"]; #return column value
        $studentname = $row["studentname"]; #return column value
        echo $studentid," ",$studentname," ",$iName, "\n", "<br>";   #output as studentid , studentname, instructorname
        $index++;
        }  
    }
    else{
        echo "Please select a department to see the Students and their Advisors <b>";
    }
        ?>
                
                <form method="post" action="2-Department.php"> <!-- post values to itself -->
                    <select name ="deptName"> <!-- post department name to istself -->
                        <?php
        include './dbconnection.php';##establish connection                 
        $queryx1="select dName from department;"; #select all department names to show from mysql connection
        $resultx1=mysqli_query($conn,$queryx1); # transform querry address into table
        $numx1= mysqli_num_rows($resultx1);  #return row number of returned tabl
        mysqli_close($conn);  #close mysql
        $indexx1=0;  ##counter for loop
        while ($indexx1 < $numx1) {
        $rowx1 = mysqli_fetch_assoc($resultx1); #return rows
        $deptName= $rowx1["dName"]; #return column value      
        echo "<option>",$deptName, "\n", "<br>"; # choose department name
        $indexx1++;
        }
        ?>
                    </select>
        <input type="submit" value="Apply"></input>             <!-- submit button-->
                </form>
                
                <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Back to previous page link-->
    </p>
    </h4>
                
</body>
</html>