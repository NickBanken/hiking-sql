<?php require_once 'connect.php'; ?>

<?php
session_start();

$hike = "";
$diff = "";
$dist = "";
$dura = "";
$heig = "";
$avai = "";

//When the save button has been pressed.
if (isset($_POST["save"])){

    $hike = $_POST["name"];
    $diff = $_POST["difficulty"];
    $dist = $_POST["distance"];
    $dura = $_POST["duration"];
    $heig = $_POST["height"];
    $avai = $_POST["available"];

    $query = [
    
        'Hike' => $hike,
        'Difficulty' => $diff,
        'Distance' => $dist,
        'Duration' => $dura,
        'Height_difference' => $heig,
        'Available' => $avai
    ];

    $sql = "INSERT INTO hiking(Hike,Difficulty,Distance,Duration,Height_difference,Available) VALUES (:Hike,:Difficulty,:Distance,:Duration,:Height_difference,:Available)";

    $sqlExec = $handler->prepare($sql);

    if (is_numeric($dist) && is_numeric($dura)&&is_numeric($heig)){
        $sqlExec -> execute($query);

        
        $_SESSION['message'] = "Record has been saved!";
        $_SESSION['msg_type'] = "success";
        header("location: index.php");
    }
    else{
        var_dump("hello");
        $_SESSION['error'] = "Make sure you use digits!";
        $_SESSION['msg_type'] = "danger";
    }
    
};


//when the update button gets pressed.
if (isset($_POST["update"])){
    $id = $_POST['id'];
    $hike = $_POST["name"];
    $diff = $_POST["difficulty"];
    $dist = $_POST["distance"];
    $dura = $_POST["duration"];
    $heig = $_POST["height"];
    $avai = $_POST["available"];



    $query = [
        'ID' => $id,
        'Hike' => $hike,
        'Difficulty' => $diff,
        'Distance' => $dist,
        'Duration' => $dura,
        'Height_difference' => $heig,
        'Available' => $avai
        
    ];

    $sql = "UPDATE hiking SET Hike=:Hike,Difficulty=:Difficulty, Distance=:Distance, Duration=:Duration, Height_difference=:Height_difference, Available=:Available WHERE ID = :ID";

    $sqlExec = $handler->prepare($sql);

    if (is_numeric($dist) && is_numeric($dura)&&is_numeric($heig)){
    $sqlExec -> execute($query);

    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("location: index.php");
    }
    else
    {
    $_SESSION['error'] = "Make sure you use digits!";
    $_SESSION['msg_type'] = "danger";
    }
}

//when delete gets pressed
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    

    $query = [
        'ID' => $id
            ];
    
    $sql = "DELETE FROM hiking WHERE ID = :ID";
    $sqlExec = $handler->prepare($sql);
    $sqlExec -> execute($query);

    

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

?>


