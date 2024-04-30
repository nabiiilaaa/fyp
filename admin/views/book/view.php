
<?php
  require_once('scripts/BookManager.php');

  $bookManager= new BookManager($conn);

  if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $bookData = $bookManager->getFromMultipleTables($id);
  }

?>
<link rel="stylesheet" href="public/css/site.css">
<div class="row">
    <div class="col-sm-6">
     <h3 class="mb-4">View Book</h3>
    </div>
    <div class="col-sm-6 text-end">
        <a href="dashboard.php?page=book-list" class="btn btn-success">Book List</a>
    </div>
</div>
<div id="book-grid" style="height: 50%; margin-bottom: 0px;">
  <div class="txt-heading"><h2><?php echo $bookData["Code"]. " - " .$bookData["Name"]; ?></h2></div>
  <img class="book-image-large" src="/ReadersZone/wwwroot/book/images/<?php echo $bookData["ImageLoc"]; ?>">
  <div class="book-item-detail" style="width: -webkit-fill-available">
    <table class="book-detail-table">
      <tbody>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">Code</td>
          <td class="book-detail-values"><?php echo $bookData["Code"]; ?></td>
        </tr>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">Name</td>
          <td class="book-detail-values"><?php echo $bookData["Name"]; ?></td>
        </tr>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">Author</td>
          <td class="book-detail-values"><?php echo $bookData["Author"]; ?></td>
        </tr>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">Publisher</td>
          <td class="book-detail-values"><?php echo $bookData["Publisher"]; ?></td>
        </tr>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">ISBN</td>
          <td class="book-detail-values"><?php echo $bookData["ISBN"]; ?></td>
        </tr>
        <tr class="book-detail-table-row">
          <td class="book-detail-heads">Description</td>
          <td class="book-detail-values"><?php echo $bookData["Description"]; ?></td>
        </tr>
      </tbody>
    </table>
    <input type='button' value='Read' class='btn btn-success' style="margin-bottom: 10px; margin-left: 10px;" onclick="location.href='/ReadersZone/home/book_read.php?Id=<?php echo $bookData['Id']; ?>';"/>
  </div>
</div>