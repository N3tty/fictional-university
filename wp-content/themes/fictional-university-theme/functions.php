<?php

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
function university_files()
{
  wp_enqueue_style('custom-google-quotes','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

if(strstr($_SERVER['SERVER_NAME'],'fictional-university.local')){

  wp_enqueue_script('main-university-javascript', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
} else {
  wp_enqueue_script('our-vendors-javascript', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
  wp_enqueue_script('main-university-javascript', get_theme_file_uri('/bundled-assets/scripts.f0fdadaa605798d4e16f.js'), NULL, '1.0', true);
  wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.f0fdadaa605798d4e16f.css'));
}

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
// if ('myHeaderMenuLocation' == $args->theme_location) {

if (get_post_type() == 'post' AND $item->title == 'Blog') {

            $classes[] = 'current-menu-item';

        // "Past events" is needed for a future lesson. You will see why...
      } else if (get_post_type() == 'event' AND $item->title == 'Events' OR is_page('past-events')AND $item->title == 'Events') {
        $classes[] = 'current-menu-item';
      }else if (get_post_type() == 'program' AND $item->title == 'Programs') {

                    $classes[] = 'current-menu-item';

              }
    // }
    return $classes;
}

// Loads the filter to modify the css from the navigation menu
add_filter('nav_menu_css_class', 'highlight_menu_page', 10, 3);

function university_adjust_queries($query){
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

add_action('pre_get_posts', 'university_adjust_queries')
 ?>
