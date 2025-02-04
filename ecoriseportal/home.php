<?php get_header( 'a-master' ); ?>

<div class="a_jr_pad_md" id="home-wrapper">
    <div class="container " id="content" tabindex="-1">
        <?php if ( is_active_sidebar( 'blog_arch_sidebar' ) ) : ?>
            <div class="row">
                <div class="col-md-9 content-area" id="primary">
                    <div id="main-content">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php PG_Helper::rememberShownPost(); ?>
                                <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                    <header class="page-header">
                                        <?php if ( is_singular() ) : ?>
                                            <h2 class="entry-title"><?php the_title(); ?></h2>
                                        <?php else : ?>
                                            <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                                        <?php endif; ?>
                                        <div class="entry-meta">
                                            <?php _e( 'Posted on:', 'tb_theme' ); ?> <span><?php the_modified_date(); ?></span>
                                            <span> <?php _e( '| Posted by:', 'tb_theme' ); ?> </span>
                                            <span><?php echo get_the_author_meta( 'display_name', false ) ?></span>
                                        </div>
                                    </header>
                                    <?php echo PG_Image::getPostImage( null, 'thumbnail', array(
                                            'class' => 'blog_left_image'
                                    ), 'both', null ) ?>
                                    <div class="entry-content">
                                        <?php the_excerpt( ); ?><a class="btn btn-primary" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e( 'Read More', 'tb_theme' ); ?></a>
                                    </div>
                                    <footer class="entry-footer">
                                        <?php the_tags(); ?>
                                    </footer>
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
                <div class="col-md-3 sidebar widget-area" id="left-sidebar">
                    <aside>
                        <?php if ( is_active_sidebar( 'blog_arch_sidebar' ) ) : ?>
                            <ul class="widget_ul_outer">
                                <?php dynamic_sidebar( 'blog_arch_sidebar' ); ?>
                            </ul>
                        <?php endif; ?>
                        <div class="bg-warning">
                            <?php _e( 'Change the ID of this to #left-sidebar if you move it to the left.', 'tb_theme' ); ?>
                        </div>
                    </aside>
                </div>
            </div>
        <?php else : ?>
            <div class="content-area" id="primary">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php PG_Helper::rememberShownPost(); ?>
                        <div id="main">
                            <?php if ( have_posts() ) : ?>
                                <?php while ( have_posts() ) : the_post(); ?>
                                    <?php PG_Helper::rememberShownPost(); ?>
                                    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                        <header class="page-header">
                                            <?php if ( is_singular() ) : ?>
                                                <h2 class="entry-title"><?php the_title(); ?></h2>
                                            <?php else : ?>
                                                <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
                                            <?php endif; ?>
                                            <div class="entry-meta">
                                                <?php _e( 'Posted on:', 'tb_theme' ); ?> <span><?php the_modified_date(); ?></span>
                                                <span> <?php _e( '| Posted by:', 'tb_theme' ); ?> </span>
                                                <span><?php echo get_the_author_meta( 'display_name', false ) ?></span>
                                            </div>
                                        </header>
                                        <?php echo PG_Image::getPostImage( null, 'thumbnail', array(
                                                'class' => 'blog_left_image'
                                        ), 'both', null ) ?>
                                        <div class="entry-content">
                                            <?php the_excerpt( ); ?><a class="btn btn-primary" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e( 'Read More', 'tb_theme' ); ?></a>
                                        </div>
                                        <footer class="entry-footer">
                                            <?php the_tags(); ?>
                                        </footer>
                                    </article>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                            <?php endif; ?>
                            <nav aria-label="Posts navigation">
                                <?php posts_nav_link( null, __( '&#xAB; Newer Posts', 'tb_theme' ), __( 'Older Posts &#xBB;', 'tb_theme' ) ); ?>
                            </nav>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>