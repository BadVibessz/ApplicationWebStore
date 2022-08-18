<?php
session_start();

include '../../DAL/dbconnection.php';
include 'Shared/Header.html';
global $db;

if (!isset($_SESSION['id'])) {
    $_SESSION['page'] = 'account_view.php';
    exit(header('Location: sign_in_view.php'));
} else {
    $user = pg_fetch_array(pg_query($db, 'SELECT * FROM "user" WHERE id=' . $_SESSION['id']));
    $apps_ids = pg_fetch_all(pg_query($db, 'SELECT * FROM user_has_app WHERE user_id =' . $user['id']));
}


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

</head>

<body class="body">

    <?php echo '<h1 class="text-center">' . $user['name'] . '</h1>' ?>

    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Your Products</h2>
                    </div>
                </div>

                <?php
                foreach ($apps_ids as $app_id) {

                    $app = pg_fetch_array(pg_query($db, 'SELECT * FROM app WHERE id =' . $app_id['app_id']));
                    echo '
                        <div class="col-md-3">
                        <div class="product-item custom-height">
                        <a href = "http://localhost:63342/ApplicationWebStore/Application/Views/app_card_view.php?app='.$app['name'].'" >
                        <img src = "../../../' . $app['cover'] . '" alt = "" ></a>
                        <div class="down-content" >
                            <a href = "http://localhost:63342/ApplicationWebStore/Application/Views/app_card_view.php?app='.$app['name'].'" >
                            <h4 >' . $app['name'] . '</h4 ></a >
                        </h6 >
                        </div >
                    </div >
                </div >
                ';
                } ?>
            </div>
        </div>
    </div>

</body>

<footer>
    <?php include 'shared/footer.html'; ?>
</footer>
</html>










