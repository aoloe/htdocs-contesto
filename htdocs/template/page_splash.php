<div id="content" style="position:relative">
    <div id="slides">
        <ul class="slides-container">
            <li>
                <a href="de/"><img src="images/splash_de.png" /></a>
                <div class="slides-traduzioni"><div class="row"><p><?= $traduzioni_de ?></p></div></div>
            </li>
            <li>
                <a href="fr/"><img src="images/splash_fr.png" /></a>
                <div class="slides-traduzioni"><div class="row"><p><?= $traduzioni_fr ?></p></div></div>
            <li>
                <a href="en/"><img src="images/splash_en.png" /></a>
                <div class="slides-traduzioni"><div class="row"><p><?= $traduzioni_en ?></p></div></div>
            </li>
            <li>
                <a href="it/"><img src="images/splash_it.png" /></a>
                <div class="slides-traduzioni"><div class="row"><p><?= $traduzioni_it ?></p></div></div>
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
        <a href="it/"><img src="images/splash_logo.png" /></a>
        <?php /*
        <img src="images/splash_logo_it.png" style="width:350px;
    height:200px;" />
        */ ?>
    </div>
</div>
<style>
#slides ul li {
}
.slides-navigation a {
    color:lightgray;
}
.slides-traduzioni {
    display:table;
    width:100%;
    height:100%;
}
.slides-traduzioni .row {
    display:table-cell;
    vertical-align:bottom;
    height:100%;
    font-family:UniversLtCn;
    font-size:1.5em;
    text-transform: uppercase;
}
.slides-traduzioni .row p {
    padding-top:15px;
    padding-left:20px;
    padding-bottom:10px;
    background-color:black;
}

.slides-traduzioni .row a {
    text-decoration: none;
    color: #f6b958;
}

.slides-traduzioni .row a.active {
    color:#fbca84;
    font-weight:bold;
}

.slides-pagination {
    color:white;
    background-color:black;
    text-align:left;
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

@media only screen and (max-width: 640px) {
    .slides-traduzioni .row p {
        font-size:.6em;
    }

}
</style>
<script>
$(document).ready(function() {
  $(document).on('init.slides', function() {
    $('.loading-container').fadeOut(function() {
      $(this).remove();
    });
  });
  /*
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
  */


  $('#slides').superslides({
    play: 8000,
    slide_speed: 8000,
    pagination: false,
    // hashchange: true,
    scrollable: true
  });
  $('body').on('animated.slides', function() {
      // console.log('chuila');
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
