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
    #if(isset($_POST['pNamee'])){
    include './dbconnection.php';  ##establish connection
    #$pName = $_POST['pNamee'];
    #$dizi = explode(" ", $pName);
    $query = "select PI.issn, instructor.iname, 100*sum(PI.workinghour) as extraPayment
from project_has_instructor PI JOIN instructor on PI.issn = instructor.ssn 
group BY PI.issn;";                             #address -query
    $result = mysqli_query($conn, $query); #convert query into table
    $num = mysqli_num_rows($result);##return row number of the returned table from the address-query
    mysqli_close($conn);#close mysql connection
    $index = 0; ##counter for loop
    while ($index < $num) {
        $row = mysqli_fetch_assoc($result);#return row
        $issn = $row["issn"];#return given column value
        $iname = $row["iname"];#return given column value
        $payment=$row["extraPayment"];#return given column value
        echo $issn, " ", $iname," ",$payment, "\n", "<br>"; ##print output
        $index++;
    }
  #  }else {
   #         echo "Select the Project to  Display extra payments of instructors working in a project";
    #    }
    ?>
    <h4>
    <P>
            <a href="ProjectView.php">Previous Page</a> !-- Link to previous page-->
    </p>
    </h4>
    
     <?php
    #    include './dbconnection.php';        
     #   $queryr="SELECT pName,leadSsn FROM project";
      #  $resultr=mysqli_query($conn,$queryr);
       # $numr= mysqli_num_rows($resultr);
        #mysqli_close($conn);
       # ?>   
        <!--<form method="post" action=>
            <select name ="pNamee">
                <?php
             #   $indexr=0;
              #  while ($indexr < $numr) {
            # $rowr = mysqli_fetch_assoc($resultr);
            # $pNamee = $rowr["pName"];
            # $leadSsn= $rowr["leadSsn"];
            # echo "<option>", $pNamee, " ",$leadSsn, "\n";
            # $indexr++;
       # }
        ?>
            </select>
            <input type="submit" value="Apply"></input>
        </form>
                <h4>
    <P>
            <a href="ProjectView.php">Previous Page</a>
    </p>
    </h4>
</body>
</html>
-->