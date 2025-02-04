<?php get_header( 'a-master' ); ?>

<div id="page-wrapper" class="a_jr_pad_md wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div <?php post_class( 'container' ); ?> id="post-<?php the_ID(); ?>">
                            <div class="row">
                                <div class="col col-lg-6 col-md-8 offset-lg-3 offset-md-2">
                                    <div id="loginWrapper">
                                        <img id="loginLogo" src="<?php echo get_template_directory_uri(); ?>/a_images/Generation-Thrive-Logo-High-Res.png" class="skip-lazy" alt="EcoRise Logo"/>
                                    </div>
                                    <h2 class="h3 mb-1 text-center"><?php _e( 'Register Your Account', 'tb_theme' ); ?></h2>
                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>