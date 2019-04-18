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
	    body{font-family: 'PT Sans', sans-serif;}
	</style>
</head>
<body>

<?php require_once 'process.php'; ?>


<?php 
$id = $_GET['id'];

$sth = $handler->prepare("SELECT * FROM hiking WHERE ID = $id");
$sth->execute();

while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
    $hike = $row['Hike'];
    $diff = $row['Difficulty'];
    $dist = $row['Distance'];
    $dura = $row['Duration'];
    $heig = $row['Height_difference']; 
    $avai = $row['Available']; 
}
?>

<?php
    if (isset($_SESSION['error'])):
?>

<div class ="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['error'];
        unset($_SESSION['error'])
    ?>

</div>
<?php endif?>


<div class = "container">
    <div class = "row d-flex justify-content-center"> 
        <form action="" method="POST" class = "d-flex justify-content-center align-items-center">
            <div class="row">
                <input type = "hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group m-3">
                    <label>Name:</label>
                    <input type ="text" name="name" value="<?php echo $hike?>" placeholder="Name" class="form-control">
                </div>
                <div class="form-group m-3">
                    <label>Difficulty:</label>
                    <select class="form-control bg-secondary text-white" name="difficulty">
                        <option value="Very Easy"<?php if($diff === "Very Easy"){echo "selected";}; ?>>Very Easy</option>
                        <option value="Easy"<?php if($diff === "Easy"){echo "selected";}; ?>>Easy</option>
                        <option value="Good"<?php if($diff === "Good"){echo "selected";}; ?>>Good</option>
                        <option value="Difficult"<?php if($diff === "Difficult"){echo "selected";}; ?>> Difficult</option>
                        <option value="Very Difficult"<?php if($diff === "Very Difficult"){echo "selected";}; ?>>Very Difficult</option>
                    </select>
                </div>
                <div class="form-group m-3">
                    <label>Distance:</label>
                    <input type ="int" name="distance" value="<?php echo $dist?>" placeholder = "Distance" class="form-control">
                </div>
                <div class="form-group m-3">
                    <label>Duration:</label>
                    <input type ="int" name="duration" value="<?php echo $dura?>" placeholder = "Duration" class="form-control">
                </div>
                <div class="form-group m-3">
                    <label>Height:</label>
                    <input type ="int" name="height" value="<?php echo $heig?>" placeholder = "Height" class="form-control">
                </div>
                <div class="form-group m-3">
                    <label>Available:</label>
                    <select class="form-control bg-secondary text-white" name="available">
                        <option value="Available"<?php if($avai === "Available"){echo "selected";}; ?>>Available</option>
                        <option value="Not available"<?php if($avai === "Not available"){echo "selected";}; ?>>Not available</option>
                    </select>
                </div>
                <div class = "form-group col-12 d-flex justify-content-center">
                    <input type="submit" name="update" value="update" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>