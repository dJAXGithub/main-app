function changeSectionCity(base_url, cityid, type, section_items_to_show, shadow_title, jcarousel_tango_skin) {
	jQuery("#section_load").html('<div class="city_loading"><img alt="" align="absmiddle" src="images/loading.gif" />&nbsp;Loading...</div>');
	jQuery.ajax({
		url: base_url + "includes/section_cities.php",
		type: "GET",
		data: "cityid=" + cityid + "&type=" + type + "&section_items_to_show=" + section_items_to_show + "&shadow_title=" + shadow_title + "&jcarousel_tango_skin=" + jcarousel_tango_skin,
		success: function(data) {
			jQuery("#div_section_cities").html(data);
		}
	});
}