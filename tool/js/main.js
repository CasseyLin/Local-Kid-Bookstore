(function ($) {
	'use strict';

	jQuery(document).ready(function () {

		/*=== For clickable table row ===*/
		$(".clickable-row").click(function()
		 {
		   window.location = $(this).data("href");
		 });

		/*=== For clickable div ===*/
		$(".clickable-div").click(function()
		 {
		   window.location = $(this).data("href");
		 });

		/*=== Confirmation of delete ===*/
		$('.delete').on("click", function (e) {
		    e.preventDefault();

		    var choice = confirm($(this).attr('data-confirm'));

		    if (choice) {
		        window.location.href = $(this).attr('href');
		    }
		});

		/*=== Confirmation Alert ===*/
		$('.confirm-alert').on("click", function (e) {
		    e.preventDefault();

		    var choice = confirm($(this).attr('data-confirm'));

		    if (choice) {
		        window.location.href = $(this).attr('href');
		    }
		});

		
	});


})(jQuery);