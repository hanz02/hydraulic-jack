$(document).ready(() => {
	const hamburger = $(".hamburger");
	const menu = $(".menu");

	hamburger.click(() => {
		hamburger.toggleClass("active");
		menu.slideToggle();
	});

	// NAV UNDERNEATH PADDING STYLING
	$("main").css("padding-top", $(".nav").outerHeight() + 50);
	$("main.base_error").css("padding-top", $(".nav").outerHeight());
	$("#admin").css("padding-top", $(".admin_nav").outerHeight());

	$(window).resize(function () {
		$("main").css("padding-top", $(".nav").outerHeight() + 50);
		$("main.base_error").css("padding-top", $(".nav").outerHeight());
		$("#admin").css("padding-top", $(".admin_nav").outerHeight());
	});

	// ADMIN NAV
	const admin_hamburger = $(".admin_hamburger");
	const side_bar = $(".side-menu");

	admin_hamburger.click(function () {
		side_bar.toggleClass("active");
	});
});
