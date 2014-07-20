<div id="content" style="position:relative">
    <div id="slides">
        <ul class="slides-container">
            <li>
                <a href="de/"><img src="images/splash_de.png" /></a>
            </li>
            <li>
                <a href="fr/"><img src="images/splash_fr.png" /></a>
            </li>
            <li>
                <a href="en/"><img src="images/splash_en.png" /></a>
            </li>
            <li>
                <a href="it/"><img src="images/splash_it.png" /></a>
            </li>
        </ul>
        <nav class="slides-navigation">
          <a href="#" class="next">
            <i class="fa fa-chevron-right fa-3x"></i>
          </a>
          <a href="#" class="prev">
            <i class="fa fa-chevron-left fa-3x"></i>
          </a>
        </nav>
    </div>
    <div class="col_33"  id="slides-logo">
        <a href="it/"><img src="images/splash_logo_it.png" /></a>
        <?php /*
        <img src="images/splash_logo_it.png" style="width:350px;
    height:200px;" />
        */ ?>
    </div>
</div>
<style>
.slides-navigation a {
    color:lightgray;
}
#slides-logo {
    /* background-color:red; */
    position:absolute;
    bottom:30%;
    text-align:center;
    max-width:33%;
    margin-left:auto;
    margin-right:auto;
    left:0;
    right:0;
    z-index:9999;
}
#slides-logo img {
    /* background-color:green; */
    max-width:70%;
}
</style>
<script>
$(document).ready(function() {
  $(document).on('init.slides', function() {
    $('.loading-container').fadeOut(function() {
      $(this).remove();
    });
  });
  $(document).on('animated.slides', function() {
      url = $('#slides-logo img').attr('src').split('/');
      image = url[url.length - 1].split('.');
      language = image[0].split('_');
      // console.log(language);
      list = ['de','fr','en','it'];
      current = $('#slides').superslides('current')
      // console.log(current);
      language[language.length - 1] = list[current];
      image[0] = language.join('_');
      url[url.length - 1] = image.join('.');
      url = url.join('/');
      // console.log(url);
      $('#slides-logo img').attr('src', url);
      $('#slides-logo a').attr('href', list[current]+'/');
  });


  $('#slides').superslides({
    play: 8000,
    slide_speed: 8000,
    pagination: false,
    // hashchange: true,
    scrollable: true
  });

  document.ontouchmove = function(e) {
    e.preventDefault();
  };
  $('#slides').hammer().on('swipeleft', function() {
    $(this).superslides('animate', 'next');
  });

  $('#slides').hammer().on('swiperight', function() {
    $(this).superslides('animate', 'prev');
  });
});
</script>
