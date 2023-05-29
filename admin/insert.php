<?php
require 'database.php';

$nameError = $descriptionError = $priceError = $imageError = $image = $name = $description = $image = $price = $catError = $category =  "";

if(!empty($_POST)){
    $name = checkInput($_POST['name']);
    $description = checkInput($_POST['description']);
    $price = checkInput($_POST['price']);
    $category = checkInput($_POST['category']);
    $image = checkInput($_FILES['image']['name']);
    $imagePath  = '../images/' . basename($image);
    $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
    $isSuccess = true;
    $isUploadSuccess = false;


    if(empty($name)){
        $nameError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if(empty($description)){
        $descriptionError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if(empty($price)){
        $priceError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if(empty($category)){
        $catError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    if(empty($image)){
        $imageError = "Ce champ ne peut pas etre vide";
        $isSuccess = false;
    }
    else{
       $isUploadSuccess = true;
       if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension !="jpeg"){
        $imageError ="Les fichiers nes sont pas autorisées";
         $isUploadSuccess = false;
       }
       if(file_exists($imagePath)){
        $imageError = "Le fichier existe déjà";
         $isUploadSuccess = false;
       }
       if($_FILES["image"]["size"] > 500000){
        $imageError =" Le fichier ne doit pas depasser 500KB";
         $isUploadSuccess = false;
       }
    }


    if($isSuccess && $isUploadSuccess){
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO items (name,description,price,category,image) values (?,?,?,?,?)");
        $statement -> execute(array($name,$description,$price,$category,$image));
        Database::disconnect();
        header("Location : index.php");
    }



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

            <h1><strong>Ajouter un item</strong></h1>
            <br>
            <form class="form" role="form" action="insert.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name"> Nom : </label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom"
                        value="<?php echo $name ; ?>">
                    <span class="help-inline">
                        <?php echo $nameError; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="description"> Description : </label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description"
                        value="<?php echo $description ; ?>">
                    <span class="help-inline">
                        <?php echo $descriptionError; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="price"> Prix : </label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix"
                        value="<?php echo $price ; ?>">
                    <span class="help-inline">
                        <?php echo $priceError; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="category"> Categorie : </label>
                    <select name="category" id="category" class="form-control">
                        <?php  
                        $db= Database::connect();
                        foreach($db->query('SELECT * FROM categorie') as $row){
                            echo '<option value="' .$row['id']. '">' . $row['name']  . '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <span class="help-inline">
                        <?php echo $catError; ?>
                    </span>
                </div>
                <div class="form-group">
                    <label for="image"> Image : </label>
                    <input type="file"  class="form-control" id="image" name="image"
                        value="<?php echo $image ; ?>">
                    <span class="help-inline">
                        <?php echo $imageError; ?>
                </div>
                  <div class="form-actions">
                <button type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-pencil"></span>Ajouter</button>
                <a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span>
                    Retour</a>
            </div>
            </form>
          

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>