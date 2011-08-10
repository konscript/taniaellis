jQuery(document).ready(function() {
	jQuery(".add_field").bind('click', function() {
		var widget = jQuery(this).closest(".widget");
		var widget_id = 'widget-' + jQuery(widget).find('input[name="widget-id"]').val();
		var id_base = 'widget-' + jQuery(widget).find('input[name="id_base"]').val();
		var id = jQuery(widget).find('input[name="widget_number"]').val();
		var count = parseInt(jQuery(widget).find('#' + widget_id + '-itemCount').val());
		count++;
	
		var p = jQuery(this).parent();
		var ul = jQuery(p).find('ul');
		var last = jQuery(ul).children().last();
		var li = jQuery(last).clone();
		var input = jQuery(li).find('input');
		jQuery(input).attr('id', widget_id + '-item_' + count);
		jQuery(input).attr('name', id_base + '[' + id +'][item_' + count +']');
		jQuery(input).val('');
		jQuery(li).find('a').bind('click', remove_field);
		jQuery(ul).append(li);
	
		jQuery(widget).find('#' + widget_id + '-itemCount').val(count);
	});
	
	jQuery(".remove-field").bind('click', remove_field);
	
	function remove_field() { 
		var widget = jQuery(this).closest(".widget");
		var widget_id = 'widget-' + jQuery(widget).find('input[name="widget-id"]').val();
		var itemCount = jQuery(widget).find('#' + widget_id + '-itemCount');
		count = parseInt(jQuery(itemCount).val());
		
		if(count > 1) {
			count--;
			jQuery(itemCount).val(count);

			jQuery(this).parent().find("input").val('');
			jQuery(this).parent().hide();
		}
	}
	
	var field = '.icon-upload-field';
	
	function start_upload(btn) {
		formfield = jQuery(widget).find(field).attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	}
	
	window.send_to_editor = function(html) {
	 imgurl = jQuery('img',html).attr('src');
	 jQuery(widget).find(field).val(imgurl);
	 tb_remove();
	}
	
});