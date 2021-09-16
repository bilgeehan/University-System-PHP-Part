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
                if(isset($_POST['studentid'])){  ## check if posted values from below are set or empty
                include './dbconnection.php'; ##establish connection
                $StudentId = $_POST['studentid'];#writing posted data from below into instances
                $query = "select c.courseCode, c.courseName, c.ects
                            from course c where c.courseCode in 
                                                                (select cu.courseCode 
                                                                from  curriculacourses CU, student S
                                                                where s.studentid = '$StudentId' and s.currCode = CU.currCode and s.dname =CU.dname )"; #address -query
                $result = mysqli_query($conn, $query); #convert query into table
                $num = mysqli_num_rows($result); ##return row number of the returned table from the address-query
                mysqli_close($conn); #close mysql connection
                $index = 0;##counter for loop
                while ($index < $num) {
                    $row = mysqli_fetch_assoc($result);#return row
                    $courseCode = $row["courseCode"];#return given column value
                    $courseName = $row["courseName"];#return given column value
                    $ects = $row["ects"]; #return given column value
                    echo $courseCode, " ", $courseName, " ", $ects, " ", "\n", "<br>";##print output
                    $index++;
                }
                }else {
            echo "Enter the datafields to Given a student S, list all courses in his/her curriculum in form";
        }
                ?>
                <form method="post" action=""> <!-- post the datas below into itself-->
                    <select name ="studentid"> <!--select name of value to post-->
                        <?php
        include './dbconnection.php';                
        $queryx="select studentid from student;";
        $resultx=mysqli_query($conn,$queryx);#convert string into adress-query
        $numx= mysqli_num_rows($resultx);##return row number of the returned table from the address-query
        mysqli_close($conn);#close mysql connection
        $indexx=0; ##counter for loop
        while ($indexx < $numx) {
        $rowx = mysqli_fetch_assoc($resultx);#return row
        $studentid= $rowx["studentid"];       #return given column value
        echo "<option>",$studentid, "\n", "<br>";##print output
        $indexx++;
        }
        ?>
                    </select>
        <input type="submit" value="Apply"></input>  <!-- Submit button-->           
                </form>
                
                <h4>
                <P>
            <a href="StudentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
                </body>
                </html>

