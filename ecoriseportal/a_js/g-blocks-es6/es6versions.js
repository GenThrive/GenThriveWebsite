//toggling adds a class if slected
function removeContainer(settings, name) {
	if (typeof settings.attributes !== 'undefined') {

			settings.attributes = Object.assign(settings.attributes, {
				goFullWidth: {
					type: 'boolean',
                    default: true
				},
			});

	}
	return settings;
}

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'jr/container-custom-attribute',
	removeContainer
);

const containerControls = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
		const { ToggleControl } = wp.components;
		const { InspectorControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected } = props;
		return (
			<Fragment>
				<BlockEdit {...props} />
				{isSelected &&
					<InspectorControls>
						<ToggleControl
							label={wp.i18n.__('Contian Block Width?', 'jr')}
							checked={!!attributes.goFullWidth}
                            className={"containIt"}
                            help={"When checked the block will be centered with margins on left and right."}
							onChange={(newval) => setAttributes({ goFullWidth: !attributes.goFullWidth })}
						/>
					</InspectorControls>
				}
			</Fragment>
		);
	};
}, 'coverAdvancedControls');

wp.hooks.addFilter(
	'editor.BlockEdit',
	'jr/container-control',
	containerControls
);

function containerApplyExtraClass(extraProps, blockType, attributes) {
	const { goFullWidth } = attributes;

	if (typeof goFullWidth !== 'undefined' && goFullWidth) {
		extraProps.className = extraProps.className + ' container';
	}
	return extraProps;

}

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'jr/container-apply-class',
	containerApplyExtraClass
);
// end toggling adds a class if selected

// dropdown option on all core blocks
function removeContainer(settings, name) {
	if (typeof settings.attributes !== 'undefined') {

			settings.attributes = Object.assign(settings.attributes, {
                    radioSelect: {
                      type: 'string',
                      default: 'contain',
                    },
			});

	}
	return settings;
}

wp.hooks.addFilter(
	'blocks.registerBlockType',
	'jr/container-custom-attribute',
	removeContainer
);

const containerControls = wp.compose.createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { Fragment } = wp.element;
        const { RadioControl } = wp.components;
		const { InspectorControls } = wp.blockEditor;
		const { attributes, setAttributes, isSelected } = props;

		return (
			<Fragment>
				<BlockEdit {...props} />
				{isSelected &&
					<InspectorControls>
                          <RadioControl
                              label={"Select Block Container"}
                              help="Should block be in a contianer?"
                              options={ [
                                  { label: 'Contained', value: 'contain' },
                                  { label: 'Full Width', value: 'none' },
                                  { label: 'Full Width Padded', value: 'fluid' },
                              ] }
                              onChange={ ( newval ) => setAttributes({ radioSelect: newval }) }
                              selected={attributes.radioSelect}
                          />
					</InspectorControls>
				}
			</Fragment>
		);
	};

}, 'containerControls');

wp.hooks.addFilter(
	'editor.BlockEdit',
	'jr/container-control',
	containerControls
);

function containerApplyExtraClass(extraProps, blockType, attributes) {
	const { radioSelect } = attributes;

	if (typeof radioSelect !== 'undefined') {
      if (radioSelect === 'fluid') {
		extraProps.className = extraProps.className + ' container-fluid';
      }
      else if (radioSelect === 'contain') {
        extraProps.className = extraProps.className + ' container';
      }
	}
	return extraProps;

}

wp.hooks.addFilter(
	'blocks.getSaveContent.extraProps',
	'jr/container-apply-class',
	containerApplyExtraClass
);
