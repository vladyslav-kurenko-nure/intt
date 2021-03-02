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
      $dbh = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
      $sth = $dbh->prepare("SELECT * FROM `cars` INNER JOIN `vendors` ON `cars`.`FID_Vendors`=`vendors`.`ID_Vendors`");
      $sth->execute();
      echo "Машины:";
      echo '<table border="1"><tr><th>Имя</th><th>Год</th><th>Пробег</th><th>Состояние</th><th>Производитель</th><th>Цена</th></tr>';
      while($rows = $sth->fetch(PDO::FETCH_NUM)) {
            echo "<tr>" . "<td>" . $rows[1] . "</td>" . "<td>" . $rows[2] . "</td>" . "<td>" . $rows[3] . "</td>" . "<td>" . $rows[4] . "</td>" . "<td>" . $rows[8] . "</td>" . "<td>" . $rows[6] . "</td>" . "</tr>";
      }
      echo "</table>";
    } catch (PDOException $e) {
      print "Ошибка!: " . $e->getMessage() . "<br>";
    }
    ?>
    <form method="post" action="result.php">
      <br> Выберите дату и время:
      <br> Начало
      <input type="date" name="date41" value="2014-09-10">
      <input type="time" name="time41" step="10" value="10:00:00">
      <br> Конец
      <input type="date" name="date42" value="2014-09-21">
      <input type="time" name="time42" step="10" value="14:00:00">
      <br> Выберите автомобиль:
      <select name="cars1">
      <?php
      try {
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $sth = $dbh->prepare("SELECT `id_cars`, `name` FROM `cars`");
        $sth->execute();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
              echo '<option value="'. $row['id_cars'] .'">'. $row['name'] .'</option>';
        }
      } catch (PDOException $e) {
        print "Ошибка!: " . $e->getMessage() . "<br>";
      }
       ?>
     </select>
      <input type="submit" value="OK">
    </form>
  </body>
</html>
