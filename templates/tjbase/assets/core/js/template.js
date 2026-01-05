/*Carosel Mootool Conflict*/
if (typeof jQuery != 'undefined') {
(function($) {
$(document).ready(function(){
$('.carousel').each(function(index, element) {
$(this)[index].slide = null;
});
});
})(jQuery)
};
/*End*/
/*Mobile Menu*/
jQuery('.hamburger-toggle-btn').click( function() {
	jQuery('.hamburger-toggle-block').toggleClass('closed');
	jQuery('.tj-overlay').removeClass('hide');
	jQuery('body').addClass('noscroll');
});
jQuery('.hamburger-close').click( function() {
	jQuery('.hamburger-toggle-block').addClass('closed');
	jQuery('.tj-overlay').addClass('hide');
	jQuery('body').removeClass('noscroll');
});
var containercart = jQuery(".hamburger-toggle-block");
jQuery(document).ready(function(){
	jQuery(document).mouseup(function (ecart)
	{
		if ((!containercart.is(ecart.target) && containercart.has(ecart.target).length === 0))
		{
			containercart.addClass('closed');
			jQuery('.tj-overlay').addClass('hide');
			jQuery('body').removeClass('noscroll');

		};
	});
});
jQuery('.hamburger-toggle-block a.dropdown-toggle').removeAttr("href");





