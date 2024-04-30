<?php
class MarketManager {

    private $conn;
    private $marketTable = "market";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function valIdate($bookId, $userId, $Contact, $Address, $Price, $Remarks) {

        $error = false;
        $errMsg = null;

        if(empty($bookId)) {
            $errMsg = "Error, cannot add to market place";
            $error = true;
        } 

        if(empty($userId)) {
            $errMsg = "Error, cannot add to market place";
            $error = true;
        } 

        if(empty($Contact)) {
            $errMsg = "Error, please specify contact number";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => $errMsg
        ];
        
        return $errorInfo;
    }

    public function create($bookId, $userId, $Contact, $Address, $Price, $Remarks) {

        $valIdate = $this->valIdate($bookId, $userId, $Contact, $Address, $Price, $Remarks);
        $success = false;

        if (!$valIdate['error']){

            $query = "INSERT INTO ";
            $query .= $this->marketTable; 
            $query .= " (bookId, userId, Contact, Address, Price, Remarks) ";
            $query .= " VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("iissis", $bookId, $userId, $Contact, $Address, $Price, $Remarks);
            
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
        $query .= $this->marketTable;
        
        $result = $this->conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getById($bookId, $userId) {

        $data = [];
    
        $query = "SELECT * FROM ";
        $query .= $this->marketTable; 
        $query .= " WHERE bookId = ? AND userId = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $bookId, $userId);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data= $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }

    public function update($bookId, $userId, $Contact, $Address, $Price, $Remarks) {

        $valIdate = $this->valIdate($bookId, $userId, $Contact, $Address, $Price, $Remarks);
        $success = false;

        if (!$valIdate['error']){

            $query = "UPDATE ";
            $query .= $this->marketTable;
            $query .= " SET Contact = ?, Address = ?, Price = ?, Remarks = ? WHERE bookId = ? AND userId = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ssisii", $Contact, $Address, $Price, $Remarks, $bookId, $userId);
            
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

    public function delete($bookId, $userId) {

        $query = "DELETE FROM ";
        $query .= $this->marketTable; 
        $query .= " WHERE bookId = ? AND userId = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $bookId, $userId);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
        }
        $stmt->close();
    }
}



?>
