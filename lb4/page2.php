<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Страница 2</title>
  </head>
  <body>
    <?php
    session_start();
    //session_destroy();
    //echo "POST:" . print_r($_POST) . "<br>";
    //echo "SESSION:" . print_r($_SESSION) . "<br>";
    $requri="http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    //echo "requri: " . $requri . "<br>";
    if (!empty($_SESSION[$requri]))
    {
      $fname=$_SESSION[$requri];
      readfile($fname);
    }
    elseif ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
    {
        $fname = $_FILES['filename']['name'];
        move_uploaded_file($_FILES['filename']['tmp_name'], $fname);
        readfile($fname);
        $_SESSION[$requri]=$fname;
    }
    ?>
    <form class="upfile2" action="" method="POST" enctype='multipart/form-data'>
      <input type="file" name="filename">
      <input type="submit" name="upbutton2" value="Загрузить">
    </form>
    <br> <br>
    <form class="openred2" action="redfile.php" method="POST">
      <input type="submit" name="redbutton2" value="Редактировать">
    </form>
    <br> <br>
    <a href="page1.php"> Страница 1 </a>
  </body>
</html>
