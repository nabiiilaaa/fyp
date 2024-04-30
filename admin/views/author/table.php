

<?php 

  require_once('scripts/AuthorManager.php');

  $AuthorManager= new AuthorManager($conn);
  $authors = $AuthorManager->get();

 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Author List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=author-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Author Name</th>
        <th>Author Address</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($authors)) {
           
        $sn = 1;
       foreach($authors as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><?= $data['Name']; ?></td>
        <td><?= $data['Address']; ?></td>
        <td class="text-center">
            <a href="dashboard.php?page=author-form&Id=<?= $data['Id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>
        <td  class="text-center">
            <a href="javascript:voId(0)" onclick="confirmDeleteAuthor(<?=$data['Id']; ?>)" class="text-danger">
              <i class="fa fa-trash-o"></i>
            </a>
        </td>
       
      </tr>
       <?php 
        $sn++; }
        } else {
       ?>
     <tr>
        <td colspan="3">No Author Found</td>
       
      </tr>
       <?php } ?>
      
      
    </tbody>
  </table>
</div>

<script src="public/js/ajax/delete-Author.js"></script>