<?php
session_start();
if(!isset($_SESSION['id']))
{
    $_SESSION['page'] = 'developer_tools_view.php';
    header('Location: sign_in_view.php');

}
else
{
    echo 'developer tools page';
}