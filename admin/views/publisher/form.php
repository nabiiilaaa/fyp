

<?php 
require_once('scripts/PublisherManager.php');
$PublisherManager= new PublisherManager($conn);

$msg = '';
$errMsg = '';
$Id = null;

if(isset($_GET['Id'])) {
  $Id = $_GET['Id'];
}

/* create Publisher  */
if(isset($_POST['create'])) {
  
  $Name = $_POST['Name'];
  $Country = $_POST['Country'];
  $create = $PublisherManager->create($Name, $Country);

  if($create['success']) {
    $msg = "Publisher is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update Publisher */
if(isset($_POST['update'])) {
  
  $Id = $_GET['Id'];
  $Name = $_POST['Name'];
  $Country = $_POST['Country'];
  $update = $PublisherManager->updateById($Id, $Name, $Country);

  if($update['success']) {
    $msg = "Publisher is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit Publisher */
if($Id) {

  $getPublisher = $PublisherManager->getById($Id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Publisher Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=publisher-list" class="btn btn-success">Publisher List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="email">Name</label>
      <input type="text" class="form-control" name="Name" value="<?= $getPublisher['Name'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <div class="mb-3 mt-3">
      <label for="email">Country</label>
      <input type="text" class="form-control" name="Country" value="<?= $getPublisher['Country'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $Id ? 'update' : 'create'; ?>">Save</button>
  </form>