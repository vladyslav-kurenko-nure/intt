<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_base = 'iteh2lb1var7';

    try {
      if (isset($_POST['date1'])) {
      $date1 = $_POST['date1'];
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $data = array( 'date1' => $date1 );
      $query = $db->prepare("SELECT ROUND(SUM(`Cost`),2) FROM `rent` WHERE  `rent`.`Date_end` < :date1");
      $query->execute($data);

      echo '<table border="1"><tr><th>Сумма</th></tr>';
      while($rows = $query->fetch(PDO::FETCH_NUM)) {
            echo "<tr><td>" . $rows[0] . "</td></tr>";
      }
      echo "</table>";
      }

      if (isset($_POST['vendors'])) {
      $vendors = $_POST['vendors'];
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $data = array( 'vendors' => $vendors );
      $query = $db->prepare("SELECT `cars`.`Name` FROM cars INNER JOIN vendors ON `cars`.`FID_Vendors`=`vendors`.`ID_Vendors`
                            WHERE `vendors`.`ID_Vendors` = :vendors");
      $query->execute($data);

      echo '<table border="1"><tr><th>Имя</th></tr>';
      while($rows = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $rows['Name'] . "</td></tr>";
      }
      echo "</table>";
      }

      if (isset($_POST['date3'])) {
      $date3 = $_POST['date3'];
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $data = array( 'date3' => $date3 );
      $query = $db->prepare("SELECT `cars`.`Name` FROM `cars` WHERE `cars`.`ID_Cars`
                            NOT IN (SELECT `cars`.`ID_Cars` FROM `cars` INNER JOIN `rent` ON `cars`.`ID_Cars`=`rent`.`FID_Car`
                            WHERE :date3 BETWEEN `rent`.`Date_start` AND `rent`.`Date_end`)");
      $query->execute($data);

      echo '<table border="1"><tr><th>Имя</th></tr>';
      while($rows = $query->fetch(PDO::FETCH_NUM)) {
            echo "<tr><td>" . $rows[0] . "</td></tr>";
      }
      echo "</table>";
      }

      if (isset($_POST['cars1']) && isset($_POST['date41']) && isset($_POST['date42']) && isset($_POST['time41']) && isset($_POST['time42'])) {
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $cars1 = $_POST['cars1'];
      $date41 = $_POST['date41'];
      $date42 = $_POST['date42'];
      $time41 = $_POST['time41'];
      $time42 = $_POST['time42'];
      $data = array( 'cars1' => $cars1, 'date41' => $date41, 'date42' => $date42, 'time41' => $time41, 'time42' => $time42 );
      $query = $db->prepare("SELECT * FROM `cars` INNER JOIN `rent` ON `cars`.`ID_Cars`=`rent`.`FID_Car`
                            WHERE ((:date41 BETWEEN `rent`.`Date_start` AND `rent`.`Date_end`) OR (:date42 BETWEEN `rent`.`Date_start` AND `rent`.`Date_end`))
                            AND ((:time41 BETWEEN '00:00:01' AND `rent`.`Time_start`) OR (:time42 BETWEEN `rent`.`Time_end` AND '23:59:59'))
                            AND (`cars`.`ID_Cars` = :cars1)");
      $query->execute($data);
      $rcount = $query->rowCount();
      if ($rcount == "0") {
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $cars1 = $_POST['cars1'];
        $data = array( 'cars1' => $cars1 );
        $query = $db->prepare("SELECT `price` FROM `cars` WHERE `cars`.`ID_Cars` = :cars1");
        $query->execute($data);
        $result = $query->fetch(PDO::FETCH_NUM);
      }
      if ($rcount == "0") {
        echo "Машина свободна, запись будет добавлена <br>";
        $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $data = array( 'cars1' => $cars1, 'date41' => $date41, 'date42' => $date42, 'time41' => $time41, 'time42' => $time42, 'cost' => floatval($result[0]) );
        $query = $db->prepare("INSERT INTO `rent`(`FID_Car`, `Date_start`, `Time_start`, `Date_end`, `Time_end`, `Cost`)
                              VALUES (:cars1, :date41, :time41, :date42, :time42, :cost)");
        $query->execute($data);
      }
      else echo "Машина занята <br>";
      }

      if (isset($_POST['race']) && isset($_POST['cars2'])) {
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $race = $_POST['race'];
      $cars2 = $_POST['cars2'];
      $data = array( 'race' => $race, 'cars2' => $cars2 );
      $query = $db->prepare("UPDATE `cars` SET `Race` = :race WHERE `cars`.`ID_Cars` = :cars2");
      $query->execute($data);

      echo "Изменено <br>";
      }
    } catch (PDOException $e) {
      print "Ошибка!: " . $e->getMessage() . "<br>";
    }
    ?>
    <a href=<?php if (!empty($_SERVER["HTTP_REFERER"])) echo $_SERVER["HTTP_REFERER"]; ?>>Назад</a>
  </body>
</html>
