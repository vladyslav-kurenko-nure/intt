<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method="post" action="result.php">
      Выберите производителя:
      <select name="vendors">
      <?php
      $db_host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_base = 'iteh2lb1var7';

      try {
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_base", $db_user, $db_password);
        $sth = $dbh->prepare("SELECT `id_vendors`, `name` FROM `vendors`");
        $sth->execute();
        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
              echo '<option value="'. $row['id_vendors'] .'">'. $row['name'] .'</option>';
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
