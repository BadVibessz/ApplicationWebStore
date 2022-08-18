<?php
include '../../DAL/dbconnection.php';

ini_set("zlib.output_compression", "off");

if (isset($_GET['app']))
    $app_name = $_GET['app'];
else $app_name = 'Paint';

$app_name = "'$app_name'";


global $db;

$query = pg_query($db, "SELECT * FROM app WHERE name =" . $app_name);
$app = pg_fetch_array($query);

echo $app_name;


// your file to download
$file = '../../../' . $app['link'] . '/' . $app['name'] . '.zip';
//$file = 'C:\Users\danil\PhpstormProjects/'. $app['link'] .$app['name'] . '.zip';

echo '<script language="javascript">';
echo 'alert("'.$file.'")';
echo '</script>';

//ob_start();

header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$ext = pathinfo($file, PATHINFO_EXTENSION);
$basename = pathinfo($file, PATHINFO_BASENAME);

header("Content-type: application/" . $ext);
// tell file size
header('Content-length: ' . filesize($file));
// set file name
header("Content-Disposition: attachment; filename=\"$basename\"");

//while (ob_get_level())
//    ob_end_clean();


readfile($file);
// Exit script. So that no useless data is output-ed.
exit;











