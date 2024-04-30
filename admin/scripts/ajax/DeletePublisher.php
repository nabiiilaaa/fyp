<?php
require_once('../../../database.php');
require_once('../PublisherManager.php');

 /* delete publisher */
 if (isset($_POST['publisherId'])) {
    $id = $_POST['publisherId'];
    $publisherManager = new PublisherManager($conn);
    $delete = $publisherManager->deleteById($id);
    echo $delete;
  }

?>