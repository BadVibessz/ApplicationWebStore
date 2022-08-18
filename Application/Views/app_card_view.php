<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once '../../DAL/dbconnection.php';

    if (isset($_GET['app']))
        $app_name = $_GET['app'];
    else $app_name = 'Paint';

    $app_name = "'$app_name'";


    global $db;

    $query = pg_query($db, "SELECT * FROM app WHERE name =" . $app_name);
    $app = pg_fetch_array($query);
    ?>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" class="" href="../Assets/images/favicon.ico">


        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
              rel="stylesheet">

        <title><?php echo $app['name'] ?></title>

        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="../Assets/css_phpjabbers/fontawesome.css">
        <link rel="stylesheet" href="../Assets/css_phpjabbers/style.css">
        <link rel="stylesheet" href="../Assets/css_phpjabbers/owl.css">

        <!-- Additional Scripts -->
        <script src="../Assets/js_phpjabbers/custom.js"></script>
        <script src="../Assets/js_phpjabbers/owl.js"></script>

        <?php include 'shared/header.html'; ?>
    </head>

<body class="body">

<!-- Page Content -->
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4 col-xs-12">
            <?php echo '
                <div>
                    <img src="../../../' . $app['cover'] . '" alt="" class="img-fluid wc-image" height="300px">
                </div>
                <br>   
            </div>

            <div class="col-md-8 col-xs-12">
                <form action="#" method="post" class="form">
                    <h2>' . $app['name'] . '</h2>

                    <br>

                    <p class="lead">
                        <small><del> $999.00</del></small><strong> FREE</strong>
                    </p>

                    <br>

                    <p class="lead">
                        ' . $app['description'] . '
                    </p>

                    <br>
                                <div class="col-sm-6">
                                    <a href="http://localhost:63342/ApplicationWebStore/Application/Views/got_view.php?app=' . $app['name'] . '" class="btn btn-primary btn-block pink-button">Get</a>
                                </div>
                                '; ?>
        </div>
    </div>
</div>
</form>


</body>

<footer><?php include 'shared/footer.html'; ?>'</footer>
</html>




