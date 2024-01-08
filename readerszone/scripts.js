// scripts.js

function loadSection(section) {
    var sectionUrl = section + '.html';

    fetch(sectionUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content-section').innerHTML = data;
            if (section !== 'about-us') {
                removeImageAndHeader();
            }
        })
        .catch(error => console.error('Error loading section:', error));
}

function removeImageAndHeader() {
    // Remove the image
    var logoElement = document.querySelector('.logo');
    if (logoElement) {
        logoElement.remove();
    }

    // Remove the header
    var headerElement = document.querySelector('header');
    if (headerElement) {
        headerElement.remove();
    }
}

function showForm(formType) {
    if (formType === 'signup') {
        document.getElementById('signup-form').style.display = 'block';
        document.getElementById('login-form').style.display = 'none';
    } else if (formType === 'login') {
        document.getElementById('signup-form').style.display = 'none';
        document.getElementById('login-form').style.display = 'block';
    }
}

function validateSignupForm() {
    // Add validation logic for signup form
    return true; // Return true if the form is valid
}

function validateLoginForm() {
    // Add validation logic for login form
    return true; // Return true if the form is valid
}
