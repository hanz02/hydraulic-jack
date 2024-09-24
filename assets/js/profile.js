//* fade in profile image on first load
//* if image loaded from cache, on.('load') will not be triggerd so we directly fade it in
function loadProfileImage(profileHTML) {
	if ($(profileHTML)[0].complete) {
		$(".loading-gif").fadeOut(1000, function () {
			$(profileHTML).fadeIn(350);
		});
	} else {
		$(profileHTML).on("load", function () {
			$(".loading-gif").fadeOut(1000, function () {
				$(profileHTML).fadeIn(350);
			});
		});
	}
}

function loadBgImage() {
	const bg = $(".bg-container");
	//* LOAD BACKGROUD IMAGE
	$.ajax({
		url: base_url + "profile_control/loadBgUser",
		type: "get",
		cache: false,
		success: function (data) {
			if (data != false) {
				console.log(data);
				var bg_data = JSON.parse(data);

				if (bg_data.bg_state == "1") {
					bg.css("display", "none");
					const bgimage = new Image();
					bgimage.onload = function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + bg_data.bg_img + ")"
						);
						bg.fadeIn(1200);
					};
					bgimage.src = base_url + "/assets/img/bg_img/" + bg_data.bg_img;
				} else {
					bg.css("background-image", "url(" + base_url + bg_data.bg_img + ")");
					bg.fadeIn(2000);
				}
			} else {
				alert("Error loading backgroung image");
			}
		},
	});
}

$(document).ready(() => {
	const profileHTML = $(".user-profile")[0]
		? $(".user-profile")
		: $(".default_profile");
	var bgImgForm = $("#profile-bg-form");
	var bg = $(".bg-container");

	//* fade in and load profile and bg
	loadProfileImage(profileHTML);
	loadBgImage();

	//* USER UPLOAD PROFILE IMAGE
	$("body").on("click", "#profileUploadButton", function () {
		$("#profileImgFileInput").trigger("click");
	});

	$("body").on("change", "#profileImgFileInput", function () {
		const imgFile = $("#profileImgFileInput");

		if (imgFile) {
			$("#profile-img-form").submit();
		}
	});

	//* USER UPLOAD IMAGE SUBMIT FORM
	$("body").on("submit", "#profile-img-form", function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeProfileImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			beforeSend: function () {
				const profileHTML = $(".user-profile")[0]
					? $(".user-profile")
					: $(".default_profile");

				$(profileHTML).fadeOut(100);
					$(".loading-gif").fadeIn(100);

			},
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					$(".loading-gif").fadeOut(100, () => {
						$(".user-profile").fadeIn(100);
					});
					alert(data);
				} else if (data != false) {
					const profileHTML = $(".user-profile")[0]
						? $(".user-profile")
						: $(".default_profile");
						
					$(".loading-gif").promise().done(function(){
						$(".loading-gif").delay(1000).fadeOut(1000, function () {
							profileHTML.attr(
								"src",
								base_url + "assets/img/profile_img/" + data
							);
							profileHTML.removeClass("default_profile");
	
							$(profileHTML).fadeIn(350);
						});
					});


					//* update profile image for navbar mini profile as well
					$(".profile-btn > img").attr(
						"src",
						base_url + "assets/img/profile_img/" + data
					);
					$(".profile-btn").removeClass("default");
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});

	//* UPLOAD BACKGROUD IMAGE
	$("body").on("click", `#bgUploadButton`, function () {
		$("#bgFileInput").trigger("click");
	});

	$("body").on("change", "#bgFileInput", function () {
		const imgFile = $("#bgFileInput");

		if (imgFile) {
			bgImgForm.submit();
		}
	});

	$("body").on("submit", "#profile-bg-form", function (e) {
		e.preventDefault();

		$.ajax({
			url: base_url + "profile_control/changeBgImg",
			type: "post",
			data: new FormData(this),
			processData: false,
			contentType: false,
			cache: false,
			success: function (data) {
				if (data == "INVALID FILE UPLOAD") {
					alert(data);
				} else if (data != false) {
					bg.css("display", "none");
					const bgimage = new Image();
					bgimage.onload = function () {
						bg.css(
							"background-image",
							"url(" + base_url + "/assets/img/bg_img/" + data + ")"
						);
						bg.fadeIn(1200);
					};
					bgimage.src = base_url + "/assets/img/bg_img/" + data;
				} else {
					alert("UPLOAD UNSUCCESSFUL, PLEASE TRY AGAIN");
				}
			},
		});
	});
});
