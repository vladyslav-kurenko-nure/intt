<?php require_once __DIR__ . "/vendor/autoload.php"; ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    try {
      $st="";

      if (isset($_POST['race'])) {
      $race = $_POST['race'];

      $collection = (new MongoDB\Client)->itehlb2v6->cars;
      $cursor = $collection->find(['race' => ['$lte' => intval($race)]], ['projection' => ['name' => 1, 'race' => 1]]);
      echo '<ul>';
      foreach ($cursor as $document)
      {
        echo "<li>" . $document["name"] . " (" . $document["race"] . ")</li>";
        $st = $st . $document["name"] . ' (' . $document["race"] . ') \n';
      }
      echo "</ul>";
      echo '<script> localStorage.setItem("race=' . $race . '", "' . $st . '"); </script>';
    }

    if (isset($_POST['date1'])) {
    $strdate = $_POST['date1'];
    $date = date_parse($strdate);
    echo "<br>";
    $datets = mktime(intval($date["hour"]), intval($date["minute"]), intval($date["second"]), intval($date["month"]), intval($date["day"]), intval($date["year"]));

    $collection = (new MongoDB\Client)->itehlb2v6->rent;
    $cursor = $collection->find(['dtend' => ['$lte' => $datets]], ['projection' => ['cost' => 1]]);
    $sum = 0;
    foreach ($cursor as $document)
    {
      $sum += intval($document["cost"]);
    }
    echo $sum . "<br>";
    echo '<script> localStorage.setItem("date1=' . $strdate . '", "'. $sum . '"); </script>';

  }

    } catch (PDOException $e) {
      print "Ошибка!: " . $e->getMessage() . "<br>";
    }

/*
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $query = new MongoDB\Driver\Query(array());
    $cursor = $manager->executeQuery('test.itehlb2v6_cars', $query);
    print_r($cursor->toArray());
*/
    ?>
    <a href=<?php if (!empty($_SERVER["HTTP_REFERER"])) echo $_SERVER["HTTP_REFERER"]; ?>>Назад</a>
  </body>
</html>
