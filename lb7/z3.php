<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script>
      const ajax = new XMLHttpRequest();

      function get3() {
          ajax.open("GET", "result.php?date3=" + document.getElementsByName("date3")[0].value);
          ajax.onreadystatechange = update3;
          ajax.send();
      }

      function update3() {
          if (ajax.readyState == 4) {
              if (ajax.status == 200) {
                  console.dir(ajax);
                  console.dir(ajax.responseText);
                  document.getElementById("result").innerHTML = ajax.responseText;
              }
          }
      }
    </script>
  </head>
  <body>
      Выберите дату:
    <input type="date" name="date3" value="2021-01-01">
    <input type="button" value="OK" onclick="get3()">
    <div id="result"></div>
  </body>
</html>
