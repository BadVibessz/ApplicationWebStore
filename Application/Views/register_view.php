<!doctype html>

<html lang="en">
<head>

    <?php
    session_start();
    ob_start();
    include 'Shared/Header.html' ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" class="" href="../Assets/images/favicon.ico">


    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>Register</title>


</head>

<body class="body">


    <form method="post">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="card px-5 py-5" id="form1">
                        <div class="form-data">
                            <div class="forms-inputs mb-4"><input placeholder="Username" name="username"
                                                                  type="text"></div>
                            <div class="forms-inputs mb-4"><input placeholder="Year of birth" name="yearofbirth"
                                                                  type="number"></div>
                            <div class="forms-inputs mb-4"><input placeholder="Password" name="password"
                                                                  type="password"></div>
                            <div class="forms-inputs mb-4"><input placeholder="Confirm password" name="confpassword"
                                                                  type="password"></div>
                            <select class="form-control mb-4" name="isdeveloper">
                                <span>Are you developer?</span>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <div class="mb-3">
                                <button class="btn btn-dark w-100" type="submit" name="register">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




<?php

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confpass = $_POST['confpassword'];
    $year_of_birth = $_POST['yearofbirth'];
    $is_developer = $_POST['isdeveloper'];

    if ($password != $confpass)
        echo '<script>alert("Wrong confirming password")</script>';


    include '../../DAL/dbconnection.php';
    global $db;

    $username = "'$username'";
    $password = "'$password'";
    $password = "crypt(" . $password . ",gen_salt('bf'))";
    $is_developer = "'$is_developer'";

    if (pg_num_rows(pg_query($db, 'SELECT * FROM "user" WHERE name =' . $username)))
        echo '<script>alert("This username is taken")</script>';
    else {
        $query = pg_query($db, 'INSERT INTO "user" (name, password, year_of_birth, is_developer)VALUES (' . $username . ',' . $password . ',' . $year_of_birth . ',' . $is_developer . ')');

        $result = pg_fetch_array($query);


        $_SESSION['id'] = pg_query($db, 'SELECT id FROM "user" WHERE name = ' . $username);

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






