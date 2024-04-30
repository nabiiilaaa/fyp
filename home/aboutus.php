<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeCSS.php');?>
    <title>About Us</title>
    <style>
        .team-member {
            display: inline-block;
            margin-right: 20px;
            text-align: center;
        }
        .team-member img {
            width: 100px; 
            height: auto; 
            border-radius: 50%;
        }
    </style>
</head>
<body class>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/header.php');?>
    <header>
        <h1 class="txt-heading">About Us</h1>
    </header>
    
    <section id="content-section">
        <article class="about-us">
            <p>Welcome to Readers Zone, your go-to destination for discovering and exploring a world of books. Our mission is to engage readers like you by providing updated reviews and ratings on a wide range of books.At Book Readers Zone, we believe in the power of literature to inspire, educate, and entertain. Whether you're a seasoned bookworm or just starting your reading journey, our platform is designed to cater to your literary needs.</p>
            
            <p>Our dedicated team of reviewers works tirelessly to bring you honest and insightful reviews, helping you make informed decisions about your next read. We understand the importance of staying connected with the latest literary trends and aim to be your trusted source for book recommendations.</p>
            
            <p>Join our community of book enthusiasts, explore new genres, build your virtual bookshelf, and connect with fellow readers. Readers Zone is not just a website; it's a vibrant community where the love for books knows no bounds.</p>
            
            <p>Thank you for being a part of our journey. Happy reading!</p>
            
            <!-- Team Members Section -->
            <section id="team-members">
                <h2>Our Team</h2>
                <div class="team-member">
                    <img src="/ReadersZone/wwwroot/images/nabila.png" alt="Team Member 1">
                    <p>Nabila Shimla</p>
                </div>
                <div class="team-member">
                    <img src="/ReadersZone/wwwroot/images/kimiaaksir.jpg" alt="Supervisor">
                    <p>Kimia Aksir</p>
                </div>
                <div class="team-member">
                    <img src="/ReadersZone/wwwroot/images/wei li.jpg" alt="Second marker">
                    <p>Wei Li</p>
                </div>
            </section>
        </article>
    </section>
    
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>
