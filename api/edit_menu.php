<?php
header('Location: http://172.16.16.7/team1/', true, 301);

$link = pg_connect("host=localhost dbname=team1db user=team1 password=1qazxsw2");
if (!$link) {
    print('接続失敗');
    exit;
}

if(!isset($_GET["name"])){
    echo '名前がありません';
    exit;
}
if(!isset($_GET['price'])){
    echo '値段がありません';
    exit;
}
if(!isset($_GET['id'])){
    echo 'idがありません';
    exit;
}

if(isset($_GET['sold_on'])){
    $sql = 'update menus set sold_on=\'' . $_GET['sold_on'] . '\' where menu_id=' .$_GET['id'];
}

$result = pg_query($link,$sql);
echo $result;

$product_query = array();

$product_query[] = "'" . $_GET['name'] ."'" ;
$product_query[] = $_GET['price'];

if(isset($_GET["energy"])){
    $product_query[] = $_GET['energy'];
} else {
    $product_query[] = 'null';
}

if(isset($_GET["protein"])){
    $product_query[] = $_GET['protein'];
} else {
    $product_query[] = 'null';
}
if(isset($_GET["lipid"])){
    $product_query[] = $_GET['lipid'];
} else {
    $product_query[] = 'null';
}
if(isset($_GET["salt"])){
    $product_query[] = $_GET['salt'];
} else {
    $product_query[] = 'null';
}

$sql = 'update products set (name,price,energy,protein,lipid,salt)=(' . join(',' , $product_query) . ') from menus where products.product_id=menus.product_id and menus.menu_id=' . $_GET['id'];
echo $sql;
$result = pg_query($link,$sql);
echo $result;


pg_close($link);
?>
