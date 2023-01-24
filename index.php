<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./sources/style/bootstrap.min.css">
    <link rel="stylesheet" href="./sources/style/style.css">
    <link rel="stylesheet" href="./sources/style/fontAwesome/css/fontawesome.min.css">
    <link rel="shortcut icon" href="./NicePng_instagram-png_12860.png" type="image/x-icon">
    <script src="./sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="./js/app.js" defer></script>
    <title>Insta Clone</title>
</head>

<body>
    <div class="d-flex flex-column" style="height:100vh">
        <header class="w-100">
            <?php
            require_once('./components/navBar.php');
            if (isset($_POST['logout'])) {
                setcookie("userFname", '', time() - 3600, '/');
                setcookie("userLname", '', time() - 3600, '/');
                setcookie("userName", '', time() - 3600, '/');
                setcookie("userId", '', time() - 3600, '/');
                echo "<script>location.replace('./');</script>";
            }
            ?>
        </header>
        <main class="w-100 d-flex justify-content-center pt-5 pr-3 pl-3 flex-column flex-grow-1"
            style="overflow-y: auto;">
            <!-- <div class="row d-flex pr-4 justify-content-end top-right">
                <a href="./profiles">Profile</a>
            </div> -->
            <?php
            require_once('agents/homeHandle.php');
            if (!empty($getFollowed)) {
                require_once('./components/main.php');
            ?>
            <div class="row d-flex flex-wrap p-2" style="overflow-y:auto;">
                <?php
                foreach ($getFollowed as $key => $value) {
                    $newPath = str_replace('..', '.', $value["image"]);
                    if (isset($value['img'])) {
                        $newIconPath = str_replace('..', '.', $value['img']);
                    } else {
                        $newIconPath = "./profiles/img/img_avatar.png";
                    }
                    echo '
        <div class="col-md-4 col-sm-6 p-2">
            <div class="d-flex align-items-center">
                
                <h6><a style="text-decoration:none;" href="./profiles/?uname=' . $value["Uname"] . '"><img oncontextmenu="contextMenu(event);" src="' . $newIconPath . '" style="width:30px; height:30px; border-radius:50%;"> ' . $value["Uname"] . '</a></h6>
            </div>
            <a href="./posts/?img=' . $value['id'] . '">
                <img oncontextmenu="contextMenu(event);" src="' . $newPath . '" class="w-100">
            </a>
            <div class="d-flex align-items-center">
            <h6>' . $value["caption"] . '</h6>
            </div>
        </div>';
                }
                echo "</div>";
            } else {
                require_once('./components/mainEmpty.php');
            }
                ?>

        </main>
    </div>

</body>

</html>