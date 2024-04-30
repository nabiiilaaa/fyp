<?php
session_start();
if(isset($_SESSION['UserName']) && !empty($_SESSION['UserName'])){
    if (isset($_SESSION['accessType']) == "admin") {
        header("location: dashboard.php");
     }
}
?>
<?php
require_once('scripts/AdminLogin.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="public/css/login.css">
    <link rel="stylesheet" href="public/css/common.css">
</head>
<body style="background-image: linear-gradient(rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.5)),url(/ReadersZone/wwwroot/images/Background.png);
    background-repeat: no-repeat;
    background-attachment: fixed; 
    background-size: 100% 100%;">
   
<div class="container-fluid">
    <div class="row">
        <div class="col-sm">
           
            <!--- login form-->
            <div class="login-form bg-light" style="--bs-bg-opacity: 50%; padding-top: 20px;">
                <h1 style="color: #433831 !important;">Admin Panel</h1>
                <p class="text-danger"><?= $login ?? ''; ?></p>
                <form method="post">
                    <div class=" mb-3 mt-3">
                    <label for="email">Username or Email</label>
                    <input type="text" class="form-control" name="emailAddress">
                    <p class="text-danger"><?= $validateLogin['emailErr'] ?? ''; ?></p>
                    </div>
                    
                    <div class=" mt-3 mb-3">
                    <label for="email">Password</label>
                    <input type="password" class="form-control" name="pass">
                    <p class="text-danger"><?= $validateLogin['passErr'] ?? ''; ?></p>
                    </div>
                    
                     <div class="row">
                        <div class="col-sm-6">
                        <div class="form-check input-group mb-3 mt-3">
                                <input class="form-check-input" type="checkbox"  name="remember"> 
                                 <label class="form-check-label"> Remember me Password</label>
                            </div>
                        </div>
                     </div>
                  
                    <button type="submit" name="login" class="btn btn-success form-control" style="border-bottom: 0px !important; background-color: #A17A60;">Login</button>
                </form>
            </div>
            <!---- login form-->
       </div>
    </div>
</div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</body>
</html>
