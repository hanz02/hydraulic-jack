$(document).ready(() => {
	let profileHtml;

	function pause(milliseconds) {
		var dt = new Date();
		while (new Date() - dt <= milliseconds) {
			/* Do nothing */
		}
	}

	async function ajaxCall(url, data, method) {
		return await $.ajax({
			url: url,
			type: method,
			dataType: "json",
			data: data,
			beforeSend: function () {
				$("#image").show();
			},
		});
	}

	async function getPurchaseProd(offset) {
		try {
			return (result = await ajaxCall(
				`${base_url}payment_control/getPayHistory`,
				{ offset: offset },
				"GET"
			));
		} catch (err) {
			console.log(err);
		}
	}

	function loadProducts(result) {
		//* if result product is more than 5 (that means there are more payment to e viewed in db), we add the "view more" button at the bottom
		if (result.length >= 6) {
			result.splice(-1);
			$(".btn-view-more").addClass("show");
		} else {
			$(".btn-view-more").removeClass("show");
		}

		result.forEach((payment) => {
			const htmlStr = `<div class="purchase flex">
				<p class="f-w-heavy purchase-id">${
					payment.ID_prefix + " " + payment.payment_id
				}</p>
				<input type="hidden" name="payment_id" class="payment_id" value="${
					payment.payment_id
				}">
				<div class="purchase-img">
					${
						payment.art_data[0]
							? `<div class="img">
									<img src="${base_url}${payment.art_data[0].product_img}" alt="${payment.art_data[0].product_name}">
								</div>`
							: `<div class="img empty"></div>`
					}
					${
						payment.art_data[1]
							? `<div class="img">
									<img src="${base_url}${payment.art_data[1].product_img}" alt="${payment.art_data[1].product_name}">
								</div>`
							: `<div class="img empty"></div>`
					}
					${
						payment.art_data[2]
							? `<div class="img">
									<img src="${base_url}${payment.art_data[2].product_img}" alt="${payment.art_data[2].product_name}">
								</div>`
							: `<div class="img empty"></div>`
					}

				</div>
				<div class="purchase-body flex">
					<div class="purchase-description">
						<a href="#" class="m-top-2 m-y-sm purch-prod-name f-w-heavy">${
							payment.art_data[0].product_name
						} ${
				payment.art_data.length - 1 > 0
					? "+" + payment.art_data.length + "Others"
					: ""
			}</a>
						<p class="m-0">Date:<span class="f-w-heavy"> ${payment.payment_date}</span></p>
						<p class="m-0">Payer:<span class="f-w-heavy"> ${payment.username}</span></p>
						<button type="submit" class="btn-view-purchase m-y2">VIEW DETAILS</button>
					</div>
				</div>
			</div>
			`;

			$(htmlStr).hide().appendTo("#purchase-history-body").fadeIn(350);
		});
	}

	//* first time loading purchase history products
	getPurchaseProd()
		.then(function (x) {
			console.log(x);
			if (jQuery.isEmptyObject(x)) {
				const htmlStr = `<div class="empty-message f-middle h-100 flex">
				<h5 class="f-middle f-w-heavy">NO PRODUCT PURCHASED YET <br>
				  <a href="products" class="f-sm-ex f-w-heavy f-ls-2">START SHOPPING</a>
				</h5>
			  </div>`;
				$("#purchase-history-body").hide().html(htmlStr).fadeIn();
			} else {
				loadProducts(x);
			}
		})
		.catch((err) => console.log(err));

	$("body").on("click", ".btn-view-more button", function () {
		const to_fetch_amount = $(".purchase").length;
		if (!to_fetch_amount) {
			return;
		}
		getPurchaseProd(to_fetch_amount).then(function (x) {
			loadProducts(x);
		});
	});

	async function viewPaymentDetails(payment_id) {
		try {
			const result = await ajaxCall(
				`${base_url}payment_control/get_payment_history_receipt`,
				{
					payment_id: payment_id,
				},
				"GET"
			);

			profileHtml = $("body").html();
			$("head").append(
				`<link rel="stylesheet" href="${base_url}assets/css/payment_style.css ">`
			);
			$("body")
				.children()
				.fadeOut(100, function () {});

			$(result)
				.hide()
				.appendTo("body")
				.fadeIn(300, function () {
					navPaddingResize();
				});

			sessionStorage.setItem("onview_payment_receipt", payment_id);
		} catch (err) {
			console.log(err);
		}
	}

	//* when user click view details for receipt
	$("body").on("click", ".btn-view-purchase", function (e) {
		const payment_id = $(e.target)
			.parents(".purchase")
			.find(".payment_id")
			.val();
		viewPaymentDetails(payment_id);
	});
	$("body").on("click", ".purch-prod-name", function (e) {
		const payment_id = $(e.target)
			.parents(".purchase")
			.find(".payment_id")
			.val();
		e.preventDefault();
		viewPaymentDetails(payment_id);
	});

	if (sessionStorage.getItem("onview_payment_receipt"))
		viewPaymentDetails(sessionStorage.getItem("onview_payment_receipt"));

	$("body").on("click", "#btn-close-pay-history", function () {
		if (profileHtml) {
			sessionStorage.removeItem("onview_payment_receipt");
			$("body")
				.hide()
				.html(profileHtml)
				.fadeIn(300, function () {
					navPaddingResize();
				});
		}
	});
});
