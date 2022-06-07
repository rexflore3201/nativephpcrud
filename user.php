<?php
    session_start();
?>
<?php $db = mysqli_connect("localhost", "root", "", "phpcurd_db"); ?>
<html lang="en">
<head>
    <title>Greg PHP Crud Document</title>
</head>
<body>
    <form method="post">
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter your Name">
        <br><br>
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your Email">
        <br><br>
        <label>Address</label>
        <input type="text" name="address" placeholder="Enter your Address">
        <br><br>
        <input type="submit" name="submit" value="Submit">


    </form>

    <hr>

    <h3>User List</h3>
    <table style="width: 80%" borders="1">
        <tr>
            <th>ID No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Operations</th>
        </tr>
        <?php
            $i = 1;
            $qry = "select * from user";
            $run = $db -> query($qry);
            if($run -> num_rows > 0){
                while($row = $run -> fetch_assoc()){
                    $id = $row['user_id'];
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row['user_name'] ?></td>
            <td><?php echo $row['user_email'] ?></td>
            <td><?php echo $row['user_address'] ?></td>
            <td>
                <a href="edit.php?id=<?php echo $id; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $id; ?>" onclick="return 
                    confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php 
                  }
               }
            ?>
    </table>

</body>
</html>

<?php 


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $qry = "insert into user values(null, '$name', '$email', '$address')";
    if(mysqli_query($db, $qry)){
        echo '<script>alert("User registered successfully.")</script>';
        header('location: user.php');
    }else{
        echo mysqli_error($db);
    }
}

?>
