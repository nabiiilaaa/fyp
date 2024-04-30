<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogin.php');?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/dal/dbController.php'); $db_handle = new DBController(); ?>


<?php
    require_once('./../admin/scripts/UserManager.php');
    $userManager= new UserManager($db_handle->conn);
    function changePassword() {

    }
    function updateFavList($userManager, $userId) {
        if(isset($_POST['favCat'])) {
            $favCats = $_POST['favCat'];
            $userManager->updateFavList($userId, $favCats);
        } else {
            $userManager->deleteFavCats($userId);
        }
    }
    if(isset($_POST['save'])) {
        
        $Err = "";
        $userId = $_SESSION['UserId'];
        $bio = $_POST['Bio'];
        $favouriteQuote = $_POST['FavouriteQuote'];
        $currentPassword = $_POST['CurrentPassword'];
        $NewPassword = $_POST['NewPassword'];
        $ConfirmPassword = $_POST['ConfirmPassword'];
        if($currentPassword != "") {
            if($NewPassword == "") {
                $Err = "Please enter new password";
            } else if($ConfirmPassword == "") {
                $Err = "Please enter confirm password";
            } else if($NewPassword != $ConfirmPassword) {
                $Err = "New password didn't matched";
            } else {
                $Err = $userManager->updateProfile($userId, $bio, $favouriteQuote);
                if($Err == "") {
                    $Err = $userManager->changePassword($userId, $currentPassword, $NewPassword);
                    if($Err == "") {
                        updateFavList($userManager, $userId);
                        $Msg = "Profile updated successfully, Password changed successfully, Favourite list updated";
                    }
                }
            }
        } else {
            $Err = $userManager->updateProfile($userId, $bio, $favouriteQuote);
            if($Err == "") {
                updateFavList($userManager, $userId);
                $Msg = "Profile updated successfully, Password didn't changed, Favourite list updated";
            }
        }
    }

    $data = $db_handle->getData("SELECT * FROM users WHERE `Id`='".$_SESSION['UserId']."'");
    $favCat = $db_handle->getMultiData("SELECT `categories`.`Id` AS 'catId', `categories`.`Name` AS 'catName', `users`.`Id` AS 'userId' FROM `categories` LEFT JOIN `favcategories` ON `categories`.`Id` = `favcategories`.`categoryId` LEFT JOIN `users` ON `users`.`Id` = `favcategories`.`userId` AND `users`.`Id` = '".$_SESSION['UserId']."'");
?>


<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeCSS.php');?>
</head>
<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/header.php');?>

    <form class="profileForm" method="post" enctype="multipart/form-data">
        <div class="active-pink-4">
            <label>Email</label>
            <input readonly type="text" class="form-control" name="Email" value="<?= $data['Email'] ?? ''; ?>">

            <label>Username</label>
            <input readonly type="text" class="form-control" name="UserName" value="<?= $data['UserName'] ?? ''; ?>">

            <label>Bio</label>
            <input type="text" class="form-control" name="Bio" value="<?= $data['Bio'] ?? ''; ?>">

            <label>Favourite Quote</label>
            <input type="text" class="form-control" name="FavouriteQuote" value="<?= $data['FavouriteQuote'] ?? ''; ?>">

            <label>Current Password</label>
            <input type="password" class="form-control" name="CurrentPassword" value="">

            <label>New Password</label>
            <input type="password" class="form-control" name="NewPassword" value="">

            <label>Confirm Password</label>
            <input type="password" class="form-control" name="ConfirmPassword" value="">

            <div class="form-fav-cat">
                <h3>Favourite Categories</h3>
                <?php
                foreach($favCat as $cat) {
                    $checked = "";
                    if($cat['userId'] != null && $cat['userId'] == $_SESSION['UserId']) {
                        $checked = "checked";
                    }
                    echo "<input type='checkbox' class='form-check-input' name='favCat[]' value='".$cat['catId']."' $checked>";
                    echo "<label class='form-check-label' for='favCat[]'>".$cat['catName']."</label><br>";
                }
                ?>
            </div>
        </div>
        <button type="submit" class="btn btn-success" name="save">Save</button>
        <p class="text-danger"><?= $Err ?? ''; ?></p>
        <p class="text-success"><?= $Msg ?? ''; ?></p>
    </form>

    <?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/includeJS.php');?>
</body>
</html>
