<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?></title>
  <link rel="stylesheet" href="https://use.typekit.net/hte5kno.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/slick/slick-theme.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/js/slick/slick.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css?ver=0.0.8" type="text/css">
  <?php wp_head(); ?>
  <link rel="SHORTCUT ICON" href="https://kokeshimatsuri.com/wp/wp-content/themes/kokeshi/img/favicon.ico" />
  <meta name="description" content="全国こけし祭りでは、東北地方をはじめ各系統のこけし工人が集まり、全国の伝統こけしが一堂に会するこけしの実演展示即売会、コンクール入賞作品の展示、鳴子漆器の展示・即売やフェスティバルパレード、こけしの奉納式などが行われます。">
  <meta name="keywords" content="全国こけし祭り,こけし祭り,こけし,鳴子温泉,鳴子小学校,鳴子温泉神社,伝統こけし">
  <meta property="og:title" content="全国こけし祭り | 「こけしのまち」に日本各地の伝統こけしが勢ぞろい">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://kokeshimatsuri.com">
  <meta property="og:image" content="https://kokeshimatsuri.com/wp/wp-content/themes/kokeshi/img/og.png">
  <meta property="og:description" content="全国こけし祭りでは、東北地方をはじめ各系統のこけし工人が集まり、全国の伝統こけしが一堂に会するこけしの実演展示即売会、コンクール入賞作品の展示、鳴子漆器の展示・即売やフェスティバルパレード、こけしの奉納式などが行われます。">
  <meta property="og:site_name" content="全国こけし祭り | 「こけしのまち」に日本各地の伝統こけしが勢ぞろい">
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:image" content="https://kokeshimatsuri.com/wp/wp-content/themes/kokeshi/img/og.png">
  <script>
    (function(d) {
      var config = {
          kitId: 'cmf0bot',
          scriptTimeout: 3000,
          async: true
        },
        h = d.documentElement,
        t = setTimeout(function() {
          h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
        }, config.scriptTimeout),
        tk = d.createElement("script"),
        f = false,
        s = d.getElementsByTagName("script")[0],
        a;
      h.className += " wf-loading";
      tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
      tk.async = true;
      tk.onload = tk.onreadystatechange = function() {
        a = this.readyState;
        if (f || a && a != "complete" && a != "loaded") return;
        f = true;
        clearTimeout(t);
        try {
          Typekit.load(config)
        } catch (e) {}
      };
      s.parentNode.insertBefore(tk, s)
    })(document);
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="<?php bloginfo('template_url'); ?>/js/slick/slick.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js" defer></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script type="application/javascript">
    var template_url = '<?php bloginfo('template_url'); ?>';
  </script>
  <script type="application/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js?ver=0.0.3" defer></script>
</head>

<body>
  <div id="app">
    <transition name="loadin">
      <div v-if="isloading" class="c-loading p-loading">
        <div class="p-loading__inner">
          <img class="p-loading__gif" src="<?php bloginfo('template_url'); ?>/img/loading.gif" alt="">
          <img class="p-loading__title" src="<?php bloginfo('template_url'); ?>/img/title_load.png" alt="">
        </div>
      </div>
    </transition>
    <div class="v-home" :class="[ isloading ? '-isloading' : '-noloading' ]">