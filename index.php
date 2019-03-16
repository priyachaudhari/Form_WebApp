<?php
include "crud.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WebApp-CRUD-Priya</title>

    <!-- Include Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>

<div class="container justify-content-center">
    <table class="table">

    <!-- Table fetching data from database and display on webpage -->
        <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name </th>
                <th scope="col">Email </th>
                <th scope="col">Marks </th>
                <th scope="col">Status </th>
                <th scope="col">Profile Picture </th>
                <th scope="col" colspan="2"> Action </th>
            </tr> 
            <?php 
                $rows = $crud->fetch("data");  //Fetch data into table
                foreach($rows as $row){
                    //breaking point
                    ?>
                <tr>
                    <td><?php echo $row["First_Name"]; ?></td> 
                    <td><?php echo $row["Last_Name"]; ?> </td>
                    <td> <?php echo $row["Email"]; ?> </td>
                    <td><?php echo $row["Marks"]; ?></td>
                    <td> <?php echo $row["Status"]; ?> </td>
                    <td><img src=' <?php echo $row["Profile_Picture"]; ?>' height="50px" width="50px"> </td>
                    <td>
                    <a href="index.php?update=1&id=<?php echo $row["id"] ?>"
                        class = "btn btn-info"> Edit </a>
                    <a href="crud.php?delete=1&id=<?php echo $row["id"] ?>"
                        class = "btn btn-danger"> Delete </a>

                </td>
            </tr>    
                    <?php
                }
            ?>
                       
        </thead>
    </table>
</div>

<?php 

//Checks if table is in updated mode and displays the from with update button

    if(isset($_GET["update"])){
        $id = $_GET["id"] ?? null;
        $where = array("id"=>$id);
        $row = $crud->select("data",$where);
        //breaking point
        ?>

<div class="row justify-content-center" style="white-space:nowrap">
<form action="crud.php" method="post" style="font-size:18px" class="form-group">

    <table>
        <tr><td> <input type="hidden" name="id" value="<?php echo $id; ?>"> 
        </td></tr>
        <tr><td class="from-group row" style="padding-bottom:10px">
            <label>First Name: </label>
            <input type="text" name="first_name" class="form-control" 
                    value="<?php echo $row["First_Name"];  ?>" placeholder="Enter First Name">
        </td></tr>

        <tr><td class="form-group row">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="last_name" class="form-control" 
                    value="<?php echo $row["Last_Name"]; ?>" placeholder= "Enter Last Name">
        </td> </tr>

        <tr><td class="form-group row">
            <label> Email Address: </label>
            <input type="email" class="form-control" name="email" 
                   value="<?php echo $row["Email"]; ?>" placeholder="name@example.com">
        </td></tr>

        <tr><td class="form-group row">
            <label> Marks: </label>
            <input type="text" class="form-control" name="marks" 
                   value="<?php echo $row["Marks"]; ?>" placeholder="Enter Marks">
        </td></tr>

        <tr><td class="form-group row">
            <label> Status: </label>
            <input type="text" class="form-control" name="status" 
                    value="<?php echo $row["Status"]; ?>" placeholder="Enter Status">
        </td></tr>

        <tr><td class="form-group row">
            <label>Profile Picture</label>
            <input type="file" width="50p" height="50px" class="form-control-file" value="<?php echo $row["Profile_Picture"]; ?>" name="profile_picture">
        </td></tr>

        <tr><td class= "form-group row">
            <button type="submit" class="btn btn-info" name= "edit"> Update </button>
        </tr>
    </table>
<?php
    } else{ 
   
// Normal table to insert data into database 

?>
    <div class="row justify-content-center" style="white-space:nowrap">
    <form action="crud.php" method="post" style="font-size:18px" class="form-group">

        <table>
        
        <tr><td class="from-group row" style="padding-bottom:10px">
            <label>First Name: </label>
            <input type="text" name="first_name" class="form-control" 
                placeholder="Enter First Name">
        </td></tr>

        <tr><td class="form-group row">
            <label>Last Name:</label>
            <input type="text" class="form-control" name="last_name" class="form-control" 
                placeholder= "Enter Last Name">
        </td> </tr>

        <tr><td class="form-group row">
            <label> Email Address: </label>
            <input type="email" class="form-control" name="email" 
                placeholder="name@example.com">
        </td></tr>

        <tr><td class="form-group row">
            <label> Marks: </label>
            <input type="text" class="form-control" name="marks" 
                placeholder="Enter Marks">
        </td></tr>

        <tr><td class="form-group row">
            <label> Status: </label>
            <input type="text" class="form-control" name="status" 
                    placeholder="Enter Status">
        </td></tr>

        <tr><td class="form-group row">
            <label>Profile Picture</label>
            <input type="file" width="50px" height="50px"class="form-control-file" name="profile_picture">
        </td></tr>  

        <tr><td class= "form-group row">
            <button type="submit" class="btn btn-primary" name="save"> Save </button>
        </tr>
    </table>      
<?php
    }
?>
</div>
</form>
</body>
</html>