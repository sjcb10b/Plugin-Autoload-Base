<?php
if(! defined('WP_UNINSTALL_PLUGIN')){
    die;
}
// Clear the database
$books =  get_posts( array('post_type' => 'book', 'numberposts' => -1 ) );
// loop
foreach ($books as $book){
    wp_delete_post ($book->ID, true); // array with 2 values ID and true/false
}
// access the database
global  $wpdb;
$wpdb->query( "Delete from wp_posts where post_type = 'book' " );
$wpdb->query( "Delete from wp_postmeta where post_id NOT IN (select id from wp_posts)" );
$wpdb->query( "Delete from wp_term_relationships where object_id NOT IN (select id from wp_posts)" );


