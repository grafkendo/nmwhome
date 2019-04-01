// License: GPLv2+

	var el = wp.element.createElement;
	var registerBlockType 		= wp.blocks.registerBlockType;
	var ServerSideRender 		= wp.components.ServerSideRender;
	var TextControl 			= wp.components.TextControl;
	var InspectorControls 		= wp.editor.InspectorControls;
	//var InspectorControls 	= wp.blocks.InspectorControls;
	var ToggleControl     		= wp.components.ToggleControl; 	
	var RangeControl    		= wp.components.RangeControl; 
	
	//var Editable          = wp.blocks.Editable; // For creating editable elements.

/*
 * Here's where we register the block in JavaScript.
 *
 * It's not yet possible to register a block entirely without JavaScript, but
 * that is something I'd love to see happen. This is a barebones example
 * of registering the block, and giving the basic ability to edit the block
 * attributes. (In this case, there's only one attribute, 'foo'.)
 */
registerBlockType( 'amazon-pip/amazon-grid', {
	title: 'Amazon Grid Block',
	icon: 'cart',
	category: 'widgets',

	/*
	 * In most other blocks, you'd see an 'attributes' property being defined here.
	 * We've defined attributes in the PHP, that information is automatically sent
	 * to the block editor, so we don't need to redefine it here.
	 */

	edit: function( props ) {
		if(props.attributes.asin == ''){
			return null;
		}else{
			return [
				/*
				 * The ServerSideRender element uses the REST API to automatically call
				 * php_block_render() in your PHP code whenever it needs to get an updated
				 * view of the block.
				 */
				el( ServerSideRender, {
					block: 'amazon-pip/amazon-grid',
					attributes: props.attributes,
				} ),
				/*
				 * InspectorControls lets you add controls to the Block sidebar. In this case,
				 * we're adding a TextControl, which lets us edit the 'foo' attribute (which
				 * we defined in the PHP). The onChange property is a little bit of magic to tell
				 * the block editor to update the value of our 'foo' property, and to re-render
				 * the block.
				 */
				el( InspectorControls, {},
					el( TextControl, {
						label: 'ASIN(s)',
						value: props.attributes.asin,
						onChange: ( value ) => { props.setAttributes( { asin: value } ); },
					} ),
					el( RangeControl, {
						label: '# Columns',
						value: void '' !== props.attributes.columns ? props.attributes.columns : 3,
						min: 1,
						max: 8,
						onChange: ( value ) => { props.setAttributes( { columns: value } ); },
					} ),
					el( ToggleControl,{
						label: 'New Window',
						checked: props.attributes.newWindow,
						value: true,
						onChange: ( value ) => { props.setAttributes( { newWindow: value } ); },
					} ),
					el( TextControl, {
						label: 'Fields',
						value: void '' !== props.attributes.fields ? props.attributes.fields : 'image,title,new-button',
						onChange: ( value ) => { props.setAttributes( { fields: value } ); },
					} )
				),
			];			
		}

	},

	// We're going to be rendering in PHP, so save() can just return null.
	save: function() {
		return null;
	},
} );
