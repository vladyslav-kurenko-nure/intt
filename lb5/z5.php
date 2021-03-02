<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post" action="result.php">
      Выберите машину:
      <select name="cars2">
      <?php
      $db_host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_base = 'iteh2lb1var7';

      try {
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $sth = $dbh->prepare("SELECT `id_cars`, `name`, `race` FROM `cars`");
        $sth->execute();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
              echo '<option value="'. $row['id_cars'] .'">'. $row['name'] . " (" . $row['race'] . ')</option>';
        }
      } catch (PDOException $e) {
        print "Ошибка!: " . $e->getMessage() . "<br>";
      }
      ?>
     </select> <br> <br>
      <input type="number" name="race" value="100" min="0">
      <input type="submit" value="OK">
    </form>
  </body>
</html>
