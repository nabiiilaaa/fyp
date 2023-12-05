// scripts.js

function loadSection(section) {
    var sectionUrl = section + '.html';

    fetch(sectionUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content-section').innerHTML = data;
        })
        .catch(error => console.error('Error loading section:', error));

        document.getElementById('addBookBtn').addEventListener('click', function() {
            ////////
        });
        
        document.getElementById('addListingBtn').addEventListener('click', function() {
            /////////
        });
        
}
