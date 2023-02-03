<?php

$status = $_GET['status'];
$descriptiontab = $_GET['descriptiontab'];
$titlecolor = "#".$_GET['titlecolor'];
$background = "#".$_GET['background'];
$pdftitlecolor = "#".$_GET['pdftitlecolor'];

$margintop = $_GET['margintop'];
$marginbottom = $_GET['marginbottom'];
$paddingtop = $_GET['paddingtop'];
$paddingbottom = $_GET['paddingbottom'];
$fontsizetitle = $_GET['fontsizetitle'];
$fontsizepdftitle = $_GET['fontsizepdftitle'];

$title = $_GET['title'];
$icon = $_GET['icon'];

include '../../../wp-load.php';
$plugin_url = plugin_dir_url( __FILE__ );
$jsonurl = $plugin_url . 'json/db.json';
$jsonfile = file_get_contents($jsonurl);
$json = json_decode($jsonfile, true);

$json['inquire']['margintop'] = $margintop;
$json['inquire']['marginbottom'] = $marginbottom;
$json['inquire']['paddingtop'] = $paddingtop;
$json['inquire']['paddingbottom'] = $paddingbottom;
$json['inquire']['fontsizetitle'] = $fontsizetitle;
$json['inquire']['fontsizepdftitle'] = $fontsizepdftitle;
$json['inquire']['pdftitlecolor'] = $pdftitlecolor;

$json['inquire']['status'] = $status;
$json['inquire']['descriptiontab'] = $descriptiontab;
$json['inquire']['title'] = $title;
$json['inquire']['titlecolor'] = $titlecolor;
$json['inquire']['background'] = $background;
$json['inquire']['icon'] = $icon;
$json_object = json_encode($json, true);
$file = WP_PLUGIN_DIR . '/bm_woocommerce_pdf/json/db.json';
file_put_contents($file, $json_object);

?>