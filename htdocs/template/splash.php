<div class="flexslider" style="position:relative; overflow:hidden;">
    <ul class="slides">
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
    <div class="col_33" id="logo">
        <a href="it/"><img src="images/splash_logo_it.png" /></a>
        <?php /*
        <img src="images/splash_logo_it.png" style="width:350px;
height:200px;" />
        */ ?>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({
        after: function(slider) {
            // alert('chuila');
            // curSlide = slider.slides[slider.currentSlide];
            // $(curSlide).find('.headline').fadeIn(500);
            // console.log(slider.currentSlide);
        }
    });
    $('body').css('background-color', 'black');
    $('.flexslider').css('border', 0);
    $('body').css('margin', 0);
    $('body').css('text-align', 'center');
  });
</script>
<style>
#logo {
    position:absolute;
    bottom:30%;
    max-width:100%;
    margin-left:auto;
    margin-right:auto;
    left:0;
    right:0;
    z-index:9999;
}
#logo img {
    width:100%;
}
@media only screen and (max-width:768px) {
    #logo img {
        width:250px;
    }
}
@media only screen and (max-width:480px) {
    #logo {
        position:initial;
        background-color:red;
    }
    #logo img {
        width:250px;
        background-color:green;
    }
</style>
