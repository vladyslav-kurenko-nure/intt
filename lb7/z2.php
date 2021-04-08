<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script>
      const ajax = new XMLHttpRequest();

      function get2() {
          ajax.open("GET", "result.php?vendors=" + document.getElementsByName("vendors")[0].value);
          ajax.onreadystatechange = update2;
          ajax.send();
      }

      function update2() {
          if (ajax.readyState == 4) {
              if (ajax.status == 200) {
                  console.dir(ajax);
                  console.dir(ajax.responseText);
                  let res = JSON.parse(ajax.response);
                  let output = '<table border="1"><tr><th>Сумма</th></tr>';
                  for(let i in res) {
                    output += '<tr><td>' + res[i].Name + '</tr></td>';
                }
                output+="</table>";
                document.getElementById("result").innerHTML = output;
              }
          }
      }
    </script>
  </head>
  <body>
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
    <input type="button" value="OK" onclick="get2()">
    <div id="result"></div>
  </body>
</html>
