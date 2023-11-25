<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <div>
            <form action="" method="POST">
                <input type="text" name="firstname" placeholder="firstname"> <br><br>
                <input type="text" name="lastname" placeholder="lastname"> <br><br>
                <input type="number" name="age" placeholder="age"> <br><br>
                <input type="submit" name="save_btn" value="save"> <br><br>
            </form>
        </div>
        <?php
        if (isset($_POST['save_btn'])) {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $age = $_POST['age'];
            $query = "INSERT INTO student    (firstname,lastname,age) VALUES ('$fname','$lname','$age')";
            $data = mysqli_query($con, $query);
            if ($data) {
                ?>
                <script type="text/javascript">
                    alert("Data Saved Successfully");
                </script>
                <?php
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("Please try again");
                </script>
                <?php
            }
        }
        ?>
    </body>
</html>






<?php include 'connection.php'; ?>
<a href="index.php">Home</a>
<table border="1px" cellpadding="10px" cellspacing="10px">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>age</th>
        <th colspan="2">Actions</th>
    </tr>
    <?php
    $query="SELECT * FROM student";
    $data=mysqli_query($con,$query);
    $result=mysqli_num_rows($data);
    if ($result) {
        while ($row = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><a href="update.php?id=<?php echo $row['id']; ?>">Edit</a> </td>
                <td><a onclick="return confirm('Are you sure, you want to  delete?')"a href="delete.php?id=<?php echo $row['id']; ?>">Delete</td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="5">No Records Found</td>
        </tr>
        <?php
    }

    // Close the database connection
    mysqli_close($con);
    ?>
                </table>




<?php include 'connection.php'; 
$id=$_GET['id'];
$select="SELECT * FROM student WHERE id='$id'";
$data=mysqli_query($con,$select);
$row=mysqli_fetch_array($data);
?>
 <div>
            <form action="" method="POST">
                <input value="<?php echo $row['firstname'] ?>" type="text" name="firstname" placeholder="firstname"> <br><br>
                <input type="text" name="lastname" placeholder="lastname" value=<?php echo $row['lastname'] ?>> <br><br>
                <input type="number" name="age" placeholder="age" value=<?php echo $row['age'] ?>> <br><br>
                <input type="submit" name="update_btn" value="Update"> <br><br>
                <button><a href="view.php">Back</a></button>
            </form>
        </div>
        <?php
        if (isset($_POST['update_btn'])) {
            $fname = $_POST['firstname'];
            $lname = $_POST['lastname'];
            $age = $_POST['age'];
            $update = "UPDATE student SET firstname='$fname',lastname='$lname',age='$age' WHERE id ='$id'";    
            $data = mysqli_query($con, $update);
            if ($data) {
                ?>
                <script type="text/javascript">
                    alert("Data Updated Successfully");
                </script>
                <?php   
            }
            else {
                ?>
                <script type="text/javascript">
                    alert("Please try again");
                    window.open("http://localhost:8080/demo/view.php","_self");
                </script>
                <?php
            }
        }
        ?>






<?php include 'connection.php'; 
$id=$_GET['id'];
$query="DELETE FROM student WHERE id='$id'";
$data=mysqli_query($con,$query);
if ($data)
{
    ?>
    <script type="text/javascript">
        alert("data deleted successfully");
        window.open("http://localhost:8080/demo/view.php","_self");
        </Script>
        <?php
}
else
{
    ?>
    <script type="text/javascript">
        alert("Please try again");
</script>
<?php
}
