$(document).ready(() => {
	console.log(window.location.pathname);
	if (window.location.pathname != "/hj-project/profile")
		sessionStorage.removeItem("onview_payment_receipt");
});
