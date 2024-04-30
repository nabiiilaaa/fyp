

<?php 
require_once('scripts/BookManager.php');
$bookManager= new BookManager($conn);

require_once('scripts/CategoryManager.php');
$categories = (new CategoryManager($conn))->get();
require_once('scripts/AuthorManager.php');
$authors = (new AuthorManager($conn))->get();
require_once('scripts/PublisherManager.php');
$publishers = (new PublisherManager($conn))->get();


$msg = '';
$errMsg = '';
$id = null;

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

/* create book  */
if(isset($_POST['create'])) {
 
  $Name = $_POST['Name'];
  $Code = $_POST['Code'];
  $ISBN = $_POST['ISBN'];
  $Description = $_POST['Description'];
  $Pages = $_POST['Pages'];
  $CategoryId = $_POST['CategoryId'];
  $PublisherId = $_POST['PublisherId'];
  $AuthorId = $_POST['AuthorId'];
 
  $create = $bookManager->create($Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId);

  if($create['success']) {
    $msg = "Book is created successfully";
  }

  if($create['uploadImage']) {
    $ImageErr = $create['uploadImage'];
    
  }

  if($create['uploadPdf']) {
    $PdfErr = $create['uploadPdf'];
    
  }

  if($create['errMsg']) {
   
    //$nameErr = $create['errMsg']['name'];
    //$codeErr = $create['errMsg']['code'];
    //$isbnErr = $create['errMsg']['isbn'];
    //$descriptionErr = $create['errMsg']['description'];
    ///$pagesErr = $create['errMsg']['pages'];
    //$categoryIdErr = $create['errMsg']['categoryId'];
    //$authorIdErr = $create['errMsg']['authorId'];
    //$publisherIdErr = $create['errMsg']['publisherId'];
  }

}

/* update book  */
if(isset($_POST['update'])) {
 
  $Name = $_POST['Name'];
  $Code = $_POST['Code'];
  $ISBN = $_POST['ISBN'];
  $Description = $_POST['Description'];
  $Pages = $_POST['Pages'];
  $CategoryId = $_POST['CategoryId'];
  $PublisherId = $_POST['PublisherId'];
  $AuthorId = $_POST['AuthorId'];
 

  $update = $bookManager->updateByid($id, $Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId);
  
    if($update['success']) {
      $msg = "Book is updated successfully";
    }
  
    if($update['uploadImage']) {
      $ImageErr = $update['uploadImage'];
      
    }

    if($update['uploadPdf']) {
      $PdfErr = $update['uploadPdf'];
      
    }
  
    if($update['errMsg']) {
     
      // $nameErr = $update['errMsg']['name'];
      // $codeErr = $update['errMsg']['code'];
      // $isbnErr = $update['errMsg']['isbn'];
      // $descriptionErr = $update['errMsg']['description'];
      // $pagesErr = $update['errMsg']['pages'];
      // $categoryIdErr = $update['errMsg']['categoryId'];
      // $authorIdErr = $update['errMsg']['authorId'];
      // $publisherIdErr = $update['errMsg']['publisherId'];
    }
  
  }

/* edit category */
if($id) {
  $getBook = $bookManager->getById($id);

}
?>
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">Book Form</h3>
     <?php echo $msg; ?>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=book-list" class="btn btn-success">Book List</a>
    </div>
</div>


<form method="post" enctype="multipart/form-data">
    <div class="mb-3 mt-3">
      <label>Title</label>
      <input type="text" class="form-control" name="Name" value="<?= $getBook['Name'] ?? ''; ?>">
       <p class="text-danger"><?= $nameErr ?? ''; ?></p>

       <label>Code</label>
      <input type="text" class="form-control" name="Code" value="<?= $getBook['Code'] ?? ''; ?>">
       <p class="text-danger"><?= $codeErr ?? ''; ?></p>

       <label>ISBN</label>
      <input type="text" class="form-control" name="ISBN" value="<?= $getBook['ISBN'] ?? ''; ?>">
       <p class="text-danger"><?= $isbnErr ?? ''; ?></p>
       
       <label >Description</label>
       <textarea class="form-control" name="Description" id = "summernote" style="height: 100px;"><?= $getBook['Description'] ?? ''; ?></textarea>
       <p class="text-danger"><p class="text-danger"><?= $descriptionErr ?? ''; ?></p></p>

       <label>Pages</label>
      <input type="number" class="form-control" name="Pages" value="<?= $getBook['Pages'] ?? ''; ?>">
       <p class="text-danger"><?= $pagesErr ?? ''; ?></p>
      
       <select class="form-control" name="CategoryId">
       <option value="">Select Category</option>

    <?php
    // Loop through the categories obtained from the category manager
      foreach ($categories as $category) {
        $categoryId = $category['Id'];
        $categoryName = $category['Name']; // Use 'categoryName' instead of 'name'

        // Check if this category is selected (for updating book)
        $selected = isset($getBook['CategoryId']) && $getBook['CategoryId'] == $categoryId ? 'selected' : '';

        echo "<option value='$categoryId' $selected>$categoryName</option>";
      }
     ?>
       </select>
       <p class="text-danger"><p class="text-danger"><?= $categoryIdErr ?? ''; ?></p></p>

       <select class="form-control" name="AuthorId">
       <option value="">Select Author</option>

    <?php
    // Loop through the authors obtained from the author manager
      foreach ($authors as $author) {
        $authorId = $author['Id'];
        $authorName = $author['Name']; // Use 'authorName' instead of 'name'

        // Check if this author is selected (for updating book)
        $selected = isset($getBook['AuthorId']) && $getBook['AuthorId'] == $authorId ? 'selected' : '';

        echo "<option value='$authorId' $selected>$authorName</option>";
      }
     ?>
       </select>
       <p class="text-danger"><p class="text-danger"><?= $authorIdErr ?? ''; ?></p></p>

       <select class="form-control" name="PublisherId">
       <option value="">Select Publisher</option>

    <?php
    // Loop through the publishers obtained from the publisher manager
      foreach ($publishers as $publisher) {
        $publisherId = $publisher['Id'];
        $publisherName = $publisher['Name']; // Use 'publisherName' instead of 'name'

        // Check if this publisher is selected (for updating book)
        $selected = isset($getBook['PublisherId']) && $getBook['PublisherId'] == $publisherId ? 'selected' : '';

        echo "<option value='$publisherId' $selected>$publisherName</option>";
      }
     ?>
       </select>
       <p class="text-danger"><p class="text-danger"><?= $publisherIdErr ?? ''; ?></p></p>

       <label >Image</label>
        <input type="file" class="form-control" name="ImageLoc">
        <?php 
        if(isset($getBook['ImageLoc'])){
        ?>
            <img src="./../wwwroot/book/images/<?=$getBook['ImageLoc']; ?>" width="100px">
        <?php
        }
        ?>
        
        <p class="text-danger"><?=  $ImageErr ?? ''; ?></p>

        <label >PDF File</label>
        <input type="file" class="form-control" name="PdfLoc">
        
        
        <p class="text-danger"><?=  $PdfErr ?? ''; ?></p>

    </div>

    <button type="submit" class="btn btn-success" name="<?= $id ? 'update' : 'create'; ?>">Save</button>
  </form>