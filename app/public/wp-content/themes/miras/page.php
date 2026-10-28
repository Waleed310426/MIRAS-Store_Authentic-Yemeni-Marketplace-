<?php get_header(); ?>
<div style="margin-top:76px; background:#ffffff;">

  <div class="miras-page-hero">

    <!-- ── Decorative Background Elements ── -->
    <div class="ph-pattern"></div>
    <div class="ph-orb-1"></div>
    <div class="ph-orb-2"></div>
    <div class="ph-ring"></div>

    <!-- ── Hero Content ── -->
    <div class="miras-page-hero-inner">
      <div class="miras-page-breadcrumbs">
        <a href="<?php echo home_url('/'); ?>">الرئيسية</a>
        <span class="separator">/</span>
        <span class="current-page"><?php the_title(); ?></span>
      </div>
      <h1><?php the_title(); ?></h1>
    </div>

    <!-- ── SVG Wave Bottom ── -->
    <div class="ph-wave">
      <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,0 1440,30 L1440,60 L0,60 Z" fill="#ffffff"/>
      </svg>
    </div>

  </div><!-- /.miras-page-hero -->

  <div class="miras-page-content">
    <div class="miras-page-content-inner">
      <div class="miras-page-card">
        <?php while(have_posts()): the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

</div>
<?php get_footer(); ?>