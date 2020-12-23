<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ЛБ-4</title>
  </head>
  <body>
    <?php
    session_start();
    //echo "POST:" . print_r($_POST) . "<br>";
    //var_dump($_POST);
    //echo "<br>";
    //var_dump($_SESSION);

        if (!empty($_SERVER["HTTP_REFERER"])) $refuri=$_SERVER["HTTP_REFERER"];
        if (!empty($_SESSION[$refuri]))
        {
          $file=__DIR__ . "/" . $_SESSION[$refuri];
          if(file_exists($file)) $text = file_get_contents($file);
        }
    ?>
      <form action="savechangesfile.php" method="POST" autocomplete="off">
        <textarea name="text" rows="20" cols="80"><?php if (!empty($text)) echo $text; ?></textarea> <br>
        <input type="hidden" name="frefuri" value=<?php if (!empty($_SERVER["HTTP_REFERER"])) echo $_SERVER["HTTP_REFERER"]; ?>>
        <input type="submit" name="save" value="Сохранить">
      </form>
  </body>
</html>
