<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php
    if(isset($_POST['dName'])){ ## check if posted values from below are set or empty
        include './dbconnection.php'; ##establish connection
        $departName = $_POST['dName']; #writing posted data from below into instances /variables
        $query="select P.pName 
        from project P
        where P.controllingDName = '$departName'";#address -query
        $result=mysqli_query($conn,$query); #convert query into table
        $num= mysqli_num_rows($result); ##return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connection
        $index=0; ##counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result); #return row
        $pName= $row["pName"];     ##return given column value
        echo $pName,"\n", "<br>"; ##print output
        $index++;
        }
    }else {
            echo "Select the department to see List the projects controlled by it"; #print if else condition does not activating / when no data is submitted
        }
        ?>
                
        <form method ="post" action ="">  <!-- post the datas below into itself-->                    
        <select name="dName"> <?php
        include './dbconnection.php'; ##establish connection
        $query1="SELECT dName FROM Department"; #address -query              
        $result1=mysqli_query($conn,$query1); #convert query into table
        $num1= mysqli_num_rows($result1); ##return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connection
        $index1=0; ##counter for loop
        while ($index1 < $num1) {
        $row1 = mysqli_fetch_assoc($result1); #return row
        $dName= $row1["dName"];       ##return given column value
        echo "<option>",$dName,"<br>";#print the selections
        $index1++;
        }
        ?>
            <input type="submit" value="Apply"> <!-- Appyle Button -->
                
            </input>
            
            <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>
