<?php get_header(); ?>
<section class="p-404">
  <div class="p-404__contents">
    <h1 class="p-404__ttl">404</h1>
    <img class="c-logo-img p-404__img" src="<?php bloginfo('template_url'); ?>/img/logo.svg">&nbsp;
    <p class="p-404__txt">ページが見つかりませんでした。</p>
    <p class="p-404__txt"><a class="p-404__link" 　href="<?php echo home_url('/'); ?>">TOPへ</a></p>
  </div>
</section>
<?php get_footer(); ?>