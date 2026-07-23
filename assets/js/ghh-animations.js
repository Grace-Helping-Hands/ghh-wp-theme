(function () {
	"use strict";

	function revealSections() {
		var items = document.querySelectorAll(".ghh-reveal");

		if (!items.length) {
			return;
		}

		if (!("IntersectionObserver" in window)) {
			items.forEach(function (item) {
				item.classList.add("is-visible");
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add("is-visible");
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.18 }
		);

		items.forEach(function (item) {
			observer.observe(item);
		});
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", revealSections);
	} else {
		revealSections();
	}
})();
