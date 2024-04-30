

<?php 

  require_once('scripts/PublisherManager.php');

  $PublisherManager= new PublisherManager($conn);
  $publishers = $PublisherManager->get();

 
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Publisher List</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=publisher-form" class="btn btn-success">Add New</a>
    </div>
</div>

<div class="table-responsive-sm">
<table class="table table-hover">
    <thead>
      <tr>
      <th>S.N</th>
        <th>Publisher Name</th>
        <th>Publisher Country</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
        <?php
        if(!empty($publishers)) {
           
        $sn = 1;
       foreach($publishers as $data){
        ?>
      <tr>
      <td><?= $sn; ?></td>
        <td><?= $data['Name']; ?></td>
        <td><?= $data['Country']; ?></td>
        <td class="text-center">
            <a href="dashboard.php?page=publisher-form&Id=<?= $data['Id']; ?>" class="text-success">
                <i class="fa fa-edit"></i>
            </a>
        </td>
        <td  class="text-center">
            <a href="javascript:voId(0)" onclick="confirmDeletePublisher(<?=$data['Id']; ?>)" class="text-danger">
              <i class="fa fa-trash-o"></i>
            </a>
        </td>
       
      </tr>
       <?php 
        $sn++; }
        } else {
       ?>
     <tr>
        <td colspan="3">No Publisher Found</td>
       
      </tr>
       <?php } ?>
      
      
    </tbody>
  </table>
</div>

<script src="public/js/ajax/delete-Publisher.js"></script>