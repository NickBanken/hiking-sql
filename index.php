<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hiking App</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">

    <style>
	    body{font-family: 'PT Sans', sans-serif; background: #2c3e50;}
	</style>
</head>
<body>


<?php require_once 'process.php';

 ?>

<?php
    if (isset($_SESSION['message'])):
?>

<div class ="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message'])
    ?>

</div>
    <?php endif ?>

<?php
    $sth = $handler->prepare("SELECT * FROM hiking");
    $sth->execute();
?>
    <div class = "container">
        <div class = "row d-flex justify-content-center">
            <table class = "table table-hover table-curved table-md table-bordered table-dark rounded">
                <thead class="rounded">
                    <tr>
                        <th >Name:</th>
                        <th>Difficulty:</th>
                        <th>Distance:</th>
                        <th>Time:</th>
                        <th>Height Difference:</th>
                        <th>Action:</th>
                        <th>Available:</th>
                    </tr>
                </thead>
                <?php
                    while($row = $sth->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr>
                    <td><a class="text-warning"href='update.php?id=<?php echo $row['ID']?>' alt='edit'><?php echo $row['Hike']; ?></a></td>
                    <td><?php echo $row['Difficulty']; ?></td>
                    <td><?php echo $row['Distance']." km"; ?></td>
                    <td><?php echo $row['Duration']."h"; ?></td>
                    <td><?php echo $row['Height_difference']." m"; ?></td>
                    <td><?php echo $row['Available']; ?></td>
                    <td><a href="process.php?delete=<?php echo $row['ID']; ?>"
                    class="btn btn-danger" type="delete">Delete</a></td>
                </tr>

                <?php endwhile; ?>

            </table>
        </div>
        <button onclick="location.href='create.php'" name="Add" class="btn btn-info  col-md-12">Add</button>
    </div>
</body>
</html>