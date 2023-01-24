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
                            <div class="card-header">Login</div>

                            <div class="card-body">
                                <form method="POST" id="formLogin"
                                    onsubmit="formPOST(event, 'formLogin', 'agents/loginHandle.php')">


                                    <div class=" form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail
                                            Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                class="form-control <?php if (isset($error['email'])) echo 'is-invalid'; ?> "
                                                name="email" value="<?php ?>" required autocomplete="email" autofocus>

                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!-- @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password"
                                            class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                class="form-control <?php if (isset($error['password'])) echo 'is-invalid'; ?>"
                                                name="password" required autocomplete="current-password">

                                            <!-- @error('password') -->
                                            <?php ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php ?></strong>
                                            </span>
                                            <!--  @enderror -->
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember">

                                                <label class="form-check-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Login
                                            </button>

                                            <!-- @if (Route::has('password.request')) -->
                                            <?php ?>
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                'Forgot Your Password?
                                            </a>
                                            <!--  @endif -->
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