<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../sources/style/bootstrap.min.css">
    <script src="../sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="../ajax/forms.js" defer></script>
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
        if (!isset($_COOKIE['userFname'])) {
        ?>
        <main class="w-100 d-flex justify-content-center 
            align-items-center p-5" style="flex-grow: 1; overflow-y:auto;">
            <?php
            require_once('../components/404.php');
        } else {
            ?>
            <?php require_once('../agents/selectFromProfile.php'); ?>
            <main class="w-100 d-flex justify-content-center p-5" style="flex-grow: 1; overflow-y:auto;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Edit Profile</div>

                                <div class="card-body">
                                    <form method="POST" action="../agents/editProfileHandle.php"
                                        enctype="multipart/form-data">


                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">Title:
                                            </label>

                                            <div class="col-md-6">
                                                <input id="title" type="text"
                                                    value="<?php echo $checkProfile[0]['title'] ?>"
                                                    class="form-control <?php if (isset($error['title'])) echo 'is-invalid'; ?> "
                                                    name="title" autofocus>

                                                <?php ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php ?></strong>
                                                </span>
                                                <!-- @enderror -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-md-4 col-form-label text-md-right">
                                                Description:</label>

                                            <div class="col-md-6">
                                                <input id="description" type="text"
                                                    value="<?php echo $checkProfile[0]['description'] ?>"
                                                    class=" form-control <?php if (isset($error['description'])) echo 'is-invalid'; ?> "
                                                    name=" description">

                                                <?php ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php ?></strong>
                                                </span>
                                                <!-- @enderror -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="url" class="col-md-4 col-form-label text-md-right">url:</label>

                                            <div class="col-md-6">
                                                <input id="url" type="text"
                                                    value="<?php echo $checkProfile[0]['url'] ?>"
                                                    class="form-control <?php if (isset($error['url'])) echo 'is-invalid'; ?> "
                                                    name="url">

                                                <?php ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php ?></strong>
                                                </span>
                                                <!-- @enderror -->
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="img" class="col-md-4 col-form-label text-md-right">img:</label>

                                            <div class="col-md-6">
                                                <input id="img" type="file"
                                                    class="form-control <?php if (isset($error['img'])) echo 'is-invalid'; ?> "
                                                    name="img" accept="image/*">

                                                <?php ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php ?></strong>
                                                </span>
                                                <!-- @enderror -->
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-8 offset-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-primary" name="confirm">
                                                    Confirm
                                                </button>
                                                <a href="./" class="ml-4" style="text-decoration: none;">Back
                                                    to profile</a>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
                ?>
            </main>
    </div>

</body>

</html>