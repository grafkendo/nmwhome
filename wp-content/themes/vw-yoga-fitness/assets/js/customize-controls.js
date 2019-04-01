( function( api ) {

	// Extends our custom "vw-yoga-fitness" section.
	api.sectionConstructor['vw-yoga-fitness'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );