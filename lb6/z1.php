<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <script>
        function LoadFromStorage() {
            let res = localStorage.getItem("date1="+document.getElementsByName("date1")[0].value);
            if (res == null) {
                alert("Not found");
                return;
            }
            else {
                  alert(res);
          }
        }
  </script>
  <body>
    <form method="post" action="result.php">
      Выберите дату:
      <input type="datetime-local" name="date1" value="2021-01-01T10:00">
      <input type="submit" value="OK">
      <input type="button" value="Storage" onclick="LoadFromStorage()">
    </form>
  </body>
</html>
