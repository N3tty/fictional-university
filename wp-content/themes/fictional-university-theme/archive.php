<?php
get_header();

pageBanner(array(
  'title'=>get_the_archive_title(),
  'subtitle'=>get_the_archive_description(),
  'photo'=>get_theme_file_uri('/images/ocean.jpg')
));
?>

<div class="container container--narrow page-section">
  <?php $title=get_the_archive_title(); echo $title;
  while(have_posts())
  {
    the_post();
    ?>
<div class="post-item">
<h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
  <div class="metabox">
<p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('j M Y'); ?> in <?php echo get_the_category_list(', '); ?></p>

  </div>
  <div class="generic-content">
    <?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>" class="btn btn--blue">Continue reading &raquo;</a></p>
  </div>
</div>
    <?php
  }
  echo paginate_links();
   ?>
</div>


<?php
get_footer();
 ?>
