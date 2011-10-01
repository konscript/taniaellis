function find_items(widget) {
	return jQuery(widget).find('.input-list li:not(".hidden") input[type="text"]');
}

function create_new_item(widget) {
	return jQuery(widget).find('.input-list li.hidden')
		.first()
		.clone()
		.removeClass('hidden')
		.show();
}

function get_max_id(items) {
	var highest = 0;
	
	jQuery(items).each(function() {
		var curr = parse_id(this);
		if(curr > highest)
			highest = curr
	});
	
	return highest;
}

function parse_id(item) {
	var str = jQuery(item).attr('id');
	var match = str.match(/item_([0-9]+)/);
	return match[1];
}

function remove_field() { 
	var widget = jQuery(this).closest(".widget");
	var itemss = find_items(widget);

	if(jQuery(itemss).length > 0) {
		jQuery(this).parent().find("input").val('');
		jQuery(this).parent().hide();
	}
}

function add_field() {
	var widget = jQuery(this).closest('.widget');
	var wid = 'widget-' + jQuery(widget).find(widget_id_s).val();
	var idb = 'widget-' + jQuery(widget).find(widget_id_base_s).val();
	var id = jQuery(widget).find(id_s).val();
	
	var itemss = find_items(widget);
	var maxid = 1;

	if(jQuery(itemss).length > 0)
		maxid = get_max_id(itemss);
		
	var newid = maxid + 1;
		
	var new_item = create_new_item(widget);
	var input = jQuery(new_item).find('input');
	jQuery(input).attr('id', wid + '-item_' + newid);
	jQuery(input).attr('name', idb + '[' + id + '][item_' + newid +']');
	jQuery(input).val('');
	jQuery(new_item).find('a.remove-field').bind('click', remove_field);
	
	var ul = jQuery(widget).find('.input-list');
	ul.append(new_item);
}

jQuery(document).ready(function() {
	widget_id_s = 'input[name="widget-id"]';
	widget_id_base_s = 'input[name="id_base"]';
	id_s = 'input[name="widget_number"]';
	
	jQuery(".remove-field").live("click", remove_field);
	jQuery(".add_field").live("click", add_field);
});