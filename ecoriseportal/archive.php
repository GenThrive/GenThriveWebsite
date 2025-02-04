<?php get_header( 'a-master' ); ?>

<div id="archive-wrapper" class="a_jr_pad_md">
    <div class="container " id="content" tabindex="-1">
        <div id="primary">
            <div class="row">
                <div class="col-md-8 content-area" id="primary">
                    <div id="main-content">
                        <div>
                            <header class="page-header mb-4">
                                <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
                                <?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
                            </header>
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
                </div>
                <div class="col-md-4" role="complementary" id="right-sidebar">
                    <aside>
                        <?php if ( is_active_sidebar( 'archive_widgets' ) ) : ?>
                            <div class="side_category">
                                <?php dynamic_sidebar( 'archive_widgets' ); ?>
                            </div>
                        <?php endif; ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>