<?php get_header( 'a-master' ); ?>

<div id="index-wrapper" class="a_jr_pad_md">
    <div class="container " id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <article <?php post_class( 'mb-5' ); ?> id="post-<?php the_ID(); ?>">
                            <header class="entry-header">
                                <?php if ( is_singular() ) : ?>
                                    <h2><?php the_title(); ?></h2>
                                <?php else : ?>
                                    <h2><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                                <?php endif; ?>
                                <div class="entry-meta">
                                    <p><?php _e( 'Posted on', 'tb_theme' ); ?> <?php echo get_the_date(); ?></p>
                                </div>
                            </header>
                            <?php echo PG_Image::getPostImage( null, 'thumbnail', array(
                                    'class' => 'mb-4'
                            ), 'both', null ) ?>
                            <div class="entry-content">
                                <?php the_excerpt( ); ?>
                                <a class="btn btn-primary" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e( 'Read More', 'tb_theme' ); ?></a>
                            </div>
                            <footer class="entry-footer"></footer>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                <?php endif; ?>
                <nav aria-label="Posts navigation">
                    <?php posts_nav_link( null, __( '&#xAB; Newer Posts', 'tb_theme' ), __( 'Older Posts &#xBB;', 'tb_theme' ) ); ?>
                </nav>
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>