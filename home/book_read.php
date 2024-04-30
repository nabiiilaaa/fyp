<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); 
$db_handle = new DBController();

include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');

$book_array = $db_handle->runQuery("SELECT books.*, categories.Name as Category, authors.Name as Author, publishers.Name as Publisher, publishers.Country as Country 
FROM books join categories on books.CategoryId = categories.Id join authors on books.AuthorId = authors.Id join publishers on books.PublisherId = publishers.Id 
WHERE books.Id = " . $_GET["Id"]);
if (!empty($book_array)) { 
    foreach($book_array as $key=>$value){
        echo "<html>
                <head>
                    <script src='/ReadersZone/wwwroot/lib/pdfobject/pdfobject.min.js'></script>
                </head>
                <body>
                    <script>PDFObject.embed('/ReadersZone/wwwroot/book/pdfs/".$book_array[$key]['PdfLoc']."');</script>
                </body>
            </html>";
    }
}
else{
    echo '<script>location.href = \'explore.php\';</script>';
}

?>