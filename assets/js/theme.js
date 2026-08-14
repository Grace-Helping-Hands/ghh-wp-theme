(function () {
	"use strict";

	function textMatches(element, pattern) {
		return element && pattern.test((element.textContent || "").trim());
	}

	function setupOurServicesSection() {
		var serviceLabel = Array.prototype.find.call(
			document.querySelectorAll("h1, h2, h3, h4, p, strong"),
			function (element) {
				return textMatches(element, /^our services$/i);
			}
		);

		if (!serviceLabel) {
			return;
		}

		var section = serviceLabel.closest(".wp-block-group") || serviceLabel.closest("section");
		while (section && !/what.?s in the kit/i.test(section.textContent || "")) {
			section = section.parentElement && section.parentElement.closest(".wp-block-group, section");
		}

		if (!section) {
			return;
		}

		section.classList.add("ghh-services");
		serviceLabel.classList.add("ghh-services__eyebrow");

		var columns = section.querySelector(".wp-block-columns");
		if (columns) {
			columns.classList.add("ghh-services__grid");

			var columnItems = columns.querySelectorAll(":scope > .wp-block-column");
			if (columnItems[0]) {
				columnItems[0].classList.add("ghh-services__content");
			}
			if (columnItems[1]) {
				columnItems[1].classList.add("ghh-services__kit");
			}
		}

		var kitHeading = Array.prototype.find.call(
			section.querySelectorAll("h1, h2, h3, h4"),
			function (element) {
				return /what.?s in the kit/i.test(element.textContent || "");
			}
		);

		if (kitHeading) {
			kitHeading.classList.add("ghh-services__kit-heading");
		}

		var kitList = kitHeading ? kitHeading.parentElement.querySelector("ul") : section.querySelector("ul");
		if (kitList) {
			kitList.classList.add("ghh-services__kit-list");
			kitList.querySelectorAll("li").forEach(function (item) {
				item.classList.add("ghh-services__kit-item");
			});
		}

		var donateBlock = null;
		section.querySelectorAll(".wp-block-button, a").forEach(function (element) {
			if (/donate/i.test(element.textContent || "")) {
				element.classList.add("ghh-services__donate");
				if (!donateBlock && element.classList.contains("wp-block-button")) {
					donateBlock = element;
				}
			}
		});

		var contentColumn = columns && columns.querySelector(".ghh-services__content");
		if (donateBlock && contentColumn && !donateBlock.closest(".ghh-services__content")) {
			contentColumn.appendChild(donateBlock);
		}

		Array.prototype.forEach.call(section.querySelectorAll("p"), function (paragraph) {
			if (/non-discrimination|not limited to women and children/i.test(paragraph.textContent || "")) {
				paragraph.classList.add("ghh-services__note");
			}
		});
	}

	function initThemeEnhancements() {
		setupAnnouncementBanner();
		setupOurServicesSection();
	}

	function setupAnnouncementBanner() {
		var banner = document.querySelector(".site-announcement");

		if (!banner) {
			return;
		}

		var bannerId = banner.getAttribute("data-announcement-id") || "default";
		var storageKey = "ghh-announcement-dismissed-" + bannerId;

		try {
			if (window.localStorage.getItem(storageKey) === "true") {
				banner.hidden = true;
				return;
			}
		} catch (error) {
			// Continue without persistence when storage is unavailable.
		}

		var closeButton = banner.querySelector(".site-announcement__close");

		if (!closeButton) {
			return;
		}

		closeButton.addEventListener("click", function () {
			banner.hidden = true;

			try {
				window.localStorage.setItem(storageKey, "true");
			} catch (error) {
				// Dismiss visually even when storage is unavailable.
			}
		});
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", initThemeEnhancements);
	} else {
		initThemeEnhancements();
	}
})();
