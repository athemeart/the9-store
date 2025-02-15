/*admin css*/
( function( the9_store_api ) {

	the9_store_api.sectionConstructor['the9_store_upsell'] = the9_store_api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
