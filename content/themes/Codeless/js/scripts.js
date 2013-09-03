$(document).ready(function() {
	$.fn.cleardefault = function() {
		return this.focus(function() {
			if( this.value == this.defaultValue ) {
				this.value = "";
			}
		}).blur(function() {
			if( !this.value.length ) {
				this.value = this.defaultValue;
			}
		});
	};
	
	$('input[type="text"]').cleardefault();
	$('textarea').cleardefault();
	
	$('#sidebar').find('.gform_wrapper').parent().css('background','#005091');
});