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
                if( isset($_POST['ssn'])&& !$_POST['ssn']==""){ # check if posted values from below are set or empty
                include './dbconnection.php'; ##establish connection
                $Sssn = $_POST['ssn']; #writing posted data from below into instances
                $query = "select E.courseCode, E.yearr, E.semester, E.grade
                         from enrollment E
                         where E.sssn = '$Sssn';"; #address -query
                $result = mysqli_query($conn, $query); #convert query into table
                $num = mysqli_num_rows($result); ##return row number of the returned table from the address-query
                mysqli_close($conn); #close mysql connection
                $index = 0; ##counter for loop
                while ($index < $num) {
                    $row = mysqli_fetch_assoc($result); #return row
                    $courseCode = $row["courseCode"]; ##return given column value
                    $yearr = $row["yearr"]; ##return given column value
                    $semester = $row["semester"]; ##return given column value
                    $grade = $row["grade"]; ##return given column value
                    echo $courseCode, " ", $yearr, " ", $semester, " ", $grade, "\n", "<br>"; ##print output
                    $index++;
                }
   }
    else {
            echo "Enter your ssn to see Grade Report"; #print if else condition does not activating / when no data is submitted
        }
                ?>
                
                <form method ="post" action =""> <!-- post the datas below into itself-->
                    <input type="text" name="ssn" placeholder="StudentSsn"></input>      <!-- year value input text area-->             
                    <input type="submit" value="Apply"></input> <!-- Apply/submit Button-->
    </form>
                
                <h4>
    <P>
        <a href="StudentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
                </body>
                </html>
