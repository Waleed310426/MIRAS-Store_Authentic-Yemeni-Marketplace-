<?php
/**
 * The main template file
 */
get_header(); ?>

<div class="miras-container" style="padding: 100px 24px;">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    else :
        echo '<h2>لا توجد نتائج</h2>';
    endif;
    ?>
</div>

<?php get_footer(); ?>