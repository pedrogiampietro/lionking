<?php
if (!defined('INITIALIZED'))
    exit;
?>

<div class="left-container"><div class="community-up-section">
    <div class="community-up-text">
        Community
    </div>
    <a href="sub.php?page=search">
        <div class="community-box">
            <div class="community-box-img">
                <img src="<?php echo $layout_name; ?>/assets/img/community/search-character.png">
            </div>
            <div class="community-box-text">
                <div class="community-box-text-title">
                    Character Search
                </div>
                <div class="community-box-text-footer">
                     Find a player and information regarding him.
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </a>
    <a href="onlinelist">
        <div class="community-box">
            <div class="community-box-img">
                <img src="<?php echo $layout_name; ?>/assets/img/community/who-isonline.png">
            </div>
            <div class="community-box-text">
                <div class="community-box-text-title">
                    Online List
                </div>
                <div class="community-box-text-footer">
                     Check who is currently playing on the server.
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </a>
    <a href="guilds">
        <div class="community-box">
            <div class="community-box-img">
                <img src="<?php echo $layout_name; ?>/assets/img/community/search-guilds.png">
            </div>
            <div class="community-box-text">
                <div class="community-box-text-title">
                    Guild Search
                </div>
                <div class="community-box-text-footer">
                     View a list of existing guilds.
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </a>
    <a href="houses">
        <div class="community-box">
            <div class="community-box-img">
                <img src="<?php echo $layout_name; ?>/assets/img/community/check-houses.png">
            </div>
            <div class="community-box-text">
                <div class="community-box-text-title">
                    House Search
                </div>
                <div class="community-box-text-footer">
                     Find a house for yourself.
                </div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </a>
</div>
<!-- Slider -->
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("slider");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
    slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 4000); // Change image every 5 seconds
}
</script>
<!-- end of Slider -->                    </div>