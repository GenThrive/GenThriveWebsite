<footer id="jr_wrapper_footer"> 
    <div class="bg-gray-med-dark container text-white"> 
        <div class="pb-2 pt-2 row"> 
            <div class="col-lg-4"> 
                <img id="jr_foot_logo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-High-Res.png" alt="Gen:Thrive Footer Logo"/> 
                <p class="about"><?php _e( 'Gen:Thrive is a collaborative initiative to accelerate sustainability and environmental education programs in K&ndash;12 schools.&nbsp;', 'tb_theme' ); ?></p> 
            </div>             
            <div class="col-lg-4 mb-1 mb-lg-0"> 
                <div id="footLinks"> 
                    <div class="title">
                        <?php _e( 'Featured', 'tb_theme' ); ?>
                    </div>                     
                    <?php if ( has_nav_menu( 'footer' ) ) : ?>
                        <?php
                                        PG_Smart_Walker_Nav_Menu::$options['template'] = '<li id="{ID}" class="{CLASSES}"> <a {ATTRS}>{TITLE}</a> 
                                                                            </li>';
                                        wp_nav_menu( array(
                                            'container' => '',
                                            'theme_location' => 'footer',
                                            'items_wrap' => '<ul class="%2$s footMenu" id="%1$s">%3$s</ul>',
                                            'walker' => new PG_Smart_Walker_Nav_Menu()
                                    ) ); ?>
                    <?php endif; ?> 
                </div>                 
            </div>             
            <div class="col-lg-4 mb-1 mb-lg-0"> 
                <div class="text-secondary title">
                    <?php _e( 'Gen:Thrive is a program of&nbsp;', 'tb_theme' ); ?>
                </div>                 
                <div class="address"> 
                    <div class="font-weight-bold">
                        <?php _e( 'EcoRise', 'tb_theme' ); ?>
                    </div>                     <a href="https://www.google.com/url?q=https://www.google.com/maps/place/EcoRise/@30.2674947,-97.6952531,17z/data%3D!3m1!4b1!4m5!3m4!1s0x8644b680072295ab:0x7f22e68581468d77!8m2!3d30.2674947!4d-9&amp;sa=D&amp;source=docs&amp;ust=1645037862434769&amp;usg=AOvVaw0hHCSpfbpfSNrNOah5voH9" target="_blank"><?php _e( 'PO Box 152942', 'tb_theme' ); ?> <br/><?php _e( 'Austin, TX 78715', 'tb_theme' ); ?></a> <br/> <a href="https://www.ecorise.org/"><?php _e( 'www.ecorise.org', 'tb_theme' ); ?></a> <br/> 
                </div>                 
                <div id="copyRight">&copy; 
                    <?php echo date('Y'); ?> 
                    <?php _e( 'EcoRise. All Rights Reserved.', 'tb_theme' ); ?>
                </div>                 
            </div>             
        </div>         
    </div>     
    <!-- container end -->     
</footer>
<?php wp_footer(); ?>
