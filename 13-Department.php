<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
   
             <?php            
        if(isset($_POST['Year']) && isset($_POST['Semester']) && isset($_POST['Day']) && isset($_POST['Hour'])&& # check if posted values from below are set or empty
           !$_POST['Year']==""  && !$_POST['Semester']=="" && !$_POST['Day']==""  && !$_POST['Hour']==""){
        include './dbconnection.php';   ##establish connection     
        $query="select *
                from buildingandroom B
                where (B.buildingName , B.roomNumber) not in
                       (SELECT W.`buildingName`, W.`roomNumber` 
                        FROM `weeklyschedule` W 
                        WHERE W.`yearr` = $_POST[Year] and W.`semester` = '$_POST[Semester]' and `dayy` = '$_POST[Day]' and W.`hourr` = '$_POST[Hour]')";#address -query
        $result=mysqli_query($conn,$query);#convert query into table
        $num= mysqli_num_rows($result); #return row number of the returned table from the address-query
        mysqli_close($conn);#close mysql connection
                $index=0; ##counter for loop
                while ($index < $num) {
            $row = mysqli_fetch_assoc($result); #return row
            $buildingName = $row["buildingName"]; ##return given column value
            $roomNumber = $row["roomNumber"]; ##return given column value
            $capacity = $row["capacity"]; ##return given column value
            echo $buildingName," ", $roomNumber," ",$capacity,"\n", "<br>"; ##print output
            $index++;
        }
        }{
            echo "Fill The Blankets to Display available classrooms and capacities"; #print if else condition does not activating / when no data is submitted
        }?>
        
         <form action ="" method ="post">  <!-- post the datas below into itself-->               
          <input type="text"  name ="Hour"placeholder ="Hour"></input> <!-- Hour value input text area-->
          <input type="text"  name ="Day"placeholder ="Day"></input>    <!-- Day value input text area-->
          <input type="text"  name="Semester" placeholder="Semester"></input>  <!-- Semester value input text area-->
          <input type="text"  name ="Year"placeholder ="Year"></input>    <!-- year value input text area-->
          <input type="submit" Value="Apply"></input> <!-- Submit button--> 
            </form>
       
            <h4>
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
             
</body>
</html>
