<!doctype html>

<html lang="en">
<head>

    <?php
    session_start();
    ob_start();
    include 'Shared/Header.html'
    ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" class="" href="../Assets/images/favicon.ico">


    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>Sign In</title>


</head>

<body class="body">

    <form method="post">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card px-5 py-5" id="form1">
                        <div class="form-data">
                            <a class="text-center mb-5" href="register_view.php">Don't have account yet? Register.</a>
                            <div class="forms-inputs mb-4"><input placeholder="Username" name="username" id="username"
                                                                  type="text">
                                <div class="invalid-feedback">A valid email is required!</div>
                            </div>
                            <div class="forms-inputs mb-4"><input placeholder="password" name="password" id="password"
                                                                  type="password">
                                <div class="invalid-feedback">Password must be 8 character!</div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-dark w-100" type="submit" name="signin">Sign in</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




<?php
if (isset($_POST['signin'])) {


    $username = $_POST['username'];
    $password = $_POST['password'];

    include '../../DAL/dbconnection.php';
    require_once '../Core/Session.php';
    global $db;

    $username = "'$username'";
    $password = "'$password'";
    $query = pg_query($db, 'SELECT * FROM "user" WHERE (name = ' . $username . 'AND password = crypt(' . $password . ', password));');
    $user = pg_fetch_array($query);
    if (!$user)
        echo '<script>alert("wrong username or password")</script>';
    else {
        $_SESSION['id'] = $user['id'];
        if (isset($_SESSION['page']))
            exit(header('Location:' . $_SESSION['page']));
        else exit(header('Location: main_view.php'));
    }


}
?>

</body>

<footer>
    <?php include 'shared/footer.html'; ?>
</footer>
</html>






