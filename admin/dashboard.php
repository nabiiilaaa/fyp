<?php
  require_once('scripts/AdminAccess.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="public/css/dashboard.css">
  <link rel="stylesheet" href="public/css/common.css">
  <link rel="stylesheet" href="public/css/navbar.css">
  <link rel="stylesheet" href="public/css/sidebar.css">
</head>
<body>
<style>
 

  </style>



<div class="container-fluid">
 <div class="row">
    <div class="col-sm-2 sidebar-col">
   
     <!-----left sidebar---->
     <?php 
       require_once('views/common/left-sidebar.php');
     ?>
     <!-----left sidebar ---->
   </div>
   <div class="col-sm-9 dashboard-col">
    <!--navbar -->
    <?php 
    require_once('views/common/navbar.php');
    ?>
    <!-- navbar -->
     <!-----dashboard---->
     <div class="dashboard-content">
     <?php
      require_once('../database.php');
      

      if(isset($_GET['page'])) {
        $page = $_GET['page'];
        switch($page) {

           /* Category Navigation */
          case 'category-list':
              require_once 'views/category/table.php';
          break;

          case 'category-form':
            require_once 'views/category/form.php';
          break;

          /* Author Navigation */
          case 'author-list':
            require_once 'views/author/table.php';
            break;
          
          case 'author-form':
            require_once 'views/author/form.php';
            break;

            /* Publisher Navigation */
          case 'publisher-list':
            require_once 'views/publisher/table.php';
            break;
          
          case 'publisher-form':
            require_once 'views/publisher/form.php';
            break;
          
            /* Book nvigation*/
          case 'book-list':
            require_once 'views/book/table.php';
          break;
          case 'book-form':
            require_once 'views/book/form.php';
          break;
          case 'book-view':
            require_once 'views/book/view.php';
          break;

          default:
             echo "<h1 class='text-center mt-4'>404 No Page found</h1>";
        } 

      } else {
            require_once('views/dashboard/intro.php');
      }
    ?>
     </div>
     <!-----dashboard ---->
   </div>

 </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/js/sidebar-list.js"></script>


</body>
</html>


