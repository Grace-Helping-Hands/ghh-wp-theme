(function () {
	"use strict";

	function setupHowWeWorkEffect() {
		var sections = document.querySelectorAll(".wp-block-group.bg-dark-1");
		var howWeWork = Array.prototype.find.call(sections, function (section) {
			return /\bhow we work\b/i.test(section.textContent || "");
		});

		if (!howWeWork) {
			return;
		}

		howWeWork.classList.add("ghh-how-we-work");

		var columnsWrapper = howWeWork.querySelector(".wp-block-columns");
		if (columnsWrapper) {
			columnsWrapper.classList.add("ghh-how-we-work__inner");
		}

		var eyebrow = howWeWork.querySelector("p");
		if (eyebrow && /\bhow we work\b/i.test(eyebrow.textContent || "")) {
			eyebrow.classList.add("ghh-how-we-work__eyebrow");
		}

		var columns = howWeWork.querySelectorAll(".wp-block-columns > .wp-block-column");
		var introColumn = columns[0];
		var stepsColumn = columns[1];

		if (introColumn) {
			introColumn.classList.add("ghh-how-we-work__intro", "ghh-reveal", "ghh-reveal--left");
		}

		if (stepsColumn) {
			stepsColumn.classList.add("ghh-how-we-work__steps");

			var stepHeadings = stepsColumn.querySelectorAll("h3");
			stepHeadings.forEach(function (heading, index) {
				var item = document.createElement("div");
				item.className = "ghh-how-we-work__step";

				var paragraph = heading.nextElementSibling;
				heading.parentNode.insertBefore(item, heading);

				var content = document.createElement("div");
				content.className = "ghh-how-we-work__content";
				item.appendChild(content);

				content.appendChild(heading);

				if (paragraph && paragraph.tagName && paragraph.tagName.toLowerCase() === "p") {
					content.appendChild(paragraph);
				}

				item.classList.add("ghh-reveal", "ghh-reveal--right");
				item.style.setProperty("--ghh-delay", index * 140 + "ms");
			});
		}
	}

	if (document.readyState === "loading") {
		document.addEventListener("DOMContentLoaded", setupHowWeWorkEffect);
	} else {
		setupHowWeWorkEffect();
	}
})();
