<?php
require 'database.php';
if(!empty($_GET['id'])){
    $id = checkInput($_GET['id']);
}

if(!empty($_POST)){
    $id = checkInput($_POST['id']);
    $db = Database::connect();
    $statement = $db->prepare("DELETE FROM items where id = ?");
    $statement->execute(array($id));
    Database::disconnect();
    header("Location:  index.php");
}
function checkInput($data){
    $data = trim($data);
    $data= stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>

<!doctype html>
<html lang="en">

<head>
    <title>Voir</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" type="image/png" href="../images/hamburger.png" />
    <!-- Bootstrap CSS -->

</head>

<body>
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Burger Code <span
            class="glyphicon glyphicon-cutlery"></span></h1>

    <div class="container admin">
        <div class="row">
            <h1><strong>Supprimer un item</strong></h1>
            <br>
            <form action="delete.php" method="post" class="form" role="form">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p class="alert alert-warning">Etes-vous sur de vouloir supprimer ?</p>

                <div class="form-actions">
                <button type="submit" class="btn btn-warning">Oui</button>
                <a href="index.php" class="btn btn-default"> Non </a>
            </div>


            </form>




        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>