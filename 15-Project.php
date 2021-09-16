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
    
    if(isset($_POST['pNamee'])){ ## check if posted values from below are set or empty
    include './dbconnection.php'; ##establish connection
    $pName = $_POST['pNamee']; #writing posted data from below into instances /variables
    $dizi = explode(" ", $pName); #writing posted data from below into instances /variables

    $query = "select S.studentname, PS.pName as projectName
from project_has_gradstudent PS join student S on PS.Gradssn = S.ssn
where PS.pName = '$dizi[0]'

UNION

select I.iname , PI.pName as projectName
from project_has_instructor PI JOIN instructor I on PI.issn = I.ssn
where PI.pName = '$dizi[0]';"; #address -query
    $result = mysqli_query($conn, $query); #convert query into table
    $num = mysqli_num_rows($result);##return row number of the returned table from the address-query
    mysqli_close($conn);#close mysql connection
    $index = 0;##counter for loop
    while ($index < $num) {
        $row = mysqli_fetch_assoc($result);#return row
        $studentname = $row["studentname"]; ##return given column value
        $psName = $row["projectName"];
        echo $studentname, " ", $psName, "\n", "<br>"; #print output
        $index++;
    }
    }
    else {
            echo "Select the Project to List all people working in a project P"; #print if else condition does not activating / when no data is submitted
        }
    ?>
    
    <?php
        include './dbconnection.php'; ##establish connection       
        $queryr="SELECT pName,leadSsn FROM project"; #address -query
        $resultr=mysqli_query($conn,$queryr);#convert query into table
        $numr= mysqli_num_rows($resultr);##return row number of the returned table from the address-query
        mysqli_close($conn);#close mysql connection
        ?>   
        <form method="post" action=><!-- post the datas below into itself-->
            <select name ="pNamee">
                <?php
                $indexr=0; ##counter for loop
                while ($indexr < $numr) {
            $rowr = mysqli_fetch_assoc($resultr); #return row
            $pNamee = $rowr["pName"];##return given column value
            $leadSsn= $rowr["leadSsn"]; ##return given column value
            echo "<option>", $pNamee, " ",$leadSsn, "\n"; #print the selections
            $indexr++;
        }
        ?>
            </select>
            <input type="submit" value="Apply"></input> <!-- Submit button-->
        </form>
                <h4>
    <P>
            <a href="ProjectView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>
