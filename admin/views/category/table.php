

<?php 

  require_once('scripts/CategoryManager.php');

  $categoryManager= new CategoryManager($conn);
  $categories = $categoryManager->get();

 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Category List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=category-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Category Name</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($categories)) {
           
        $sn = 1;
       foreach($categories as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><?= $data['Name']; ?></td>
        <td class="text-center">
            <a href="dashboard.php?page=category-form&Id=<?= $data['Id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>
        <td  class="text-center">
            <a href="javascript:voId(0)" onclick="confirmDeleteCategory(<?=$data['Id']; ?>)" class="text-danger">
              <i class="fa fa-trash-o"></i>
            </a>
        </td>
       
      </tr>
       <?php 
        $sn++; }
        } else {
       ?>
     <tr>
        <td colspan="3">No category Found</td>
       
      </tr>
       <?php } ?>
      
      
    </tbody>
  </table>
</div>

<script src="public/js/ajax/delete-category.js"></script>