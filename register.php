<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./sources/style/bootstrap.min.css">
    <script src="./sources/style/bootstrap.bundle.min.js" defer></script>
    <script src="./ajax/forms.js" defer></script>
    <title>Insta Clone</title>
</head>

<body>
    <div class="d-flex flex-column" style="height:100vh">
        <header class="w-100">
            <?php
            $cookie_userName = '';
            if (isset($_COOKIE["userFname"])) {
                # code...
                require_once('./components/navBar.php');
                echo "<script>location.replace('./');</script>";
            } else {
                # code...
                require_once('./components/navBar.php');
            }
            ?>
        </header>
        <main class="w-100 d-flex justify-content-center p-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">
                                <form method="POST" id="formPost"
                                    onsubmit="formPOST(event, 'formPost', 'agents/registerHandle.php')">


                                    <div class="form-group row">
                                        <label for="fname" class="col-md-4 col-form-label text-md-right">First
                                            Name:</label>

                                        <div class="col-md-6">
                                            <input id="fname" type="text"
                                                class="form-control <?php if (isset($error['fname'])) echo 'is-invalid'; ?> "
                                                name="fname" required autofocus>

                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!-- @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname" class="col-md-4 col-form-label text-md-right">Last
                                            Name:</label>

                                        <div class="col-md-6">
                                            <input id="lname" type="text"
                                                class="form-control <?php if (isset($error['lname'])) echo 'is-invalid'; ?> "
                                                name="lname" required>

                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!-- @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="username"
                                            class="col-md-4 col-form-label text-md-right">Username:</label>

                                        <div class="col-md-6">
                                            <input id="username" type="text"
                                                class="form-control <?php if (isset($error['username'])) echo 'is-invalid'; ?> "
                                                name="username" required>

                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!-- @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" placeholder="example@mail.com"
                                                class="form-control <?php if (isset($error['email'])) echo 'is-invalid'; ?> "
                                                name="email" required>

                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!-- @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">Password:</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control <?php if (isset($error['password'])) echo 'is-invalid'; ?>"
                                                name="password" required>

                                            <!-- @error('password') -->
                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!--  @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="confirmPassword"
                                            class="col-md-4 col-form-label text-md-right">Confirm Password:</label>

                                        <div class="col-md-6">
                                            <input id="confirmPassword"
                                                oninput="passwrdConfirm('password', 'confirmPassword')" type="password"
                                                class="form-control" name="confirmPassword" required>

                                            <!-- @error('password') -->
                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!--  @enderror -->
                                        </div>
                                    </div>



                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>