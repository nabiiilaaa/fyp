<?php
class BookManager {

    private $conn;
    private $bookTable = 'books';
    private $categoryTable = 'categories';
    private $authorTable = 'authors';
    private $publisherTable = 'publishers';


    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId) {

        $error = false;
        $errMsg = null;
        $nameErr = '';


        if(empty($Name)) {
            $nameErr = "Name is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "name" => $nameErr

            ]
        ];
        
        return $errorInfo;
    }

    public function uploadImage($id= null) {
  
        $error = false;
        $ImageErr = '';
        $uploadTo = "./../wwwroot/book/images/"; 
        $allowFileType = array('jpg','png','jpeg');
        $fileName = $_FILES['ImageLoc']['name'];

        if(empty($fileName)) {
            if($id == null) {
                $ImageErr = 'Image is required'; 
                $error = true;
            } else {
                // No update needed
                $fileName = $this->getById($id)['ImageLoc'];
            }
        } else {
            if($id == null) {
                $fileName = ($this->getLastId()+1)."-".$fileName;
            } else {
                $fileName = ($id+1)."-".$fileName;
            }
            $tempPath = $_FILES["ImageLoc"]["tmp_name"];
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowFileType)){ 
                if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $ImageErr = 'Image Not uploaded ! try again';
                    $error = true;
                }
            } else {  
                $ImageErr = 'Image type is not allowed'; 
                $error = true;
            }
        }
        $imageInfo = [
            "error" => $error, 
            "ImageErr" => $ImageErr, 
            "fileName" => $fileName
        ];

        return  $imageInfo;
    }

    public function uploadPdf($id= null) {
  
        $error = false;
        $PdfErr = '';
        $uploadTo = "./../wwwroot/book/pdfs/"; 
        $allowFileType = array('pdf');
        $fileName = $_FILES['PdfLoc']['name'];

        if(empty($fileName)) {
            if($id == null) {
                $PdfErr = 'PDF is required'; 
                $error = true;
            } else {
                // No update needed
                $fileName = $this->getById($id)['PdfLoc'];
            }
        } else {
            if($id == null) {
                $fileName = ($this->getLastId()+1)."-".$fileName;
            } else {
                $fileName = ($id+1)."-".$fileName;
            }
            $tempPath = $_FILES["PdfLoc"]["tmp_name"];
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowFileType)){ 
                if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $PdfErr = 'PDF Not uploaded ! try again';
                    $error = true;
                }
            } else {  
                $PdfErr = 'Only PDF type is allowed'; 
                $error = true;
            }
        }
        $pdfInfo = [
            "error" => $error, 
            "PdfErr" => $PdfErr, 
            "fileName" => $fileName
        ];

        return  $pdfInfo;
    }
    public function getLastId(){
        $data = [];
    
        $query = "SELECT * FROM ";
        $query .= $this->bookTable;
        $query .= " ORDER BY Id DESC";

        $stmt = $this->conn->prepare($query);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } 
        if ($data == null) {
            return 0;
        } else {
            return $data['Id'];
        }
    }
    public function create($Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId) {

        $validate = $this->validate($Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId);
       
        $success = false;

        if (!$validate['error']){
                $uploadImage = $this->uploadImage();
                $uploadPdf = $this->uploadPdf();
                if(!$uploadImage['error'] && !$uploadPdf['error']) {
                    $query = "INSERT INTO ";
                    $query .= $this->bookTable;
                    $query .= " (Name, Code, ISBN, Description, Pages, ImageLoc, PdfLoc, CategoryId, PublisherId, AuthorId) ";
                    $query .= " VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

                    $stmt = $this->conn->prepare($query);
            
                    $stmt->bind_param("ssssissiii", $Name, $Code, $ISBN, $Description, $Pages, $uploadImage['fileName'], $uploadPdf['fileName'], $CategoryId, $PublisherId, $AuthorId);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
            }  
        }
         $data = [
            'errMsg'            => $validate['errMsg'],
            'uploadImage' => $uploadImage['ImageErr'] ?? 'Unable to upload Image due to other fields facing errors',
            'uploadPdf' => $uploadPdf['PdfErr'] ?? 'Unable to upload PDF due to other fields facing errors',
            'success'           => $success
         ];

         return $data;
    }

    public function updateById($Id, $Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId) {

        $validate = $this->validate($Name, $Code, $ISBN, $Description, $Pages, $CategoryId, $PublisherId, $AuthorId);
       
        $success = false;
        if (!$validate['error']){
            $uploadImage = $this->uploadImage($Id);
            $uploadPdf = $this->uploadPdf($Id);

            if(!$uploadImage['error'] && !$uploadPdf['error']) {

                    $query = "UPDATE ";
                    $query .= $this->bookTable;
                    $query .= " SET Name = ?, Code = ?, ISBN = ?, Description = ?, Pages = ?, ImageLoc = ?, PdfLoc = ?, CategoryId = ?, PublisherId = ?, AuthorId = ?";
                    $query .= " WHERE Id = ?";

                    $stmt = $this->conn->prepare($query);
                    
                    $stmt->bind_param("ssssissiiii", $Name, $Code, $ISBN, $Description, $Pages, $uploadImage['fileName'], $uploadPdf['fileName'], $CategoryId, $PublisherId, $AuthorId, $Id);
                    
                    if ($stmt->execute()) {
                        
                        $success = true;
                        $stmt->close();
                    }
                }
           
        }
         
         $data = [
            'errMsg'            => $validate['errMsg'],
        'uploadImage' => $uploadImage['ImageErr'] ?? 'Unable to upload Image due to other fields facing errors',
        'uploadPdf' => $uploadPdf['PdfErr'] ?? 'Unable to upload PDF due to other fields facing errors',
        'success'           => $success
         ];

         return $data;
    }

    public function get() {

        $data = [];
    
        $query = "SELECT * FROM ";
        $query .= $this->bookTable;

        $result = $this->conn->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getJoined() {
        $data = [];

        $query = "SELECT t1.*, t2.Name as Category, t3.Name as Author, t4.Name as Publisher FROM ";
        $query .= $this->bookTable;
        $query .= " AS t1 ";
        $query .= "INNER JOIN ";
        $query .= $this->categoryTable;
        $query .= " AS t2";
        $query .= " ON t1.categoryId = t2.Id ";
        $query .= "INNER JOIN ";
        $query .= $this->authorTable;
        $query .= " AS t3";
        $query .= " ON t1.authorId = t3.Id ";
        $query .= "INNER JOIN ";
        $query .= $this->publisherTable;
        $query .= " AS t4";
        $query .= " ON t1.publisherId = t4.Id ";

        $result = $this->conn->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getById($id) {

        $data = [];
    
        $query = "SELECT * FROM ";
        $query .= $this->bookTable;
        $query .= " WHERE Id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }

    public function getFromMultipleTables($id) {
        $data = [];

        $query = "SELECT t1.*, t2.Name as Category, t3.Name as Author, t4.Name as Publisher FROM ";
        $query .= $this->bookTable;
        $query .= " AS t1 ";
        $query .= "INNER JOIN ";
        $query .= $this->categoryTable;
        $query .= " AS t2";
        $query .= " ON t1.categoryId = t2.Id ";
        $query .= "INNER JOIN ";
        $query .= $this->authorTable;
        $query .= " AS t3";
        $query .= " ON t1.authorId = t3.Id ";
        $query .= "INNER JOIN ";
        $query .= $this->publisherTable;
        $query .= " AS t4";
        $query .= " ON t1.publisherId = t4.Id ";
        $query .= " WHERE t1.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
        }
        return $data;
    }
    

    public function deleteById($id) {

        $query = "DELETE FROM ";
        $query .= $this->bookTable;
        $query .= " WHERE Id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
}



?>
