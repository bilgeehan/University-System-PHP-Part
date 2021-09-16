
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>          
            <?php    
   if(isset($_POST['Year']) && isset($_POST['Semester'])   ## check if posted values are set or empty
        && !$_POST['Year']=="" && !$_POST['Semester']==""){
           
    include './dbconnection.php';#establish connection
    $year =$_POST['Year']; #writing posted data from below into instances /variables
    $semester =$_POST['Semester']; #writing posted data from below into instances /variables
    $query="select i.iname 
            from instructor i
            where i.ssn not in (select s.issn
				from sectionn s
                                where s.yearr=$year and s.semester =$semester)"; ##address
    $result=mysqli_query($conn,$query);  ##convert string into adress
    $num= mysqli_num_rows($result);##return row number of the returned table from the address
    mysqli_close($conn); #close mysql connection
    $index = 0;  #counter for loop
    while($index < $num){
    $row = mysqli_fetch_assoc($result); #return row
    $instructorName = $row["iname"]; ##return column value from row        
    echo $instructorName,"\n","<br>"; ##print the values
    $index++;
    }   
    }else {
            echo "Enter the data to see the instructors who are not offering any course"; #print if else condition does not activating / when no data is submitted
        }
    ?>
            <form action ="" method ="post"> <!-- post the datas below into itself-->
           <input type="text" name ="Year"placeholder ="Year"></input>      <!-- year value input text area-->
           <input type="text" name="Semester" placeholder="Semester"></input>   <!-- Semester value input text area-->  
           <input type="submit" Value="Apply"></input>   <!-- Apply Button-->
            </form>
       
             <P>
            <a href="DepartmentView.php">Previous Page</a>  <!-- Link to back page-->
               </select>
               
               


</body>
</html>
