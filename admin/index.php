<!doctype html>
<html lang="en">

<head>
    <title>BURGER CODE</title>
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
            <h1><strong>Liste des items</strong><a href="insert.php" class="btn btn-success btn-lg"><span
                        class="glyphicon glyphicon-plus"></span>Modifier</a></h1>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Categorie</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                require 'database.php';

                $db= Database::connect();
                $statement= $db->query('SELECT items.id, items.name, items.description, items.price, categorie.name AS categories
                from items  LEFT JOIN categorie ON items.category= categorie.id ORDER BY items.id DESC');
                while($item = $statement->fetch())
                {
                     echo '<tr>';
                       echo  '<td>' .  $item['name'] .'</td>';
                        echo '<td>' . $item['description'] . '</td>';
                        echo '<td>' . number_format((float)$item['price'],2,'.','') . '</td>';
                        echo '<td>' . $item['categories'].'</td>';
                        echo '<td width=300>';
                            echo '<a href="view.php?id=' . $item['id'] . ' " class="btn btn-default"><span
                                    class="glyphicon glyphicon-eye-open">Voir </a>';
                                    echo ' '; 
                          echo  '<a href="update.php?id=' . $item['id'] . ' " class="btn btn-primary"><span
                                    class="glyphicon glyphicon-pencil">Modifier </a>';
                                    echo ' ';
                           echo  '<a href="delete.php?id= ' . $item['id'] . '" class="btn btn-danger"><span
                                    class="glyphicon glyphicon-remove">Supprimer </a>';
                        echo '</td>';
                        echo '</tr>';
                    
                }
                Database::disconnect();

                ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

</body>

</html>