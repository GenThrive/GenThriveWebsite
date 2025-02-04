
( function ( blocks, element, blockEditor ) {
    const el = element.createElement,
        registerBlockType = blocks.registerBlockType,
        ServerSideRender = PgServerSideRender,
        InspectorControls = blockEditor.InspectorControls,
        useBlockProps = blockEditor.useBlockProps;
        
    const {__} = wp.i18n;
    const {ColorPicker, TextControl, ToggleControl, SelectControl, Panel, PanelBody, Disabled, TextareaControl, BaseControl} = wp.components;
    const {useSelect} = wp.data;
    const {RawHTML, Fragment} = element;
   
    const {InnerBlocks, URLInputButton, RichText} = wp.blockEditor;
    const useInnerBlocksProps = blockEditor.useInnerBlocksProps || blockEditor.__experimentalUseInnerBlocksProps;
    
    const propOrDefault = function(val, prop, field) {
        if(block.attributes[prop] && (val === null || val === '')) {
            return field ? block.attributes[prop].default[field] : block.attributes[prop].default;
        }
        return val;
    }
    
    const block = registerBlockType( 'tb-theme/gb-section', {
        apiVersion: 2,
        title: 'Background Section',
        icon: 'welcome-widgets-menus',
        category: 'custblocks',
        keywords: [ __('padding'), __('margin'), __('background color') ],
        supports: {color: {background: true,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: true,align: false,},
        attributes: {
            margin_top: {
                type: 'text',
                default: 'mt-3',
            },
            margin_bottom: {
                type: 'text',
                default: 'mb-3',
            },
            padding_top: {
                type: 'text',
                default: 'pt-3',
            },
            padding_bottom: {
                type: 'text',
                default: 'pb-3',
            }
        },
        example: { attributes: { margin_top: 'mt-3', margin_bottom: 'mb-3', padding_top: 'pt-3', padding_bottom: 'pb-3' } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'border-none gbSection' });
            const setAttributes = props.setAttributes; 
            
            
            const innerBlocksProps = useInnerBlocksProps({ className: 'gbSection ' + propOrDefault( props.attributes.padding_top, 'padding_top' ) + ' ' + propOrDefault( props.attributes.padding_bottom, 'padding_bottom' ) }, {
            } );
                            
            
            return el(Fragment, {}, [
                el('div', { ...blockProps }, el('div', { className: 'cardWrapper ' + propOrDefault( props.attributes.margin_top, 'margin_top' ) + ' ' + propOrDefault( props.attributes.margin_bottom, 'margin_bottom' ) }, el('div', { ...innerBlocksProps }))),                        
                
                    el( InspectorControls, {},
                        [
                            
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    el(SelectControl, {
                                        value: props.attributes.margin_top,
                                        label: __( 'Margin Top' ),
                                        onChange: function(val) { setAttributes({margin_top: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'mt-0', label: '0' },
                                            { value: 'mt-1', label: '1' },
                                            { value: 'mt-2', label: '2' },
                                            { value: 'mt-3', label: '3' },
                                            { value: 'mt-4', label: '4' },
                                            { value: 'mt-5', label: '5' },
                                            { value: 'mt-6', label: '6' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.margin_bottom,
                                        label: __( 'Margin Bottom' ),
                                        onChange: function(val) { setAttributes({margin_bottom: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'mb-0', label: '0' },
                                            { value: 'mb-1', label: '1' },
                                            { value: 'mb-2', label: '2' },
                                            { value: 'mb-3', label: '3' },
                                            { value: 'mb-4', label: '4' },
                                            { value: 'mb-5', label: '5' },
                                            { value: 'mb-6', label: '6' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.padding_top,
                                        label: __( 'Padding Top' ),
                                        onChange: function(val) { setAttributes({padding_top: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'pt-0', label: '0' },
                                            { value: 'pt-1', label: '1' },
                                            { value: 'pt-2', label: '2' },
                                            { value: 'pt-3', label: '3' },
                                            { value: 'pt-4', label: '4' },
                                            { value: 'pt-5', label: '5' },
                                            { value: 'pt-6', label: '6' }
                                        ]
                                    }),
                                    el(SelectControl, {
                                        value: props.attributes.padding_bottom,
                                        label: __( 'Padding Bottom' ),
                                        onChange: function(val) { setAttributes({padding_bottom: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'pb-0', label: '0' },
                                            { value: 'pb-1', label: '1' },
                                            { value: 'pb-2', label: '2' },
                                            { value: 'pb-3', label: '3' },
                                            { value: 'pb-4', label: '4' },
                                            { value: 'pb-5', label: '5' },
                                            { value: 'pb-6', label: '6' }
                                        ]
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

        save: function(props) {
            const blockProps = useBlockProps.save({ className: 'border-none gbSection' });
            return el('div', { ...blockProps }, el('div', { className: 'cardWrapper ' + propOrDefault( props.attributes.margin_top, 'margin_top' ) + ' ' + propOrDefault( props.attributes.margin_bottom, 'margin_bottom' ) }, el('div', { className: 'gbSection ' + propOrDefault( props.attributes.padding_top, 'padding_top' ) + ' ' + propOrDefault( props.attributes.padding_bottom, 'padding_bottom' ) }, el(InnerBlocks.Content, {}))));
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
