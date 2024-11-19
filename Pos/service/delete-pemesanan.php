<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Menu.php";

if(!isset($_SESSION["full_nname"])) {
    header("Location: login.php");
    exit;
  }
  
  $id = $_GET["id"];
  $menu = new Menu();
  $detail = $menu->delete($id);

  if(isset($id)) {
    header("Location: ../view/index-menu.php");
  }