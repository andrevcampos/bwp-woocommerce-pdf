<?php

/*
Plugin Name: BM_Woo_PDF
Plugin URI: https://breezemarketing.co.nz
Description: Woocommerce Product PDF
Version: 1.0
Author URI: https://breezemarketing.co.nz
Author: Andre Campos
Text Domain: bm-woo-pdf
*/ 


// Add Announcement button to wordpress admin menu.
add_action('admin_menu', 'my_menu_pages_query_pdf');
function my_menu_pages_query_pdf(){
    add_menu_page('Product PDF', 'Product PDF', 'manage_options', 'my-menu-pdf', 'my_menu_query_output_pdf', null, 7 );
}

function myplugin_add_meta_box() {

    $screens = array( 'post', 'page' );
    
    foreach ( $screens as $screen ) {
    
        add_meta_box('metabpx_pdf','PDF','wk_custom_tab_data_dpf',$screen);
    }
} 
add_action( 'add_meta_boxes', 'myplugin_add_meta_box', 1);

// What is showing on Annoucement menu on wordpress admin menu.
function my_menu_query_output_pdf() {

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'css', $plugin_url . 'css/admin.css' );
	wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );
	
	$jsonurledit = $plugin_url . 'bm-inquire-json.php';
	
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $title = $json['inquire']['title'];
    $titlecolor = $json['inquire']['titlecolor'];
    $pdftitlecolor = $json['inquire']['pdftitlecolor'];
    $background = $json['inquire']['background'];
    $pdficon = $json['inquire']['icon'];
    $descriptiontab = $json['inquire']['descriptiontab'];

    $margintop = $json['inquire']['margintop'];
    $marginbottom = $json['inquire']['marginbottom'];
    $paddingtop = $json['inquire']['paddingtop'];
    $paddingbottom = $json['inquire']['paddingbottom'];
    $fontsizepdftitle = $json['inquire']['fontsizepdftitle'];
    $fontsizetitle = $json['inquire']['fontsizetitle'];

    if($status == "true"){
        $statusdisplay = "block";
    }else{
        $statusdisplay = "none";   
    }
    
	echo '<div class="wrap">';
        echo '<h2>Product PDF</h2>';
	echo '</div><br>';
	
	echo '<label class="switch">';
        if($status == "true"){
            echo '<input id="status" onclick="myFunction()" type="checkbox" checked>';
        }else{
            echo '<input id="status" onclick="myFunction()" type="checkbox">';
        }
        echo '<span class="slider round"></span>';
    echo '</label><br><br>';
    
    echo "<div id='announcementplugininformation' class='wrap' style='display:$statusdisplay'>";
    
        echo '<div class="wrap">';
            echo '<h3>Display</h3>';
    	echo '</div>';
        
        if($descriptiontab == "true"){
            echo '<input type="checkbox" id="descriptiontab" name="descriptiontab" checked>';
        }else{
            echo '<input type="checkbox" id="descriptiontab" name="descriptiontab">';
        }
        echo '<label for="descriptiontab">Show on Description Tab</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>Title</h3>';
    	echo '</div>';

        echo "<input type='text' id='title' name='title' value='$title'><br><br>";

        echo '<div class="wrap">';
            echo '<h3>Shortcode</h3>';
    	echo '</div>';

        echo "<div>Post the shortcode anywhere on the product page. <br> [bm_woo_pdf]</div><br>";

        echo "<input type='number' id='margintop' name='margintop' value='$margintop'>";
        echo '<label for="margintop"> Margin Top</label><br><br>';

        echo "<input type='number' id='marginbottom' name='marginbottom' value='$marginbottom'>";
        echo '<label for="marginbottom"> Margin Bottom</label><br><br>';

        echo "<input type='number' id='paddingtop' name='paddingtop' value='$paddingtop'>";
        echo '<label for="paddingtop"> Paddingn Top</label><br><br>';

        echo "<input type='number' id='paddingbottom' name='paddingbottom' value='$paddingbottom'>";
        echo '<label for="paddingbottom"> Paddingn Bottom</label><br><br>';


        echo '<div class="wrap">';
        echo '<h3>Font-Size</h3>';
        echo '</div>';

        echo "<input type='number' id='fontsizetitle' name='fontsizetitle' value='$fontsizetitle'>";
        echo '<label for="fontsizetitle"> Box Title</label><br><br>';

        echo "<input type='number' id='fontsizepdftitle' name='fontsizepdftitle' value='$fontsizepdftitle'>";
        echo '<label for="fontsizepdftitle"> PDF Title</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>Color</h3>';
    	echo '</div>';

        echo "<input type='color' id='titlepdfcolor' name='titlepdfcolor' value='$titlecolor'>";
        echo '<label for="titlepdfcolor"> Box Title Color</label><br><br>';

        echo "<input type='color' id='pdftitlecolor' name='pdftitlecolor' value='$pdftitlecolor'>";
        echo '<label for="pdftitlecolor"> PDF Title Color</label><br><br>';

        echo "<input type='color' id='backgroundpdfcolor' name='backgroundpdfcolor' value='$background'>";
        echo '<label for="backgroundpdfcolor"> Background Color</label><br><br>';

        echo '<div class="wrap">';
            echo '<h3>PDF Icon</h3>';
    	echo '</div>';

        if($pdficon == "1"){
            echo "<input type='radio' id='pdf1' name='icon' value='1' checked>";
        }else{
            echo "<input type='radio' id='pdf1' name='icon' value='1'>";
        }
        $backgroundimage01url =  $plugin_url . 'img/icon1.png';
        echo "<img src='$backgroundimage01url' alt='pdf icon' style='width:90px;height:90px;'>";
    
        if($pdficon == "2"){
            echo "<input type='radio' id='pdf2' name='icon' value='2' checked>";
        }else{
            echo "<input type='radio' id='pdf2' name='icon' value='2'>";
        }
        $backgroundimage02url =  $plugin_url . 'img/icon2.png';
        echo "<img src='$backgroundimage02url' alt='pdf icon' style='width:90px;height:90px;'>";
    
        if($pdficon == "3"){
            echo "<input type='radio' id='pdf3' name='icon' value='3' checked>";
        }else{
            echo "<input type='radio' id='pdf3' name='icon' value='3'>";
        }
        $backgroundimage03url =  $plugin_url . 'img/icon3.png';
        echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";

        if($pdficon == "4"){
            echo "<input type='radio' id='pdf4' name='icon' value='4' checked>";
        }else{
            echo "<input type='radio' id='pdf4' name='icon' value='4'>";
        }
        $backgroundimage03url =  $plugin_url . 'img/icon4.png';
        echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'>";

        if($pdficon == "5"){
            echo "<input type='radio' id='pdf5' name='icon' value='5' checked>";
        }else{
            echo "<input type='radio' id='pdf5' name='icon' value='5'>";
        }
        $backgroundimage03url =  $plugin_url . 'img/icon5.png';
        echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";

        if($pdficon == "6"){
            echo "<input type='radio' id='pdf6' name='icon' value='6' checked>";
        }else{
            echo "<input type='radio' id='pdf6' name='icon' value='6'>";
        }
        $backgroundimage03url =  $plugin_url . 'img/icon6.png';
        echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";
    
    echo '</div><br>';
    
    echo '<div class="wrap">';
        echo "<button id='announcementbutton' onclick='buttonsave(\"$jsonurledit\")' style='width:80px;height:35px;'>Save</button></a>";
    echo '</div>';

}



add_filter( 'woocommerce_product_data_tabs', 'wk_custom_product_tab_pdf', 10, 1 );
function wk_custom_product_tab_pdf( $default_tabs ) {

    $default_tabs['custom_tab_mypdf'] = array(

        'label'   =>  __( 'PDF', 'domain' ),

        'target'  =>  'wk_custom_tab_data_dpf',

        'priority' => 70,

        'class'   => array()

    );

    return $default_tabs;

}


add_action( 'woocommerce_product_data_panels', 'wk_custom_tab_data_dpf' );
function wk_custom_tab_data_dpf() {

    $plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );

    $url = $plugin_url . 'bm-pdf.php';
    $urldelete = $plugin_url . 'bm-pdf-delete.php';

    $pid = $_GET['post'];

    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='pruduct-pdf' and post_title = $pid");

    //echo count($all_product_data);
    
    

   echo '<div id="wk_custom_tab_data_dpf" class="panel woocommerce_options_panel">


    <div id="productgeral" style="padding-left: 15px;">


        <div class="wrap">

            <h3>Title*</h3>

    	</div>

    	<input type="text" name="pdftitle" id="pdftitle" class="regular-text"><br><br>

        <div class="wrap">

            <h3>Sub-Title*</h3>

    	</div>

    	<input type="text" name="pdfsubtitle" id="pdfsubtitle" class="regular-text"><br><br>

        <div class="wrap">

            <h3>Image*</h3>

    	</div>

        <input type="text" name="image_urll2" id="image_urll2" class="regular-text">

        <input type="button" style="width:150px;" name="uploadd-btn" id="uploadd-btn" class="button-secondary" value="Upload Image"><br><br>

    	
        <div class="wrap">

            <h3>PDF*</h3>

    	</div>

        <input type="text" name="image_url" id="image_url" class="regular-text">

        <input type="button" style="width:150px;" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload PDF"><br><br>

        

        <div class="wrap">

            <div id="bm-pdf-button" onclick="pdfbuttonsave2(\''.$url.'\', \''.$pid.'\')" style="cursor: pointer;width:80px;height:25px;size:16px;background-color: #428bca;color:white;text-align:center;padding-top:5px">Save</div>

            <div id="pdferror" style="color:red;size:16px;padding-top:5px"></div>

        </div>';

        if (count($all_product_data) > 0){
            echo '<div class="wrap">';
                echo '<h3>PDF List</h3>';
            echo '</div>';
            
            foreach($all_product_data as $pdfs) {
                $newid =  $pdfs->ID;
                $divid = "p" . $newid;
                $url_value = get_post_meta( $newid, 'pdf_url', true );
                $title_value = get_post_meta( $newid, 'pdf_title', true );
                $description_value = get_post_meta( $newid, 'pdf_description', true );
                echo "<div id='$divid' style='margin-top:20px;width:100%;display:inline-block;min-width: 100% !important;'>";
                    echo '<div onclick="pdfbuttondelete(\''.$urldelete.'\', \''.$newid.'\')" style="cursor: pointer;float:left;width:80px;height:25px;size:16px;background-color:#aa3210;color:white;text-align:center;padding-top:5px;margin-right:10px">Delete</div>';
                    echo "<div style='float:left;padding-top:5px;size:45px;font-weight:bold;'>$title_value</div>";
                echo '</div>';
            }

        }

    echo '

    </div>

    <div style="height:65px;"></div>
    

    <script type="text/javascript">

    jQuery(document).ready(function($){

        $("#upload-btn").click(function(e) {

            e.preventDefault();

            var image = wp.media({ 

                title: "Upload PDF",

                multiple: false

            }).open()

            .on("select", function(e){

                var uploaded_image = image.state().get("selection").first();

                console.log(uploaded_image);

                var image_url = uploaded_image.toJSON().url;

                $("#image_url").val(image_url);

            });

        });

    });

    jQuery(document).ready(function($){

        $("#uploadd-btn").click(function(e) {

            e.preventDefault();

            var image = wp.media({ 

                title: "Upload Image",

                multiple: false

            }).open()

            .on("select", function(e){

                var uploaded_image = image.state().get("selection").first();

                console.log(uploaded_image);

                var image_urll2 = uploaded_image.toJSON().url;

                $("#image_urll2").val(image_urll2);

            });

        });

    });

    </script>

    

   </div>';

   

}


function bm_woo_pdf_shortcode() {
    ob_start();
  

    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'csspdf', $plugin_url . 'css/css.css' );

    $upload_dir   = wp_upload_dir();
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $title = $json['inquire']['title'];
    $titlecolor = $json['inquire']['titlecolor'];
    $background = $json['inquire']['background'];
    $pdficon = $json['inquire']['icon'];
    $pdfimage = $plugin_url . "img/icon" . $pdficon . ".png";

    $margintop = $json['inquire']['margintop']."px";
    $marginbottom = $json['inquire']['marginbottom']."px";
    $paddingtop = $json['inquire']['paddingtop']."px";
    $paddingbottom = $json['inquire']['paddingbottom']."px";
    $fontsizetitle = $json['inquire']['fontsizetitle']."px";
    $fontsizepdftitle = $json['inquire']['fontsizepdftitle']."px";
    $pdftitlecolor = $json['inquire']['pdftitlecolor'];

    $postid = get_the_ID();
    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='pruduct-pdf' and post_title = $postid");

    if (count($all_product_data) > 0 && $status == "true"){

        echo "<div class='elementor-widget-container' style='text-align:center;margin-top:$margintop;margin-bottom:$marginbottom;padding-top:$paddingtop;padding-bottom:$paddingbottom;'>";
            echo "<h2 class='elementor-heading-title elementor-size-default' style='padding-top:25px;padding-bottom:35px;text-align:center;color:$titlecolor;font-size:$fontsizetitle'>$title</h2>";
            echo "<div style='width:100%'> ";
                echo "<div class='relatedboxx2'>";
                $titlemaxletters = 0;
                foreach($all_product_data as $pdfs) {
                    $newid =  $pdfs->ID;
                    $title_value = get_post_meta( $newid, 'pdf_title', true );
                    $subtitle_value = get_post_meta( $newid, 'pdf_subtitle', true );
                    if (strlen($title_value) > $titlemaxletters){
                        $titlemaxletters = strlen($title_value);
                    }
                }
                if($titlemaxletters > 0 && $titlemaxletters < 21){
                    $titleminhight = "40px";
                }
                if($titlemaxletters > 20 && $titlemaxletters < 41){
                    $titleminhight = "80px";
                }
                if($titlemaxletters > 40 && $titlemaxletters < 61){
                    $titleminhight = "120px";
                }
                if($titlemaxletters > 60 && $titlemaxletters < 81){
                    $titleminhight = "160px";
                }

                foreach($all_product_data as $pdfs) {
                    $newid =  $pdfs->ID;
                    $url_value = get_post_meta( $newid, 'pdf_url', true );
                    $imgurl_value = get_post_meta( $newid, 'pdf_image_url', true );
                    $title_value = get_post_meta( $newid, 'pdf_title', true );
                    $subtitle_value = get_post_meta( $newid, 'pdf_subtitle', true );
                    $upload_dir2 = $upload_dir['baseurl'] . "/" . $url_value ;
                    $upload_dir3 = $upload_dir['baseurl'] . "/" . $imgurl_value ;

                    echo "<div class='relatedbox2'>";
                        echo "<a href='$upload_dir2' target='_blank'>";
                            echo "<div class='relatedboximage2' style='background-image: url(\"$upload_dir3\");background-size: cover;'>";
                            echo "</div>";
                        echo "</a>";
                        if( wp_is_mobile() ) {
                            echo "<a href='$upload_dir2' target='_blank'>";
                                echo "<div class='relatedboxdescription2'>";
                                    echo "<div>$title_value</div>";	
                                echo "</div>";
                                echo "<div class='relatedboxdescription3'>";
                                    echo "<div>$subtitle_value</div>";	
                                echo "</div>";
                            echo "</a>";
                        }
                        else
                        {
                            echo "<a href='$upload_dir2' target='_blank'>";
                                echo "<div class='relatedboxdescription4'>";
                                    if($title_value){
                                        echo "<div style='min-height:$titleminhight' class='relatedboxdescription2'>";
                                            echo "<div>$title_value</div>";	
                                        echo "</div>";
                                    }
                                    if($subtitle_value){
                                        echo "<div class='relatedboxdescription3'>";
                                            echo "<div>$subtitle_value</div>";	
                                        echo "</div>";
                                    }
                                echo "</div>";
                            echo "</a>";
                        }
                    echo "</div>";



                    // echo "<div class='pdfbox'>";
                        
                    //     echo "<a href='$upload_dir2'>";
                    //         echo "<div class='pdfboximage'>";
                    //             echo "<img src='$pdfimage' max width='100%' height='100%' title='PDF' alt='PDF' style='max-width: 90px;'>";
                    //         echo "</div>";
                    //     echo "</a>";

                    //     echo "<a href='$upload_dir2'>";
                    //         echo "<div class='pdfboxdescription'>";
                    //             echo "<h4 style='line-height: 1.2;color:$pdftitlecolor;font-size:$fontsizepdftitle'>$title_value</h4>	";	
                    //         echo "</div>";
                    //     echo "</a>";

                    // echo "</div>";

                }
                echo "</div>";
            echo "</div>";
            
        
        echo "</div>";
  
    }
    else{
        echo'
            <script type="text/javascript">
                document.getElementById("downloaddiv").style.display = "none"
            </script>
        ';
    }
    return ob_get_clean();
}
// Register shortcode
add_shortcode('bm_woo_pdf', 'bm_woo_pdf_shortcode'); 


// -------------- Description Tab -----------------------------------------------------

function filter_woocommerce_product_tabs( $tabs ) {

    $plugin_url = plugin_dir_url( __FILE__ );
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $title = $json['inquire']['title'];
    $descriptiontab = $json['inquire']['descriptiontab'];
    $status = $json['inquire']['status'];
    

    if($descriptiontab == "true" && $status == "true"){
        $tabs['reviews']['priority'] = 5;
        $tabs['bm_woo_pdf'] = array(
            'title'     => __( $title, 'woocommerce' ),
            'priority'  => 3,
            'callback'  => 'pdf_product_tab_content'
        );
    }else{
        unset( $tabs[$title] );
        return $tabs;
    }
        
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'filter_woocommerce_product_tabs', 100, 1 );

// New Tab contents
function pdf_product_tab_content() {

    include '../../../wp-load.php';

    $plugin_url = plugin_dir_url( __FILE__ );
    $upload_dir   = wp_upload_dir();
    $jsonurl = $plugin_url . 'json/db.json';
    $jsonfile = file_get_contents($jsonurl);
    $json = json_decode($jsonfile, true);
    $status = $json['inquire']['status'];
    $titlecolor = $json['inquire']['titlecolor'];
    $background = $json['inquire']['background'];
    $descriptiontab = $json['inquire']['descriptiontab'];
    $pdficon = $json['inquire']['icon'];
    $pdfimage = $plugin_url . "img/icon" . $pdficon . ".png";

    $fontsizepdftitle = $json['inquire']['fontsizepdftitle'];
    $pdftitlecolor = $json['inquire']['pdftitlecolor'];

    $postid = get_the_ID();
    global $wpdb;
    $all_product_data = $wpdb->get_results("SELECT ID FROM `" . $wpdb->prefix . "posts` where post_type='pruduct-pdf' and post_title = $postid");

    if (count($all_product_data) > 0 && $status == "true"){

        echo "<div class='elementor-widget-container' style='text-align:left;'>";
            echo "<div>";
                foreach($all_product_data as $pdfs) {
                    $newid =  $pdfs->ID;
                    $url_value = get_post_meta( $newid, 'pdf_url', true );
                    $title_value = get_post_meta( $newid, 'pdf_title', true );
                    $upload_dir2 = $upload_dir['baseurl'] . "/" . $url_value ;

                    // if (strlen($title_value) > 15){
                    //     $title_value = substr($title_value, 0, 12) . '...';
                    // }
                        

                    echo "<div style='padding-top:25px;padding-bottom:25px;text-align:center;width:200px;display:inline-block;'>";
        
                        echo "<div>";
                            echo "<a href='$upload_dir2'>";
                                echo "<img src='$pdfimage' width='90' height='90' title='PDF' alt='PDF'>";
                            echo "</a>";
                        echo "</div>";
        
                        echo "<div>";
                            echo "<h4 class='elementor-heading-title elementor-size-default' style='color:$pdftitlecolor;font-size:$fontsizepdftitle'>$title_value</h4>	";	
                        echo "</div>";

                    echo "</div>";

                }
            
            echo "</div>";
            
        
        echo "</div>";
  
    }
}

?>