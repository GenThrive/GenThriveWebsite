<?php get_header( 'a-master' ); ?>

<div id="woocommerce-wrapper" class="a_jr_pad_md">
    <div class="container" id="content" tabindex="-1">
        <?php echo do_action( 'woocommerce_before_main_content' ); ?>
        <?php if ( is_shop() ) : ?>
            <div class="row">
                <div id="primary" class="col-md-9">
                    <div id="main-content">
                        <?php echo woocommerce_content(); ?>
                    </div>
                </div>
                <div class="widget-area col-md-3" role="complementary" id="right-sidebar">
                    <?php if ( is_active_sidebar( 'woo_shop' ) ) : ?>
                        <aside>
                            <?php dynamic_sidebar( 'woo_shop' ); ?>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div>
                <div id="primary">
                    <div id="main-content">
                        <?php echo woocommerce_content(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>