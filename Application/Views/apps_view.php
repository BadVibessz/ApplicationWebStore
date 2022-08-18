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
    ?>

    <?php


    global $db;
    $apps = pg_fetch_all(pg_query($db, "SELECT * FROM app"));

    $count = count($apps);

    $per_page = 2;
    $total_pages = ceil($count / $per_page);

    if (isset($_GET['page']) && is_numeric($_GET['page']) && abs($_GET['page']) <=$total_pages  && $_GET['page'] != 0)
        $page = $_GET['page'];
    else $page = 1;

    $offset = ($page - 1) * $per_page;


    $query = pg_query($db, 'SELECT * FROM app LIMIT ' . $per_page . ' OFFSET ' . $offset);
    ?>


</head>

<body class="body">


    <div class="products">
        <div class="container">
            <div class="row">
                <?php
                while ($row = pg_fetch_array($query)) {
                    echo
                        '<div class="col-md-6">
                        <div class="product-item mt-5 ">
                            <a href="http://localhost:63342/ApplicationWebStore/Application/Views/app_card_view.php?app=' . $row['name'] . '">
                            <img src="../../../' . $row['cover'] . '" alt="" height="70%">
                            </a>
                            <div class="down-content">
                                <a href="http://localhost:63342/ApplicationWebStore/Application/Views/app_card_view.php?app=' . $row['name'] . '">
                                    <h4>' .
                        $row['name'] .
                        '</h4>
                                </a>
                                <h6><small>
                                        <del>$999.00</del>
                                    </small> FREE
                                </h6>
                                <p>' . $row['description'] . '</p>
                            </div>
                        </div>
                    </div>';

                } ?>

                <div class="col-md-12">
                    <ul class="pages">

                        <?php
                        if ($page != 1) {
                            echo "<li><a href='apps_view.php?page=1'>First</a></li>";
                            echo "<li><a href='apps_view.php?page=" . ($page - 1) . "'>i--</a></li>";
                        }
                        ?>

                        <li class="active"><a href="#"><?php echo($page); ?></a></li>

                        <?php
                        if ($page != $total_pages) {
                            echo "<li><a href='apps_view.php?page=" . ($page + 1) . "'>i++</a></li>";
                            echo "<li><a href='apps_view.php?page=" . $total_pages . "'>Last</a></li>";
                        }
                        ?>

                        <?php echo "<p size='17px' class='mt-2 down-content'>Page " . $page . " of " . $total_pages . "</p>" ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</body>

<footer>
    <?php include 'shared/footer.html'; ?>
</footer>
</html>






