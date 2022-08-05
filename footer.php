<?php wp_footer() ?>

<footer>
    <div id="top-footer">
        <div id="footer-content" class="flex-column">
            <div>
                <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/welia-health-logo-mobile.png';?>" width="104px" height="32px">
                <hr>
                <div class="socials flex-row">
                    <a href="#">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/socials-facebook.svg';?>" height="20px">
                    </a>
                    <a href="#">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/socials-twitter.svg';?>" height="20px">
                    </a>
                    <a href="#">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/socials-youtube.svg';?>" height="20px">
                    </a>
                    <a href="#">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/socials-instagram.svg';?>" height="20px">
                    </a>
                    <a href="#">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/socials-linkedin.svg';?>" height="20px">
                    </a>
                    <div class="language flex-row">
                        <img src="<?php echo get_site_url() . '/wp-content/uploads/2022/06/language-icon.svg';?>" height="20px">
                        <select name="language" id="language">
                            <option value="espanol">Español</option>
                        </select> 
                    </div>
                </div>
            </div>
            <div id="footer-menu">
                <?php
                    $footer_menu = array(
                        'theme_location' => 'footer_menu',
                        'menu_id' => 'footer-menu',
                        'menu_class' => 'footer-menu'
                    );
                    wp_nav_menu($footer_menu);
                ?>
            </div>
        </div>
    </div>
    <div id="bottom-footer">
        Copyright &copy;2022. Welia health<br>
        All rights Reserved.
    </div>
</footer>

</body>
</html>