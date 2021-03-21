<?php
echo $_server['SERVER_NAME'];
function university_files()
{
  wp_enqueue_style('custom-google-quotes','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

if(strstr($_SERVER['SERVER_NAME'],'fictional-university.local')){

  wp_enqueue_script('main-university-javascript', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
} else {
  wp_enqueue_script('our-vendors-javascript', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
  wp_enqueue_script('main-university-javascript', get_theme_file_uri('/bundled-assets/scripts.bc49dbb23afb98cfc0f7.js'), NULL, '1.0', true);
  wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.bc49dbb23afb98cfc0f7.css'));
}

}

add_action('wp_enqueue_scripts','university_files');

function university_features(){
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerMenuLocation1', 'Footer Menu Location1');
  register_nav_menu('footerMenuLocation2', 'Footer Menu Location2');

  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'university_features');


 ?>
