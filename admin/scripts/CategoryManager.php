<?php
class CategoryManager {

    private $conn;
    private $categoryTable = "categories";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function valIdate($Name) {

        $error = false;
        $errMsg = null;

        if(empty($Name)) {
            $errMsg = "Category is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg
        ];
        
        return $errorInfo;
    }

    public function create($Name) {

        $valIdate = $this->valIdate($Name);
        $success = false;

        if (!$valIdate['error']){

            $query = "INSERT INTO ";
            $query .= $this->categoryTable; 
            $query .= " (Name) ";
            $query .= " VALUES (?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $Name);
            
            if ($stmt->execute()) {
                $success = true;
                $stmt->close();
            }
        }
         
         $data = [
            'errMsg' => $valIdate['errMsg'],
            'success' => $success
         ];

         return $data;
    }

    public function get() {

        $data = [];
    
        $query = "SELECT Id, Name FROM ";
        $query .= $this->categoryTable;
        
        $result = $this->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getById($Id) {

        $data = [];
    
        $query = "SELECT Name FROM ";
        $query .= $this->categoryTable; 
        $query .= " WHERE Id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $Id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data= $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }

    public function updateById($Id, $Name) {

        $valIdate = $this->valIdate($Name);
        $success = false;

        if (!$valIdate['error']){

            $query = "UPDATE ";
            $query .= $this->categoryTable;
            $query .= " SET Name = ? WHERE Id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $Name, $Id);
            
            if ($stmt->execute()) {
                $success = true;
                $stmt->close();
            }
        }
         
         $data = [
            'errMsg' => $valIdate['errMsg'],
            'success' => $success
         ];

         return $data;
    }

    public function deleteById($Id) {

        $query = "DELETE FROM ";
        $query .= $this->categoryTable; 
        $query .= " WHERE Id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $Id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
        }
        $stmt->close();
    }
    
}



?>
