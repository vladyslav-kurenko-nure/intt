<?php
session_start();
if (isset($_POST['save']))
{
  if (isset($_POST['text']) && isset($_POST['frefuri']))
  {
    if (!empty($_SESSION[$_POST['frefuri']]))
    {
      if(file_exists(__DIR__ . "/" . $_SESSION[$_POST['frefuri']])) file_put_contents(__DIR__ . "/" . $_SESSION[$_POST['frefuri']], $_POST['text']);
    }
    header('Location: ' . $_POST['frefuri']);
    exit;
  }
}
?>
