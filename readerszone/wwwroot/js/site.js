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
    debugger;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            debugger;
            window.location.reload(true);
        }
    };
    xhttp.open("POST", "/ReadersZone/dal/addRating.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var parameters = "userId=" + userId + "&bookId=" + bookId + "&rating=" + ratingValue;
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