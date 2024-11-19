<?php

require_once __DIR__ . "/../Model/model.php";
require_once __DIR__ . "/../Model/Category.php";

if(!isset($_SESSION["full_name"])) {
    header("Location: login.php");
    exit;
  }
  
  $id = $_GET["id"];
  $categories = new Categories();
  $detail = $categories->delete($id);

  if(isset($id)) {
    header("Location: ../view/index-category.php");
  }