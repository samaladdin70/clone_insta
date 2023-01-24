<?php
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sources/style/bootstrap.min.css">
    <link rel="stylesheet" href="../sources/style/style.css">
    <link rel="stylesheet" href="../sources/style/fontAwesome/css/fontawesome.min.css">
    <script src="../sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="../js/app.js" defer></script>
    <script src="../ajax/fetch.js" defer></script>
    <title>Insta Clone</title>
</head>

<body>
    <div class="d-flex flex-column" style="height:100vh">
        <header class="w-100">
            <?php
            require_once('../components/navBar.php');

            if (isset($_POST['logout'])) {
                setcookie("userFname", '', time() - 3600, '/');
                setcookie("userLname", '', time() - 3600, '/');
                setcookie("userName", '', time() - 3600, '/');
                setcookie("userId", '', time() - 3600, '/');
                echo "<script>location.replace('../');</script>";
            }
            ?>
        </header>


        <?php
        if (isset($_GET['uname'])) {
            /* view any profile */
            if (!isset($_COOKIE['userFname'])) {
        ?>
        <main class="w-100 d-flex justify-content-center 
            align-items-center p-5" style="flex-grow: 1; overflow-y:auto;">
            <?php
                require_once('../components/404.php');
            } else {
                require_once('../agents/selectFromProfiles.php'); ?>
            <main class="d-flex justify-content-center w-100  
            align-items-start p-5" style="flex-grow: 1; overflow-y:auto; flex-wrap:wrap;">

                <div class="row w-75">
                    <div class="col-md-4 d-flex justify-content-md-center align-items-lg-start">
                        <img src="<?php if ($checkProfile[0]['img'] != null || $checkProfile[0]['img'] != "") {
                                                if (file_exists($checkProfile[0]['img'])) {
                                                    echo $checkProfile[0]['img'];
                                                } else {
                                                    echo "img/img_avatar.png";
                                                }
                                            } else {
                                                echo "img/img_avatar.png";
                                            }
                                            ?>" alt="prof" style="width:150px; height:150px;" class="rounded-circle"
                            id="profImg" oncontextmenu="contextMenu(event);">

                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center justify-content-between flex-wrap"
                                style="font-size: 22px;">
                                <div class="d-flex align-items-end">
                                    <?php
                                            echo "<span class='mr-4'>" . $checkProfile[0]['Fname'] . " " . $checkProfile[0]['Lname'] . "</span>";
                                            ?>


                                    <button type="button" class="btn btn-primary mr-5"
                                        style="width:100px; box-shadow:none;" id="follow"
                                        onclick="follows('follow', <?php echo $checkProfile[0]['profile_user_id'] ?>);"><?php require_once('../agents/followsHandle.php'); ?></button>
                                </div>

                                <?php
                                        /* check if profile for auth user */
                                        if ($_COOKIE['userName'] == $checkProfile[0]['Uname']) {

                                        ?>
                                <div>
                                    <a href="../posts/create.php" style="font-size: 1rem; text-decoration: none;">Add
                                        Post</a>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="editProfile.php" style="text-decoration: none;">Edit Profile</a>
                            </div>

                        </div>
                        <?php
                                        } else {
                                            echo '</div></div>';
                                        }

                            ?>


                        <?php require_once('../agents/selectCountPosts.php'); ?>
                        <div class="row mt-2 d-flex">
                            <div class="col-3"><b><?php echo $countPosts[0]['counts']; ?></b> posts</div>
                            <div class="col-3"><b>103k</b> followers</div>
                            <div class="col-3"><b>356</b> following</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 d-flex justify-content-md-end"><b>Titel:</b></div>
                            <div class="col-md-7 d-flex"><?php echo $checkProfile[0]['title'] ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 d-flex justify-content-md-end"><b>Description:</b></div>
                            <div class="col-md-7"><?php echo $checkProfile[0]['description'] ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-2 d-flex justify-content-md-end"><b>Url:</b></div>
                            <div class="col-md-7"><i><a
                                        href="<?php echo $checkProfile[0]['url'] ?>"><?php echo $checkProfile[0]['url'] ?></a></i>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                        /* Photos products section */
                        require_once('../agents/selectFromPost.php');
                        echo '<div class="pt-2 mt-5 row w-75" style="border-top:1px solid grey; height:45vh; overflow-y:auto;">';

                        if (isset($checkPost)) {
                            foreach ($checkPost as $key => $value) {
                                echo '<div class="col-md-4 col-sm-6 p-2">
                        <a href="../posts/?img=' . $value['id'] . '">
                            <img oncontextmenu="contextMenu(event);" src="' . $value['image'] . '" class="w-100">
                        </a>
                    </div>';
                            }
                        }
                        echo '</div>';
                    }
                } else {
                    /* view my own profile */
                    if (!isset($_COOKIE['userFname'])) {
                        ?>
                <main class="w-100 d-flex justify-content-center 
            align-items-center p-5" style="flex-grow: 1; overflow-y:auto;">
                    <?php
                        require_once('../components/404.php');
                    } else {
                        require_once('../agents/selectFromProfile.php'); ?>
                    <main class="d-flex justify-content-center w-100  
            align-items-start p-5" style="flex-grow: 1; overflow-y:auto; flex-wrap:wrap;">

                        <div class="row w-75">
                            <div class="col-md-4 d-flex justify-content-md-center align-items-lg-start">
                                <img src="<?php if ($checkProfile[0]['img'] != null || $checkProfile[0]['img'] != "") {
                                                        if (file_exists($checkProfile[0]['img'])) {
                                                            echo $checkProfile[0]['img'];
                                                        } else {
                                                            echo "img/img_avatar.png";
                                                        }
                                                    } else {
                                                        echo "img/img_avatar.png";
                                                    }
                                                    ?>" alt="prof" style="width:150px; height:150px;"
                                    class="rounded-circle" id="profImg" oncontextmenu="contextMenu(event);">

                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-8 d-flex align-items-center justify-content-between flex-wrap"
                                        style="font-size: 22px;">
                                        <div class="d-flex align-items-end">
                                            <?php
                                                    echo "<span class='mr-4'>$_COOKIE[userFname] $_COOKIE[userLname]</span>";
                                                    ?>

                                            <button type="button" class="btn btn-primary mr-5"
                                                style="width:100px; box-shadow:none;" id="follow"
                                                onclick="follows('follow', <?php echo $checkProfile[0]['profile_user_id'] ?>);"><?php require_once('../agents/followsHandle.php'); ?></button>
                                        </div>
                                        <div>
                                            <a href="../posts/create.php"
                                                style="font-size: 1rem; text-decoration: none;">Add
                                                Post</a>
                                        </div>


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="editProfile.php" style="text-decoration: none;">Edit Profile</a>
                                    </div>

                                </div>
                                <?php require_once('../agents/selectCountPosts.php'); ?>
                                <div class="row mt-2 d-flex">
                                    <div class="col-3"><b><?php echo $countPosts[0]['counts']; ?></b> posts</div>
                                    <div class="col-3"><b>103k</b> followers</div>
                                    <div class="col-3"><b>356</b> following</div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-2 d-flex justify-content-md-end"><b>Titel:</b></div>
                                    <div class="col-md-7 d-flex"><?php echo $checkProfile[0]['title'] ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-2 d-flex justify-content-md-end"><b>Description:</b></div>
                                    <div class="col-md-7"><?php echo $checkProfile[0]['description'] ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-2 d-flex justify-content-md-end"><b>Url:</b></div>
                                    <div class="col-md-7"><i><a
                                                href="<?php echo $checkProfile[0]['url'] ?>"><?php echo $checkProfile[0]['url'] ?></a></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                            /* Photos products section */
                            require_once('../agents/selectFromPost.php');
                            echo '<div class="pt-2 mt-5 row w-75" style="border-top:1px solid grey; height:45vh; overflow-y:auto;">';

                            if (isset($checkPost)) {
                                foreach ($checkPost as $key => $value) {
                                    echo '<div class="col-md-4 col-sm-6 p-2">
                        <a href="../posts/?img=' . $value['id'] . '">
                            <img oncontextmenu="contextMenu(event);" src="' . $value['image'] . '" class="w-100">
                        </a>
                    </div>';
                                }
                            }
                            echo '</div>';
                        }
                            ?>


                    </main>
    </div>

    <?php
                }
?>

</body>

</html>