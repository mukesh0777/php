<?php  
 session_start();  
 if(!isset($_SESSION["username"])){  
    header("location:index.php?action=login");  
 }  

 include 'dbConnect.php';
 $mysqli= $_SESSION['mysqli'];
 if(isset($_GET['id'])){
    $result = $mysqli->query("SELECT * FROM `events` WHERE Id = ".$_GET['id']);
    $row = $result->fetch_array(MYSQLI_ASSOC);
 }else{
    header("location:home.php");  
 }
 if( $row['UserId'] != $_SESSION['userId'] || $_SESSION['authorityLevel'] != 2){
    header("location:home.php");  
 }

 if(isset($_POST["edit"])){  
    if(isset($_POST["title"])){  
        $title = empty($_POST["title"]) ? $row['Title'] : mysqli_real_escape_string($mysqli, $_POST["title"]);  
        if (!$mysqli->query("UPDATE `events` SET `Title` = \"".$title."\" WHERE `Id` = ".$row['Id'])) {
            echo "Error updating title: " . $mysqli->error;
        }
    }
    if(isset($_POST["content"])){
        $content = empty($_POST["content"]) ? $row['Content'] : mysqli_real_escape_string($mysqli, $_POST["content"]);  
        if (!$mysqli->query("UPDATE `events` SET `Content` = \"".$content."\" WHERE `Id` = ".$row['Id'])) {
            echo "Error updating content: " . $mysqli->error;
        }
    }
    if(isset($_POST["startDate"])){
        $startDate = mysqli_real_escape_string($mysqli, $_POST["startDate"]);  
        if (!$mysqli->query("UPDATE `events` SET `StartDate` = \"".date('Y-m-d\ H:i:s',strtotime($startDate))."\" WHERE `Id` = ".$row['Id'])) {
            echo "Error updating startDate: " . $mysqli->error;
        }
    }
    if(isset($_POST["endDate"])){
        $endDate = mysqli_real_escape_string($mysqli, $_POST["endDate"]);  
        if (!$mysqli->query("UPDATE `events` SET `EndDate` = \"".date('Y-m-d\ H:i:s',strtotime($endDate))."\" WHERE `Id` = ".$row['Id'])) {
            echo "Error updating endDate: " . $mysqli->error;
        }
    }
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
 <head>  
    <title>Modification d'évènement</title> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/profilEdit.css" />
    <link rel="stylesheet" href="css/navbar.css" />
 </head>  
 <body>  
    <?php include 'navbar.php'?>

    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-5">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right" style="color:black">Modification d'évènement</h3>
                    </div>
                    <form method="post"> 
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Titre :</label><input type="text" class="form-control" placeholder="<?php echo $row['Title'] ?>" name="title"></div>
                            <div class="col-md-12"><label class="labels">Contenu :</label>
                            <textarea class="form-control" style="min-height:20vh" placeholder="<?php echo $row['Content'] ?>" name="content"></textarea>
                            <div class="mt-3 text-center" style="width:100%"><button class="btn btn-primary profile-button" type="submit" name="edit">Sauvegarder ces infos</button></div>
                        </div>
                    </form>
                    <form method="post"> 
                        <div class="row mt-5 ml-3 text-center justify-content-center">
                            <h5 class="text-right" style="color:black">Modifier la date</h5>
                            <div class="flex-row justify-content-center text-center">
                                <div class="col-md my-3"><label class="labels">Date de début :</label>
                                    <input type="datetime-local" name="startDate" value="<?php echo date('Y-m-d\TH:i',strtotime($row['StartDate'])) ?>"></div>
                                <div class="col-md my-4"><label class="labels">Confirmation :</label>
                                <input type="datetime-local" name="endDate" value="<?php echo date('Y-m-d\TH:i',strtotime($row['EndDate'])) ?>"></div>
                                <div class="mt-3 text-center" style="width:100%"><button class="btn btn-primary profile-button" type="submit" name="edit">Sauvegarder</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>  
</html>  