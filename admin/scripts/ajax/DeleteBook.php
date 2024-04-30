<?php
require_once('../../../database.php');
require_once('../BookManager.php');

 /* delete Book */
 if (isset($_POST['BookId'])) {
    $id = $_POST['BookId'];
    $BookManager = new BookManager($conn);
    $delete = $BookManager->deleteById($id);
    echo $delete;
  }

?>