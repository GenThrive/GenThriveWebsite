<div <?php if(empty($_GET['context']) || $_GET['context'] !== 'edit') echo get_block_wrapper_attributes( array('class' => "imgLinkBlock", ) ); else echo 'data-wp-block-props="true"'; ?>>
    <a href="<?php echo PG_Blocks::getLinkUrl( $args, 'thelink' ) ?>" class="jr_guten_btn" rel="noopener" target="_self"><div class="ppLinksWrapper <?php echo PG_Blocks::getAttribute( $args, 'bordercolor' ) ?>">
            <?php if ( !PG_Blocks::getImageSVG( $args, 'icon', false) && PG_Blocks::getImageUrl( $args, 'icon', 'medium' ) ) : ?>
                <img src="<?php echo PG_Blocks::getImageUrl( $args, 'icon', 'medium' ) ?>"/>
            <?php endif; ?>
            <?php if ( PG_Blocks::getImageSVG( $args, 'icon', false) ) : ?>
                <?php echo PG_Blocks::mergeInlineSVGAttributes( PG_Blocks::getImageSVG( $args, 'icon' ), array() ) ?>
            <?php endif; ?>
            <h3><?php echo PG_Blocks::getAttribute( $args, 'linktext' ) ?></h3>
        </div></a>
</div>