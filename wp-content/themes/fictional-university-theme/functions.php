<?php
require get_theme_file_path('inc/search-route.php');
require get_theme_file_path('inc/like-route.php');

function university_custom_rest (){
  register_rest_field('post', 'authorName', array(
    'get_callback'=>function(){return get_the_author();}
  ));

  register_rest_field('note', 'userNoteCount', array(
    'get_callback'=>function(){return count_user_posts(get_current_user_id(),'note');}
  ));

}

add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = NULL){
  if(!$args['title']){
    $args['title']=get_the_title();
  }
  if(!$args['subtitle']){
    $args['subtitle']=get_field('page_banner_subtitle');
  }
  if(!$args['photo']){
    if(get_field('page_banner_background_image') AND !is_archive() AND !is_home() ){
    $args['photo']=get_field('page_banner_background_image')['sizes']['pageBanner'];
  }
  else{
    $args['photo']=get_theme_file_uri('/images/ocean.jpg');
  }
  }
  ?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>

<?php
}
//maps




function university_files()
{
  wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

  wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?key=AIzaSyAERmeMtE14J0RIbYgf2rAhgqwO7LWlRMk', NULL, '1.0', true);

if(strstr($_SERVER['SERVER_NAME'],'fictional-university.local')){

  wp_enqueue_script('main-university-javascript', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
} else {
  wp_enqueue_script('our-vendors-javascript', get_theme_file_uri('/bundled-assets/vendors~scripts.1fa169383e64a33bfd0c.js'), NULL, '1.0', true);
  wp_enqueue_script('main-university-javascript', get_theme_file_uri('/bundled-assets/scripts.d2366aaf91eec27e6795.js'), NULL, '1.0', true);
  wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.d2366aaf91eec27e6795.css'));
}
wp_localize_script('main-university-javascript', 'universityData', array(
  'root_url'=>get_site_url(),
  'nonce'=>wp_create_nonce('wp_rest')
));
}

add_action('wp_enqueue_scripts','university_files');

function university_features(){
  register_nav_menu('headerMenuLocation', 'Header Menu Location');
  register_nav_menu('footerMenuLocation1', 'Footer Menu Location1');
  register_nav_menu('footerMenuLocation2', 'Footer Menu Location2');

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true);
  add_image_size('professorPortrait', 480, 650, true);
  add_image_size('pageBanner', 1500, 350, true);
}
add_action('after_setup_theme', 'university_features');

function highlight_menu_page ($classes, $item, $args) {

// Use your menu location name from your function
if (get_post_type() == 'post' AND $item->title == 'Blog') {

            $classes[] = 'current-menu-item';

        // "Past events" is needed for a future lesson. You will see why...
      } else if (get_post_type() == 'event' AND $item->title == 'Events' OR is_page('past-events')AND $item->title == 'Events') {
        $classes[] = 'current-menu-item';
      }else if (get_post_type() == 'program' AND $item->title == 'Programs') {
          $classes[] = 'current-menu-item';
      }else if (get_post_type() == 'campus' AND $item->title == 'Campuses') {
          $classes[] = 'current-menu-item';
      }

    return $classes;
}

// Loads the filter to modify the css from the navigation menu
add_filter('nav_menu_css_class', 'highlight_menu_page', 10, 3);

function university_adjust_queries($query){
  if (!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query())
  {
    $query->set('posts_per_page', -1);
  }

  if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query())
  {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }
  if (!is_admin() AND is_post_type_archive('event') AND $query->is_main_query())
  {
    $today=date('Ymd');

    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query',
      array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          )
        )
      );
  }
}

add_action('pre_get_posts', 'university_adjust_queries');

function universityMapKey($api)
{
  $api['key']='AIzaSyAERmeMtE14J0RIbYgf2rAhgqwO7LWlRMk';
  return $api;
}
add_filter('acf/fields/google_map/api', 'universityMapKey');

//Redirect subscriber account out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend(){
$ourCurrentUser=wp_get_current_user();
  if (count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0]=='subscriber'){
    wp_redirect(site_url('/'));
    exit;
  }
}


add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar(){
$ourCurrentUser=wp_get_current_user();

  if (count($ourCurrentUser->roles)==1 AND $ourCurrentUser->roles[0]=='subscriber'){
    show_admin_bar(false);

  }
}

//Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl(){

  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts','ourLoginCSS');

function ourloginCSS(){

  wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.d2366aaf91eec27e6795.css'));
  wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertext', 'ourLoginTitle');

function ourLoginTitle(){

  return get_bloginfo('name');
}

//force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr){
  if ($data['post_type']=='note')
  {
    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']){
      die("You have reached your note limit");
    }
    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);

  }
  if($data['post_type']=='note' AND $data['post_status']!='trash'){
    $data['post_status']="private";
  }
    return $data;
}

 ?>
