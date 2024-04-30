
function confirmDeleteAuthor(id) {
    // Show a confirmation dialog
    if (confirm("Are you sure you want to delete this author?")) {
        // User confirmed, proceed with deletion
        deleteAuthor(id);
    }
}

function deleteAuthor(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/DeleteAuthor.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                
                if (response) {
                    location.reload(true);
                   
                } else {
                    alert("Error deleting author: " + response);
                }
            }
        }
    };
    xhr.send("authorId=" + id);
}

