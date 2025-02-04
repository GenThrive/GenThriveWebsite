//all gutenberg block JS goes here

wp.domReady( function () {

  wp.blocks.unregisterBlockType( 'toolset-blocks/youtube' );
  wp.blocks.unregisterBlockType( 'core/nextpage' );
  wp.blocks.unregisterBlockType( 'core/more' );
  wp.blocks.unregisterBlockType( 'core/buttons' );
  wp.blocks.unregisterBlockType( 'toolset-blocks/heading' );
  wp.blocks.unregisterBlockType( 'toolset-blocks/container' );
  wp.blocks.unregisterBlockType( 'wp-bootstrap-blocks/button' );
  wp.blocks.unregisterBlockType( 'core/columns' );
  wp.blocks.unregisterBlockType( 'toolset-blocks/audio' );
  wp.blocks.unregisterBlockType( 'toolset-blocks/grid' );
  wp.blocks.unregisterBlockType( 'toolset-blocks/image' );

  wp.blocks.registerBlockStyle('core/image', {
    	name: 'image-border-radius',
    	label: 'Rounded Corner Small'
    }
  );
  wp.blocks.registerBlockStyle('core/image', {
      name: 'image-border-radius-lg',
    	label: 'Rounded Corner Large'
    }
  );
  wp.blocks.registerBlockStyle('wp-bootstrap-blocks/column', {
      name: 'col-border-radius',
      label: 'Rounded Corner Small'
    }
  );
  wp.blocks.registerBlockStyle('wp-bootstrap-blocks/column', {
      name: 'col-border-radius-lg',
      label: 'Rounded Corner Large'
    }
  );
  wp.blocks.registerBlockStyle('wp-bootstrap-blocks/column', {
      name: 'col-border-radius-rd-cap',
      label: 'Rounded Corner Half Circle'
    }
  );
  wp.blocks.registerBlockStyle('wp-bootstrap-blocks/column', {
      name: 'col-drop-shadow',
      label: 'Rounded Corner Drop Shadow'
    }
  );
  wp.blocks.registerBlockStyle('tb-new/plaincard', {
      name: 'drop-shadow',
      label: 'Drop Shadow'
    }
  );
  wp.blocks.registerBlockStyle('tb-new/gb-section', {
      name: 'image-border-radius',
    	label: 'Rounded Corner'
    }
  );
  wp.blocks.registerBlockStyle('core/paragraph', {
      name: 'subheader',
    	label: 'Sub Header'
    }
  );

});

  function myColumnBgColorOptions( bgColorOptions ) {
    var style = getComputedStyle(document.documentElement);
    var primary = style.getPropertyValue('--primary');
    var secondary = style.getPropertyValue('--secondary');
    var tertiary = style.getPropertyValue('--tertiary');
    var light = style.getPropertyValue('--light');
    var dark = style.getPropertyValue('--dark');
    var black = style.getPropertyValue('--black');
    var white = style.getPropertyValue('--white');
    var grayLight = style.getPropertyValue('--gray-light');
    var grayMedLight = style.getPropertyValue('--gray-med-light');
    var grayMed = style.getPropertyValue('--gray-med');
    var grayMedDark = style.getPropertyValue('--gray-med-dark');
    var grayDark = style.getPropertyValue('--gray-dark');

    bgColorOptions.length = 0; //remove default colors
  	bgColorOptions.push(
      {name: 'Primary', color: primary},
      {name: 'Secondary', color: secondary},
      {name: 'Tertiary', color: tertiary},
      {name: 'Light', color: light},
      {name: 'Dark', color: dark},
      {name: 'Black', color: black},
      {name: 'White', color: white},
      {name: 'Gray Light', color: grayLight},
      {name: 'Gray Med Light', color: grayMedLight},
      {name: 'Gray Med', color: grayMed},
      {name: 'Gray Med Dark', color: grayMedDark},
      {name: 'Gray Dark', color: grayDark},
    );
  	return bgColorOptions;
  }
  wp.hooks.addFilter(
  	'wpBootstrapBlocks.column.bgColorOptions',
  	'myplugin/wp-bootstrap-blocks/column/bgColorOptions',
  	myColumnBgColorOptions
  );
