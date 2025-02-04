<?php get_header( 'a-master' ); ?>

<div id="error-404-wrapper" tabindex="-1" class="a_jr_pad_md">
    <div class="container " id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div class="site-main mb-5" id="main">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'tb_theme' ); ?></h1>
                    </header>
                    <!-- .page-header -->
                    <div class="page-content">
                        <p><?php _e( 'It looks like nothing was found at this location. Try one of the links in the navigation above or a search below.', 'tb_theme' ); ?></p>
                        <?php get_search_form( true ); ?>
                        <!-- .widget -->
                    </div>
                    <!-- .page-content -->
                </section>
                <!-- .error-404 -->
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>