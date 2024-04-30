<?php
class UserManager {

    private $conn;
    private $UserTable = "users";
    private $FavCatTable = "favcategories";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getPassword($Id) {

        $data = [];
    
        $query = "SELECT `Password` FROM ";
        $query .= $this->UserTable; 
        $query .= " WHERE Id=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $Id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data= $result->fetch_assoc();
            $stmt->close();
        } 

        return $data['Password'];
    }

    public function changePassword($userId, $old, $new) {
        $Err = "";

        if($old == $this->getPassword($userId)) {
            $query = "UPDATE ";
            $query .= $this->UserTable;
            $query .= " SET Password = ? WHERE Id = ?";

            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("si", $new, $userId);
            
            if ($stmt->execute()) {
                $stmt->close();
            } else {
                $Err = "Error while updating password";
            }
        } else {
            $Err = "Old password Incorrect";
        }
        return $Err;
    }

    public function updateFavList($userId, $favCats) {
        $this->deleteFavCats($userId);
        foreach($favCats as $cat) {
            $this->addFavCats($userId, $cat);
        }
    }

    public function deleteFavCats($userId) {

        $query = "DELETE FROM ";
        $query .= $this->FavCatTable; 
        $query .= " WHERE userId = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userId);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
        }
        $stmt->close();
    }

    public function addFavCats($userId, $catId) {

        $query = "INSERT INTO ";
        $query .= $this->FavCatTable; 
        $query .= " (userId, categoryId) ";
        $query .= " VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $userId, $catId);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $stmt->close();
        }
        $stmt->close();
    }

    public function updateProfile($userId, $bio, $favouriteQuote) {
        $Err = "";

        $query = "UPDATE ";
        $query .= $this->UserTable;
        $query .= " SET Bio = ?, FavouriteQuote = ? WHERE Id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $bio, $favouriteQuote, $userId);
        
        if ($stmt->execute()) {
            $stmt->close();
        } else {
            $Err = "Error while updating profile";
        }

        return $Err;
    }
    
}



?>
