// NAV UNDERNEATH PADDING STYLING
function navPaddingResize() {
	$("main").css("padding-top", $(".nav").outerHeight() + 50);
	$("main.base_error").css("padding-top", $(".nav").outerHeight());
	$("#admin").css("padding-top", $(".admin_nav").outerHeight());
}

$(document).ready(() => {
	$("body").on("click", ".hamburger", (e) => {
		$(".hamburger").toggleClass("active");
		$(".menu").slideToggle();
	});

	navPaddingResize();
	$(window).resize(navPaddingResize);

	// ADMIN NAV
	const admin_hamburger = $(".admin_hamburger");
	const side_bar = $(".side-menu");

	admin_hamburger.click(function () {
		side_bar.toggleClass("active");
	});
	$("body").on("click", ".profile-menu", function () {
		sessionStorage.removeItem("onview_payment_receipt");
	});
});
