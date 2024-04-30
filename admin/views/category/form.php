

<?php 
require_once('scripts/CategoryManager.php');
$categoryManager= new CategoryManager($conn);

$msg = '';
$errMsg = '';
$Id = null;

if(isset($_GET['Id'])) {
  $Id = $_GET['Id'];
}

/* create category  */
if(isset($_POST['create'])) {
  
  $Name = $_POST['Name'];
  $create = $categoryManager->create($Name);

  if($create['success']) {
    $msg = "Category is saved successfully";
  }

  if($create['errMsg']) {
    $errMsg = $create['errMsg'];
  }
  
}

/* update category */
if(isset($_POST['update'])) {
  
  $Id = $_GET['Id'];
  $Name = $_POST['Name'];

  $update = $categoryManager->updateById($Id, $Name);

  if($update['success']) {
    $msg = "Category is updated successfully";
  }

  if($update['errMsg']) {
    $errMsg = $update['errMsg'];
  }
}

/* edit category */
if($Id) {

  $getCategory = $categoryManager->getById($Id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Category Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=category-list" class="btn btn-success">Category List</a>
    </div>
</div>


<form method="post"   >
    <div class="mb-3 mt-3">
      <label for="email">Name</label>
      <input type="text" class="form-control" name="Name" value="<?= $getCategory['Name'] ?? ''; ?>">
       <p class="text-danger"><?php echo $errMsg; ?></p>
    </div>

    <button type="submit" class="btn btn-success" name="<?= $Id ? 'update' : 'create'; ?>">Save</button>
  </form>