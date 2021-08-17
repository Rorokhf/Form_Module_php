<?php
session_start();
// if user dont have data 
if (empty($_SESSION)) {
    header('location:login.php');
}
// for update data
if ($_POST) {
    // to create msg in array
    $error = [];
    //if key true & there is value
    if (isset($_POST['name']) && $_POST['name']) {
        // change name in session of name 
        $_SESSION['user'][0]['name'] = $_POST['name'];
    } else {
        $error['name'] = "<div class='alert alert-danger'>name is require   </div>";
    }

    if (isset($_POST['email']) && $_POST['email']) {
        $_SESSION['user'][0]['email'] = $_POST['email'];
    } else {
        $error['email'] = "<div class='alert alert-danger'> email is require   </div>";
    }

    if (isset($_POST['gender']) && $_POST['gender']) {
        $_SESSION['user'][0]['gender'] = $_POST['gender'];
    } else {
        $error['email'] = "<div class='alert alert-danger'> gender is require   </div>";
    }
    ////////////////////////////////////////////////////////
    if ($_FILES['image']['error'] == 0) {
        //print_r($_FILES);die;
        $imgError = [];
        //validate on size
        if ($_FILES['image']['size'] > (10 ** 6)) {
            $imgError['size'] = "<div alert alert-danger> imger must be less than 1Mb </div>";
        }
        //get file extention
        $extentions = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        //create array for all extentions
        $allowExtentions = ['png', 'jpg', 'jpeg'];
        //check if extention not there in array 
        if (!in_array($extentions, $allowExtentions)) {
            $imgError['extention'] = "<div alert alert-danger> imger must be png jpg jpeg </div>";
        }
        if (empty($imgError)) {
            // coe to upload image in server 
            // use function time() to make image's name is unique 
            $imgPath='images/';
            //generate new name oh image => 123345-userId-1.png
            $imgName=time().'-userId-'. $_SESSION['user']['0']['id'] . '.' . $extentions;
           // image/123345-userId-1.png
            $fullPath=$imgPath.$imgName;
            //upload image
            move_uploaded_file($_FILES['image']['tmp_name'],$fullPath);
            //save image in session 
            $_SESSION['user']['0']['image']=$imgName;
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php include_once 'nav.php'; ?>


    <div class='container'>
        <!-- enctype="multipart/form-data" => for prepare own form to upload data 
    when send file it will go save into super global --> <!--$_FILES -->
        <form method="POST" enctype="multipart/form-data">
            <h1 class="col-12">Profile</h1>
            <div class="row m-5 ">

                <div class="col-4">
                    <img src="images/<?php echo $_SESSION['user'][0]['image']; ?>" width="100%">
                    <input type="file" name="image"><br>
                    <?php if (isset($imgError)) {
                        foreach ($imgError as $key => $value) {
                            echo $value;
                        }
                    } ?>
                </div>

                <div class="col-12">
                    <label for="inputEmail4" class="form-label">name</label>
                    <input class="form-control" id="inputEmail4" name="name" value="<?php echo $_SESSION['user'][0]['name']; ?>">
                    <?php if (isset($error['name'])) {
                        echo $error['name'];
                    } ?>
                </div>
                <br>
                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $_SESSION['user'][0]['email']; ?>">
                    <?php if (isset($error['email'])) {
                        echo $error['email'];
                    } ?>
                </div>
                <br class="mt-5 mb-5">
                <div class="col-md-12">
                    <label for="inputState" class="form-label">gender</label>
                    <select id="inputState" class="form-select" name="gender">
                        <option <?php if ($_SESSION['user'][0]['gender'] == 'm') {
                                    echo "selected";
                                } ?> value="m"> male</option>
                        <option <?php if ($_SESSION['user'][0]['gender'] == 'f') {
                                    echo "selected";
                                } ?> value="f"> female</option>
                    </select>
                    <?php if (isset($error['gender'])) {
                        echo $error['gender'];
                    } ?>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-dark">update</button>
                </div>




            </div>
        </form>
    </div>
    <br> <br> <br>
    <?php include_once "footer.php"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>