<?php require_once __DIR__ . "/vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Марки автомобилей: <br>
    <?php
    $collection = (new MongoDB\Client)->itehlb2v6->cars;
    $cursor = $collection->find([], ['projection' => ['name'=> 1]]);
    echo '<ul>';
    foreach ($cursor as $document)
    {
      echo "<li>" . $document["name"] . "</li>";
    }
    echo "</ul>";
    ?>
  </body>
</html>
