<?php
$title = $_GET['pdftitle'];
$subtitle = $_GET['pdfsubtitle'];
$url = $_GET['pdfurl'];
$imageurl = $_GET['imageurl'];
$id = $_GET['pdfid'];
include '../../../wp-load.php';
$new_post = array(
    'post_title' => $id,
    'post_status'   => 'publish',
    'post_type'     => 'pruduct-pdf'
);
$postId = wp_insert_post($new_post);
add_post_meta( $postId, 'pdf_image_url', $imageurl, true );
add_post_meta( $postId, 'pdf_title', $title, true );
add_post_meta( $postId, 'pdf_subtitle', $subtitle, true );
add_post_meta( $postId, 'pdf_url', $url, true );
echo $postId;
?>