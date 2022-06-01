$(document).ready(() => {
	if (window.location.pathname != "/hj-project/profile")
		sessionStorage.removeItem("onview_payment_receipt");
});
