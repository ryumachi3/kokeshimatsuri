const TB = 769;
const PC = 960;

const wp_dir = "/wp/";

$(function () {
  $(".js-area-title").on("click", function () {
    $(this).next().slideToggle();
  });
});

Vue.component('fade-in', {
  template: `
	<div class="fadein-box__outer">
  	<transition name="fadein">
      <div v-if="visible" class="fadein-box__inner">
  		<slot></slot>
      </div>
    </transition>
  </div>`,
  data() {
    return {
      visible: false
    };
  }, mounted() {
    if (!this.visible) {
      var top = this.$el.getBoundingClientRect().top;
      this.visible = top < window.innerHeight - 90;
    }
  },
  methods: {
    handleScroll() {
      if (!this.visible) {
        var top = this.$el.getBoundingClientRect().top;
        this.visible = top < window.innerHeight - 90;
      }
    }
  },
  created() {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed() {
    window.removeEventListener('scroll', this.handleScroll);
  }
})

new Vue({
  el: '#app',
  data: {
    scrollY: 0,
    isLoad: false,
    isDown: false,
    isMenu: false,
    isLeadEnd: false,
    isTopPage: false,
    isWorksPage: false,
    isWorksDtPage: false,
    isTb: false,
    isPC: false,
    isloading: true,
    isloadingLogo: false,
    isOpenHigashi: false,
    isOpenChubu: false,
    isOpenKinki: false,
    isOpenChugoku: false,
    isOpenShikoku: false,
    isOpenKyusyu: false,
    pages: [
      { slug: 'news', isCurrent: false },
      { slug: '#what', isCurrent: false },
      { slug: '#events', isCurrent: false },
      { slug: 'access', isCurrent: false },
      { slug: 'colum', isCurrent: false },
      { slug: 'kokeshi', isCurrent: false },
      { slug: 'poster-gallery', isCurrent: false },
    ],
    isNews__list__hover: [
      false,
      false,
      false
    ],
  },
  mounted() {

    setTimeout(() => {
      this.isloading = false;
    }, 1500);

    // setTimeout(() => {
    $(".slick01").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      speed: 3000,
      autoplaySpeed: 3000,
      autoplay: true,
      lazyLoad: 'progressive',
      pauseOnFocus: false,
      pauseOnHover: false,
      pauseOnDotsHover: false,
    });

    $(".slick02").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      //arrows: false,
      fade: true,
      speed: 1000,
      autoplaySpeed: 2000,
      autoplay: true,
      lazyLoad: 'progressive',
      pauseOnFocus: false,
      pauseOnHover: false,
      pauseOnDotsHover: false,
    });

    $(".slick03").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 9000,
      arrows: false,
      cssEase: 'linear',
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      }]
    });

    $(".slick04").slick({
      variableWidth: true,
      slidesToShow: 9,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 3000,
      arrows: false,
      cssEase: 'linear',
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      }]
    });

    $(".slick05").slick({
      variableWidth: true,
      slidesToShow: 9,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 0,
      speed: 3000,
      arrows: false,
      cssEase: 'linear',
      responsive: [{
        breakpoint: 768,
        settings: {
          slidesToShow: 2
        }
      }]
    });
    // }, 1500);


    window.addEventListener('scroll', this.handleScroll);
    window.addEventListener('resize', this.handleResize);

    if (window.innerWidth >= PC) {
      this.isPC = true;
      this.isTb = false;
    } else if (window.innerWidth >= TB) {
      this.isPC = false;
      this.isTb = true;
    } else {
      this.isPC = false;
      this.isTb = false;
    }
    this.isLoad = true;


    if (location.pathname == '/wp/' || location.pathname == '/') {
      this.isTopPage = true;

      this.isloadingLogo = false;
    } else {
      setTimeout(() => {
        this.isloading = false;
      }, 1000);
      this.isTop = false;
      this.isTopPage = false;
      let rootPath = '';
      console.log('location.pathname', location.pathname);
      if (location.pathname.indexOf(wp_dir) === 0) {
        rootPath = wp_dir;
      } else {
        rootPath = '/';
      }
      console.log('rootPath', rootPath);
      // const worksPagePath = rootPath + '';
      // const worksDtPagePath = rootPath + 'works/';
      // const tagPagePath = rootPath + 'tag/';
      // if (location.pathname.indexOf(worksPagePath) > -1) { // 部分一致
      //   this.isWorksPage = true;
      // } else if (location.pathname.indexOf(tagPagePath) > -1) { // 部分一致
      //   this.isWorksPage = true;
      // } else if (location.pathname.indexOf(worksDtPagePath) > -1) { // 部分一致
      //   this.isWorksDtPage = true;
      // }

      // カレントページのフラグをONする    
      for (let page of this.pages) {
        if (location.pathname.indexOf(rootPath + page.slug) === 0) {
          page.isCurrent = true;
        } else {
          page.isCurrent = false;
        }
      }
    }





    // // htmlで付与したクラス単位で、アニメーションを追加する
    // ScrollReveal().reveal('.blocks-gallery-item');

    // // オプションを追加し、アニメーションをカスタマイズ可能
    // ScrollReveal().reveal('.blocks-gallery-item', {
    //   duration: 500, // アニメーションの完了にかかる時間
    //   reset: false   // 何回もアニメーション表示するか
    // });

  },
  beforeDestroy() {
    window.removeEventListener('resize', this.handleResize);
  },
  methods: {
    changeImg_button(p_url, p_no) {
    },
    leaveImg_button() {
    },
    handleScroll() {
      // トップから少しスクロールした時
      (window.scrollY > 30) ? this.isDown = true : this.isDown = false;
    },
    handleResize() {
      if (window.innerWidth >= PC) {
        this.isPC = true;
        this.isTb = false;
      } else if (window.innerWidth >= TB) {
        this.isPC = false;
        this.isTb = true;
      } else {
        this.isPC = false;
        this.isTb = false;
      }
    },
  }
})