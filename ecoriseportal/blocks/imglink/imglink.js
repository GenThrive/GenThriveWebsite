
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
    
    const block = registerBlockType( 'tb-theme/imglink', {
        apiVersion: 2,
        title: 'Button With Icon',
        icon: 'block-default',
        category: 'custblocks',
        keywords: [],
        supports: {color: {background: false,text: false,gradients: false,link: false,},typography: {fontSize: false,},anchor: false,align: false,},
        attributes: {
            thelink: {
                type: 'object',
                default: {post_id: 0, url: '#', title: '', 'post_type': null},
            },
            bordercolor: {
                type: 'text',
                default: 'border-transparent',
            },
            icon: {
                type: 'object',
                default: {id: 0, url: (pg_project_data_tb_theme ? pg_project_data_tb_theme.url : '') + 'a_images/Air%20Quality%20Icon.png', size: ''},
            },
            linktext: {
                type: 'text',
                default: `Air Quality`,
            }
        },
        example: { attributes: { thelink: {post_id: 0, url: '#', title: '', 'post_type': null}, bordercolor: 'border-transparent', icon: {id: 0, url: (pg_project_data_tb_theme ? pg_project_data_tb_theme.url : '') + 'a_images/Air%20Quality%20Icon.png', size: ''}, linktext: `Air Quality` } },
        edit: function ( props ) {
            const blockProps = useBlockProps({ className: 'imgLinkBlock' });
            const setAttributes = props.setAttributes; 
            
            props.icon = useSelect(function( select ) {
                return {
                    icon: props.attributes.icon.id ? select('core').getMedia(props.attributes.icon.id) : undefined
                };
            }, [props.attributes.icon] ).icon;
            
            const innerBlocksProps = null;
            
            
            return el(Fragment, {}, [
                el('div', { ...blockProps }, el('a', { href: '#', rel: 'noopener', target: '_self' }, el('div', { className: 'ppLinksWrapper ' + propOrDefault( props.attributes.bordercolor, 'bordercolor' ) }, [props.attributes.icon && props.attributes.icon.svg && pgCreateSVG(RawHTML, {}, pgMergeInlineSVGAttributes(propOrDefault( props.attributes.icon.svg, 'icon', 'svg' ), {})), props.attributes.icon && !props.attributes.icon.svg && propOrDefault( props.attributes.icon.url, 'icon', 'url' ) && el('img', { src: propOrDefault( props.attributes.icon.url, 'icon', 'url' ) }), el(RichText, { tagName: 'h3', value: propOrDefault( props.attributes.linktext, 'linktext' ), onChange: function(val) { setAttributes( {linktext: val }) }, withoutInteractiveFormatting: true, allowedFormats: [] })]))),                        
                
                    el( InspectorControls, {},
                        [
                            
                        pgMediaImageControl('icon', setAttributes, props, 'medium', true, 'Link Icon', '' ),
                                        
                            el(Panel, {},
                                el(PanelBody, {
                                    title: __('Block properties')
                                }, [
                                    
                                    pgUrlControl('thelink', setAttributes, props, 'Link to Page', '', null ),
                                    el(SelectControl, {
                                        value: props.attributes.bordercolor,
                                        label: __( 'bordercolor' ),
                                        onChange: function(val) { setAttributes({bordercolor: val}) },
                                        options: [
                                            { value: '', label: '-' },
                                            { value: 'border-transparent', label: 'Transparent' },
                                            { value: 'border-primary', label: 'Primary' },
                                            { value: 'border-secondary', label: 'Secondary' },
                                            { value: 'border-tertiary', label: 'Tertiary' },
                                            { value: 'border-green-light', label: 'Light Green' },
                                            { value: 'border-white', label: 'White' },
                                            { value: 'border-black', label: 'Black' },
                                            { value: 'border-gray-light', label: 'Light Gray' },
                                            { value: 'border-gray-med', label: 'Med Gray' },
                                            { value: 'border-gray-dark', label: 'Dark Gray' }
                                        ]
                                    }),
                                    el(TextControl, {
                                        value: props.attributes.linktext,
                                        help: __( '' ),
                                        label: __( 'Text of Button' ),
                                        onChange: function(val) { setAttributes({linktext: val}) },
                                        type: 'text'
                                    }),    
                                ])
                            )
                        ]
                    )                            

            ]);
        },

        save: function(props) {
            const blockProps = useBlockProps.save({ className: 'imgLinkBlock' });
            return el('div', { ...blockProps }, el('a', { href: propOrDefault( props.attributes.thelink.url, 'thelink', 'url' ), rel: 'noopener', target: '_self' }, el('div', { className: 'ppLinksWrapper ' + propOrDefault( props.attributes.bordercolor, 'bordercolor' ) }, [props.attributes.icon && props.attributes.icon.svg && pgCreateSVG(RawHTML, {}, pgMergeInlineSVGAttributes(propOrDefault( props.attributes.icon.svg, 'icon', 'svg' ), {})), props.attributes.icon && !props.attributes.icon.svg && propOrDefault( props.attributes.icon.url, 'icon', 'url' ) && el('img', { src: propOrDefault( props.attributes.icon.url, 'icon', 'url' ) }), el(RichText.Content, { tagName: 'h3', value: propOrDefault( props.attributes.linktext, 'linktext' ) })])));
        }                        

    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor
);                        
