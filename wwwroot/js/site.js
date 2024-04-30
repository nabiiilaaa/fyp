function mouseOverRating(bookId, rating) {
    resetRatingStars(bookId)
    for (var i = 1; i <= rating; i++) {
        var ratingId = bookId + "_" + i;
        document.getElementById(ratingId).style.color = "#ff6e00";
    }
}

function resetRatingStars(bookId) {
    for (var i = 1; i <= 5; i++) {
        var ratingId = bookId + "_" + i;
        document.getElementById(ratingId).style.color = "#9E9E9E";
    }
}

function mouseOutRating(bookId, userRating) {
    var ratingId;
    if(userRating !=0) {
        for (var i = 1; i <= userRating; i++) {
            ratingId = bookId + "_" + i;
            document.getElementById(ratingId).style.color = "#ff6e00";
        }
    }
    if(userRating <= 5) {
        for (var i = (userRating+1); i <= 5; i++) {
            ratingId = bookId + "_" + i;
            document.getElementById(ratingId).style.color = "#9E9E9E";
        }
    }
}
function addRating (userId, bookId, ratingValue) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            window.location.reload(true);
        }
    };
    xhttp.open("POST", "/ReadersZone/dal/addRating.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var parameters = "userId=" + userId + "&bookId=" + bookId + "&rating=" + ratingValue;
    xhttp.send(parameters);
}

function updateReview(userId, bookId, review) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //window.location.reload(true);
        }
    };
    xhttp.open("POST", "/ReadersZone/dal/upateReview.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var parameters = "userId=" + userId + "&bookId=" + bookId + "&review=" + review;
    xhttp.send(parameters);
}

function removeRating (userId, bookId) {
    debugger;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            debugger;
            window.location.reload(true);
        }
    };
    xhttp.open("POST", "/ReadersZone/dal/removeRating.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var parameters = "userId=" + userId + "&bookId=" + bookId;
    xhttp.send(parameters);
}
function sendMessage(userId, bookTitle){
    debugger;
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Prepare the POST request
    var url = "/ReadersZone/chat/insert_chat.php";
    // Open a new connection (POST request) to the PHP file
    xhr.open("POST", url, true);
    // Set the appropriate headers
    // Define a function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Request was successful, do something with the response
            location.href="/ReadersZone/chat";
        }
    };
    // Send the POST request with the parameters
    var formData = new FormData();
    formData.append('to_user_id', userId);
    formData.append('chat_message', "Greetings, Regarding book: "+bookTitle);
    xhr.send(formData);
}