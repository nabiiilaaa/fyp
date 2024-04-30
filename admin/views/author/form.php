

<?php 
require_once('scripts/AuthorManager.php');
$AuthorManager= new AuthorManager($conn);

$msg = '';
$errMsg = '';
$Id = null;

if(isset($_GET['Id'])) {
  $Id = $_GET['Id'];
}

/* create Author  */
if(isset($_POST['create'])) {
  
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  $create = $AuthorManager->create($Name, $Address);

  if($create['success']) {
    $msg = "Author is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update Author */
if(isset($_POST['update'])) {
  
  $Id = $_GET['Id'];
  $Name = $_POST['Name'];
  $Address = $_POST['Address'];
  $update = $AuthorManager->updateById($Id, $Name, $Address);

  if($update['success']) {
    $msg = "Author is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit Author */
if($Id) {

  $getAuthor = $AuthorManager->getById($Id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Author Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=author-list" class="btn btn-success">Author List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="email">Name</label>
      <input type="text" class="form-control" name="Name" value="<?= $getAuthor['Name'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <div class="mb-3 mt-3">
      <label for="email">Address</label>
      <input type="text" class="form-control" name="Address" value="<?= $getAuthor['Address'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $Id ? 'update' : 'create'; ?>">Save</button>
  </form>