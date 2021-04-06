<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script>
          function LoadFromStorage() {
              let res = localStorage.getItem("race="+document.getElementsByName("race")[0].value);
              if (res == null) {
                  alert("Not found");
                  return;
              }
              else {
                    alert(res);
            }
          }
    </script>
  </head>
  <body>
    <form method="post" action="result.php">
      Введите пробег: <br>
      <input type="number" name="race" value="500" min="0">
      <input type="submit" value="OK">
      <input type="button" value="Storage" onclick="LoadFromStorage()">
    </form>
  </body>
</html>
