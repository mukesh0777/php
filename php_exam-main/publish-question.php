<?php  
 session_start();  
 if(!isset($_SESSION["username"])){  
    header("location:index.php?action=login");  
 }  

 include 'dbConnect.php';
 $mysqli = $_SESSION['mysqli'];
 
 if(isset($_POST["edit"])){  
    if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["startDate"]) && isset($_POST["endDate"])){  
        $title = mysqli_real_escape_string($mysqli, $_POST["title"]);  
        $content = empty($_POST["content"]) ? $row['Content'] : mysqli_real_escape_string($mysqli, $_POST["content"]);  
        $startDate = mysqli_real_escape_string($mysqli, $_POST["startDate"]);  
        $endDate = mysqli_real_escape_string($mysqli, $_POST["endDate"]);  
        $localisation = mysqli_real_escape_string($mysqli, $_POST["localisation"]);  

        if (!$mysqli->query("INSERT INTO `events`(`Title`, `Content`, `StartDate`, `EndDate`, `Localisation`, `PostDate`,`UserId`)".
        "VALUES ('".$title."','".$content."','".date('Y-m-d\ H:i:s',strtotime($startDate))."','".date('Y-m-d\ H:i:s',strtotime($endDate))."','".$localisation."','".date("Y-m-d")."','".$_SESSION['userId']."')" )) {
            echo "Error updating: " . $mysqli->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Publies ta soirée ! </title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/publish-question.css" />
<link rel="stylesheet" href="css/navbar.css" />
</head>

<body>
    <?php include 'navbar.php'?>
    <div class="signup-form">
        <div class="p-3 py-5">
            <div class="d-flex justify-content-between align-items-center mb-3 text-center">
                <h3 class="text-right" style="color:black">Création d'évènement</h3>
            </div>
            <form method="post"> 
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Titre :</label><input type="text" class="form-control" placeholder="..." name="title"></div>
                    <div class="col-md-12"><label class="labels">Lieu :</label><input type="text" class="form-control" placeholder="..." name="localisation"></div>

                    <div class="col-md-12"><label class="labels">Description :</label>
                    <textarea class="form-control" style="min-height:20vh" placeholder="..." name="content"></textarea>

                    <div class="flex-row justify-content-center text-center">
                        <div class="col-md my-3"><label class="labels">Date de début :</label>
                            <input type="datetime-local" name="startDate"></div>
                        <div class="col-md my-4"><label class="labels">Confirmation :</label>
                        <input type="datetime-local" name="endDate" ></div>
                        <div class="mt-3 text-center" style="width:100%"><button class="btn btn-primary profile-button" type="submit" name="edit">Sauvegarder</button></div>
                </div>
            </form>
    
        </div>
    </div>
</body>
</html>
