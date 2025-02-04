<?php get_header( 'a-master' ); ?>

<div class="a_jr_pad_md wrapper" id="single-wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <div>
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php PG_Helper::rememberShownPost(); ?>
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                <header class="container entry-header">
                                    <h1><?php the_title(); ?></h1>
                                    <div class="entry-meta">
                                        <p><?php _e( 'Posted on', 'tb_theme' ); ?> <span><?php the_modified_date(); ?></span> - <?php the_terms( get_the_ID(), 'category' ); ?></p>
                                    </div>
                                </header>
                                <div class="entry-content">
                                    <?php the_content(); ?>
                                    <?php wp_link_pages( array() ); ?>
                                </div>
                                <footer class="container entry-footer">
                                    <?php if ( has_tag() ) : ?>
                                        <span class="tags-links"><?php the_tags( 'Tags: ', ', ' ); ?></span>
                                    <?php endif; ?>
                                    <?php edit_post_link( '<b class="text-success">Edit Post</b>' ); ?>
                                </footer>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php _e( 'Sorry, no posts matched your criteria.', 'tb_theme' ); ?></p>
                    <?php endif; ?>
                    <nav class="container navigation post-navigation pt-3 pb-3">
                        <h2 class="sr-only"><?php _e( 'Post navigation', 'tb_theme' ); ?></h2>
                        <div class="row nav-links justify-content-between">
                            <span class="nav-previous"><?php previous_post_link( '%link', __( '&laquo; %title', 'tb_theme' ) ); ?></span>
                            <span class="nav-next"><?php next_post_link( '%link', __( '%title &raquo;', 'tb_theme' ) ); ?></span>
                        </div>
                        <!-- .nav-links -->
                    </nav>
                    <?php if ( comments_open() || get_comments_number() || is_single() ) : ?>
                        <div class="container">
                            <?php comments_template( '/comments.php' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>