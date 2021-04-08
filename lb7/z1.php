<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script>
      const ajax = new XMLHttpRequest();

      function get1() {
          ajax.open("GET", "result.php?date1=" + document.getElementsByName("date1")[0].value);
          ajax.onreadystatechange = update1;
          ajax.send();
      }

      function update1() {
          if (ajax.readyState == 4) {
              if (ajax.status == 200) {
                  console.dir(ajax);
                  console.dir(ajax.responseText);
                  document.getElementById("result").innerHTML = '<table border="1"><tr><th>Сумма</th></tr><tr><td>'
                                                                + ajax.responseXML.getElementsByTagName("sum")[0].firstChild.nodeValue
                                                                + '</tr></td></table>';
              }
          }
      }
    </script>
  </head>
  <body>
      Выберите дату:
      <input type="date" name="date1" value="2021-01-01">
      <input type="button" value="OK" onclick="get1()">
      <div id="result"></div>
  </body>
</html>
