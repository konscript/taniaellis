jQuery(document).ready(function() {
	jQuery('#te_event-options-start-date').datepicker({
		dateFormat: '@',
		showButtonPanel: true,
		onSelect: function() {
			fixTime(this);
		}
	});
	
	jQuery('#te_event-options-end-date').datepicker({
		dateFormat: '@',
		showButtonPanel: true,
		onSelect: function() {
			fixTime(this);
		}
	});
});

function fixTime(field){
	jQuery(field).val((jQuery(field).val()/1000));
}