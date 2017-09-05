function searchInitAutocomplete(base_url, type) {
	jQuery("#txt_search").autocomplete( {
		source: function(request, response) {
			jQuery.ajax({
				url: base_url + "ajax_search_items.php",
				data: { q: request.term, type: type },
				dataType: "json",
				success: function( data ) {
					response( jQuery.map( data.items, function( item ) {
							return { id: item.title, label: item.title, value: item.title
						}
					}));
				}
			});
		},
		open: function (event, ui) {
			jQuery('.ui-autocomplete').css('z-index', '99999');
		}
	});
}
