<?php
require_once('../../../database.php');
require_once('../AuthorManager.php');

 /* delete author */
 if (isset($_POST['authorId'])) {
    $id = $_POST['authorId'];
    $authorManager = new AuthorManager($conn);
    $delete = $authorManager->deleteById($id);
    echo $delete;
  }

?>