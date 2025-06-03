<?php get_header('a-master'); ?>

<div class="a_jr_pad_md wrapper" id="single-wrapper">
    <div id="content" tabindex="-1">
        <div class="content-area" id="primary">
            <div id="main-content">
                <?php
                    $user_prog_id = (types_render_usermeta('user-s-service-provider-id', array('separator' => ',', 'user_current' => 'true')));
                    $page_ID = get_the_ID();
                    $user_prog_array = explode(',', $user_prog_id); 
                ?>
                <div class="container">
                    <?php 
                        echo render_view_template( 29377, $page_ID );
                        echo render_view_template( 22524, $page_ID );
                        if (current_user_can('administrator')) 
                            edit_post_link('<b class="text-success">Edit Post</b>');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer('a-master'); ?>