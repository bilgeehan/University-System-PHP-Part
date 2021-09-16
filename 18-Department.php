<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body style="text-align:center;">
    <h4> Welcome <h4>
            <h4>
                
    <?php 
    
        include './dbconnection.php';     ##establish connection    
        $query="select I.dName, AVG(I.baseSal)
        from instructor I
        GROUP BY I.dName";#address -query
        $result=mysqli_query($conn,$query);#convert query into table
        $num= mysqli_num_rows($result); ##return row number of the returned table from the address-query
        mysqli_close($conn); #close mysql connection
        $index=0;#counter for loop
        while ($index < $num) {
        $row = mysqli_fetch_assoc($result); #return row
        $dName= $row["dName"];##return given column value
        $AVG = $row["AVG(I.baseSal)"];##return given column value
        echo $dName," " ,"---> "," ",$AVG, "\n", "<br>";##print output
        $index++;
        }
    
        ?>
                
                
                
                
    <P>
            <a href="DepartmentView.php">Previous Page</a> <!-- Link to previous page-->
    </p>
    </h4>
</body>
</html>


