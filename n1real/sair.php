<?php 
session_start();


if((!isset($_SESSION['usuario']) == true) && (!isset($_SESSION['senha']) == true))
{
    unset($_SESSION['usuario']);
    unset($_SESSION['senha']);
}

session_destroy();
  
    echo"<script language='javascript' type='text/javascript'>
        setTimeout(function(){location.href='index.php'} , 0);
    </script>";
?>