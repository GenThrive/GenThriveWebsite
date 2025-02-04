<?php get_header('a-master'); ?>

<div class="a_jr_pad_md wrapper" id="single-wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php $user_prog_id = (types_render_usermeta('user-s-service-provider-id', array('separator' => ',', 'user_current' => 'true'))); ?>
                <?php $page_ID = get_the_ID(); ?>
                <?php $user_prog_array = explode(',', $user_prog_id); ?>
                <div>
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php PG_Helper::rememberShownPost(); ?>
                            <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
                                    <div>
                                        <header class="container entry-header">
                                        </header>
                                        <div class="container entry-content">
											 
                                            <?php the_content(); ?>
                                            <?php wp_link_pages(array()); ?>
                                        </div>
                                        <footer class="container entry-footer">
                                            <?php if (has_tag()) : ?>
                                                <span class="tags-links"><?php the_tags('Tags: ', ', '); ?></span>
                                            <?php endif; ?>
                                            <?php edit_post_link('<b class="text-success">Edit Post</b>'); ?>
                                        </footer>
                                    </div>
                            </article>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php _e('Sorry, no posts matched your criteria.', 'tb_theme'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('a-master'); ?>