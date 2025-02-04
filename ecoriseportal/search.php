<?php get_header( 'a-master' ); ?>

<div id="search-wrapper" class="a_jr_pad_md">
    <div class="container" id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <div id="search_box">
                    <?php get_search_form( true ); ?>
                </div>
                <h1><?php _e( 'Search Results for:', 'tb_theme' ); ?> <span><?php echo esc_html( get_search_query( false ) ); ?></span></h1>
                <p><?php echo $wp_query->found_posts.' results found.'; ?></p>
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
                <?php if ( !have_posts() ) : ?>
                    <?php get_search_form( true ); ?>
                <?php endif; ?>
            </div>
            <nav aria-label="Posts navigation">
                <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
            </nav>
        </div>
    </div>
</div>                

<?php get_footer( 'a-master' ); ?>