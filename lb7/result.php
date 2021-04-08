<?php
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_base = 'iteh2lb1var7';

    try {
      $db = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);

      if (isset($_GET['date1'])) {
      $date1 = $_GET['date1'];
      $data = array( 'date1' => $date1 );
      $query = $db->prepare("SELECT ROUND(SUM(`Cost`),2) FROM `rent` WHERE  `rent`.`Date_end` < :date1");
      $query->execute($data);

      header('Content-Type: text/xml');
      echo '<?xml version="1.0" encoding="utf8"?>';
      echo '<root>';
      while($rows = $query->fetch(PDO::FETCH_NUM)) {
            echo '<sum>' . $rows[0] . '</sum>';
      }
      echo '</root>';
      }

      if (isset($_GET['vendors'])) {
      header('Content-Type: application/json');
      $vendors = $_GET['vendors'];

      $data = array( 'vendors' => $vendors );
      $query = $db->prepare("SELECT `cars`.`Name` FROM cars INNER JOIN vendors ON `cars`.`FID_Vendors`=`vendors`.`ID_Vendors`
                            WHERE `vendors`.`ID_Vendors` = :vendors");
      $query->execute($data);

      $rows = $query->fetchAll(PDO::FETCH_OBJ);
      echo json_encode($rows);
      }

      if (isset($_GET['date3'])) {
      $date3 = $_GET['date3'];
      $data = array( 'date3' => $date3 );
      $query = $db->prepare("SELECT `cars`.`Name` FROM `cars` WHERE `cars`.`ID_Cars`
                            NOT IN (SELECT `cars`.`ID_Cars` FROM `cars` INNER JOIN `rent` ON `cars`.`ID_Cars`=`rent`.`FID_Car`
                            WHERE :date3 BETWEEN `rent`.`Date_start` AND `rent`.`Date_end`)");
      $query->execute($data);

      echo '<table border="1"><tr><th>Имя</th></tr>';
      while($rows = $query->fetch(PDO::FETCH_NUM)) {
            echo '<tr><td>' . $rows[0] . '</td></tr>';
      }
      echo '</table>';
      }
    } catch (PDOException $e) {
      print "Ошибка!: " . $e->getMessage() . "<br>";
    }
