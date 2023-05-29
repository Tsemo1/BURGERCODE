<!doctype html>
<html lang="en">

<head>
  <title> Burger Code </title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/index.css">
  <link rel="icon" type="image/png" href="images/hamburger.png" />
</head>

<body>
  <div class="container site">


    <?php
    require 'admin/database.php';
    echo ' <nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">BurgerCode</a>
    </div>
      <ul class="nav navbar-nav navbar-right">';

    $db = Database::connect();
    $statement = $db->query('SELECT * FROM categorie');
    $category = $statement->fetchAll();
    foreach ($category as $cat) {
      if ($cat['id'] == '1')
        echo '<li  class="active"><a href="#' . $cat['id'] . '"data-toggle="tab">' . $cat['name'] . '</a></li>';
      else
        echo '<li><a href="#' . $cat['id'] . '"data-toggle="tab">' . $cat['name'] . '</a></li>';
    }
    echo ' </ul> </div>
    </nav>';

    echo '<div class="tab-content">';
    foreach ($category as $cat) {
      if ($cat['id'] == '1')
        echo '<div class="tab-pane active" id="' . $cat['id'] . '">';
      else
        echo '<div class="tab-pane" id="' . $cat['id'] . '">';

      echo '<div class="row">';
      $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
      $statement->execute(array($cat['id']));

      while ($item = $statement->fetch()) {

        echo '<div class="col-sm-6 col-md-4">
        <div class="thumbnail"> <img src="images/' . $item['image'] . '" alt=".">
          <div class="price">' . number_format((float) $item['price'], 2, '.', '') . ' €</div>
          <div class="caption">
            <h4>' . $item['name'] . '</h4>
            <p>' . $item['description'] . '</p>
            <a href="view.php?id=' . $item['id'] . '" class="btn btn-order" role="button"> <span
                class="glyphicon glyphicon-shopping-cart"></span>Commander</a>
          </div>

        </div>
      </div>';
      }

      echo '</div>
</div>';
    }
    Database::disconnect();
    echo '</div>';
    ?>

  </div>

</body>

</html>