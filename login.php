<?php
session_start();
// if there is data go to profile => for stop login when u are already have data
if ($_SESSION) {
    header('location:profile.php');
}
// data 
$users = [
    [
        'id' => 1,
        'name' => 'ahmed',
        'email' => 'ahmed@gmail.com',
        'password' => '123456',
        'image' => '1.png',
        'gender' => 'm'
    ],
    [
        'id' => 2,
        'name' => 'jude',
        'email' => 'jude@gmail.com',
        'password' => '123456',
        'image' => '2.png',
        'gender' => 'f'
    ],
    [
        'id' => 3,
        'name' => 'galal',
        'email' => 'galal@gmail.com',
        'password' => '123456',
        'image' => '3.png',
        'gender' => 'm'
    ]
];
// if chlick submit 
if ($_POST) {
    // print_r($_POST);die;

    // check email or password or send
    $error = [];
    if (empty($_POST['email'])) {
        $error['email'] = "<div class='alert alert-danger'>Email is requird </div>";
    }
    if (!$_POST['password']) {
        $error['password'] = "<div class='alert alert-danger'>password is requird</div>";
    }
    //////////////////////////////////////////////////////////
    // if no error => there is data 
    if (empty($error)) {
        //check email and password are true => there are in my data [users arrray ]
        function login($user)
        {
            return ($_POST['email'] == $user['email'] && $_POST['password'] == $user['password']);
        }
        // find user in array and send function to check
        $user = array_filter($users, 'login');
        //print_r($user);

        // if no user send div 
        if (empty($user)) {
            $error['wrong'] = "<div class='alert alert-danger'>your email or password is wrong</div>";
        } else {
            // if there user savs data in session and go to home page 
            $_SESSION['user'] = array_values($user); // conv assuatet array to index array 
            header('location:profile.php');
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <?php include_once "nav.php"; ?>

    <div class="container  row m-5">
        <div class="col-4 offset-4">

            <div class="col-12 text-center">
                <h1 class="h1text-dark"> Login </h1>
            </div>
            <form method="post" novalidate>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php if (isset($_POST['email'])) {
                                                                                                                                            echo $_POST['email'];
                                                                                                                                        } ?>">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    <?php if (isset($error['email'])) {
                        echo $error['email'];
                    } ?>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                    <?php if (isset($error['password'])) {
                        echo $error['password'];
                    } ?>
                </div>

                <button type="submit" class="btn btn-primary">LogIn</button>
                <br>
                <?php if (isset($error['wrong'])) {
                    echo $error['wrong'];
                } ?>
            </form>
        </div>
    </div>

    <?php include_once "footer.php" ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>