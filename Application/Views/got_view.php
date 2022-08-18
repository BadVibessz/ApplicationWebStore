<?php
session_start();
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" class="" href="../Assets/images/favicon.ico">


    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>Apps</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../Assets/css_phpjabbers/fontawesome.css">
    <link rel="stylesheet" href="../Assets/css_phpjabbers/style.css">
    <link rel="stylesheet" href="../Assets/css_phpjabbers/owl.css">

    <!-- Additional Scripts -->
    <script src="../Assets/js_phpjabbers/custom.js"></script>
    <script src="../Assets/js_phpjabbers/owl.js"></script>


    <?php
    include 'shared/header.html';
    include '../../DAL/dbconnection.php';

    if (isset($_GET['app']))
        $app_name = $_GET['app'];
    else $app_name = 'Paint';

    if (!isset($_SESSION['id'])) {
        $_SESSION['page'] = 'app_card_view.php?app=' . $app_name;
        header('Location: sign_in_view.php');
    }

    $app_name = "'$app_name'";

    global $db;

    $query = pg_query($db, "SELECT * FROM app WHERE name =" . $app_name);
    $app = pg_fetch_array($query);

    if (!pg_num_rows(pg_query($db, 'SELECT * FROM user_has_app WHERE (user_id = ' . $_SESSION['id'] . ' AND app_id =' . $app['id'] . ')')))
        $query = pg_query($db, 'INSERT INTO user_has_app (user_id, app_id) VALUES (' . $_SESSION['id'] . ',' . $app['id'] . ')');

    ?>


</head>

<body class="body">


<h5 class="text-center">Thank you for using our products!</h5>

<div class="text-center">
    <?php echo
        '<a href="http://localhost:63342/ApplicationWebStore/Application/Views/download.php?app=' . $app['name'] . '"
           class="btn btn-primary btn-block pink-button button ">Download</a>'
    ?>
</div>

</body>

<footer>
    <?php include 'shared/footer.html'; ?>
</footer>
</html>






