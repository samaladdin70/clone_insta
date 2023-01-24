<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../sources/style/bootstrap.min.css">
    <script src="../../sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="../../ajax/forms.js" defer></script>
    <title>Insta Clone</title>
</head>

<body>
    <div class="d-flex flex-column" style="height:100vh">
        <header class="w-100">
            <?php
            require_once('../../components/navBar.php');
            if (isset($_POST['logout'])) {
                setcookie("userFname", '', time() - 3600, '/');
                setcookie("userLname", '', time() - 3600, '/');
                setcookie("userName", '', time() - 3600, '/');
                setcookie("userId", '', time() - 3600, '/');
                echo "<script>location.replace('./');</script>";
            }
            ?>
        </header>
        <main class="w-100 d-flex justify-content-center 
            align-items-center p-5" style="flex-grow: 1; overflow-y:auto;">
            <?php
            if (!isset($_COOKIE['userFname'])) {
            ?>

            <?php
                require_once('../../components/404.php');
            } else {
                require_once('../../components/404.php');
                echo "<h3> &nbsp; Forbeden</h3>";
            }
            ?>
            <script>
            /* function for prevent right click on images */
            const contextMenu = (e) => {
                e.preventDefault();
            };
            </script>
        </main>
    </div>

</body>

</html>