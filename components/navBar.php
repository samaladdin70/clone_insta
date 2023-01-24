<nav class="navbar navbar-expand-md navbar-light  bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href='http://localhost/myphp/insta1/'>
            <!-- <i class="fa-solid fa-house-chimney"></i> -->
            <!-- or class="fa fa-home"  -->
            <i class="fa-solid fa-house-chimney text-secondary "></i>
            <spane class="text-secondary">Home</spane>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav ml-auto">
                <?php
                if (isset($_COOKIE["userFname"])) {
                ?>

                <li class="nav-item" style="height:10px;">
                    <!-- for adjust next search when minimize -->
                </li>

                <li class="nav-item mr-4 d-flex align-items-center">
                    <!-- <input class="form-control"
                        style="box-shadow: none;font-family: 'Helvetica', FontAwesome, sans-serif;" type="search"
                        name="search" id="search" placeholder="&#xf002 Search . . ."> -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="&#xf002 Search . . ."
                            aria-label="Search"
                            style="box-shadow: none;font-family: 'Helvetica', FontAwesome, sans-serif;" type="search"
                            name="search" id="search">
                        <button class="btn btn-outline-success ml-1" type="submit">Search</button>
                    </form>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_COOKIE["userName"]; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li>
                            <form method="POST">
                                <button name="logout" type="submit" class="dropdown-item">Logout</button>
                            </form>

                        </li>
                    </ul>
                </li>

                <?php
                } else {
                ?>

                <li class="nav-item"><a class="nav-link" href="<?php if (file_exists('./login.php')) {
                                                                        echo './login.php';
                                                                    } else {
                                                                        echo '../login.php';
                                                                    }
                                                                    ?>">Login</a></li>

                <li class="nav-item"><a class="nav-link" href="<?php if (file_exists('./register.php')) {
                                                                        echo './register.php';
                                                                    } else {
                                                                        echo '../register.php';
                                                                    }
                                                                    ?>">Register</a></li>

                <?php
                }
                ?>

            </ul>

        </div>
    </div>
</nav>