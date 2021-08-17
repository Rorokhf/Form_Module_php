<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto  ">
                <li class="nav-item dropdown ml-auto">
                    <?php
                    // if session have data
                    if ($_SESSION) {
                        // if true user login 

                    ?>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <a class="nav-link active" aria-current="page">
                                <?php echo $_SESSION['user'][0]['name']; ?>
                            </a>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="profile.php">profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="logout.php">logout</a>
                            </li>

                        </ul>
                    <?php // open php to contanue phph code 
                    } else {
                        // guest

                    ?>
                        <!-- stop php to put html -->


                        <ul class="navbar-nav me-auto me-2 me-lg-0">
                            <a class="nav-link active" aria-current="page">
                                welcome
                            </a>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="login.php">login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">register</a>
                            </li>

                        </ul>

                    <?php // open php to contanue phph code 

                    }
                    ?>
                </li>
            </ul>

        </div>
    </div>
</nav>