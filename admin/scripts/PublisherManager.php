<?php
class PublisherManager {

    private $conn;
    private $PublisherTable = "publishers";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function valIdate($Name) {

        $error = false;
        $errMsg = null;

        if(empty($Name)) {
            $errMsg = "Publisher is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg
        ];
        
        return $errorInfo;
    }

    public function create($Name, $Country) {

        $valIdate = $this->valIdate($Name);
        $success = false;

        if (!$valIdate['error']){

            $query = "INSERT INTO ";
            $query .= $this->PublisherTable; 
            $query .= " (Name, Country) ";
            $query .= " VALUES (?, ?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ss", $Name, $Country);
            
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
    
        $query = "SELECT Id, Name, Country FROM ";
        $query .= $this->PublisherTable;
        
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
    
        $query = "SELECT Name, Country FROM ";
        $query .= $this->PublisherTable; 
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

    public function updateById($Id, $Name, $Country) {

        $valIdate = $this->valIdate($Name);
        $success = false;

        if (!$valIdate['error']){

            $query = "UPDATE ";
            $query .= $this->PublisherTable;
            $query .= " SET Name = ?, Country = ? WHERE Id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssi", $Name, $Country, $Id);
            
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
        $query .= $this->PublisherTable; 
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
