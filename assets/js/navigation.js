// Simple navigation toggle for mobile (<=992px)
document.addEventListener("DOMContentLoaded", function () {
	var nav = document.getElementById("site-navigation");
	if (!nav) return;
	var button = nav.querySelector(".menu-toggle");
	var menu = document.getElementById("primary-menu");
	if (!button || !menu) return;

	// Add chevron indicators to menu items with children
	var submenuParents = nav.querySelectorAll(".menu-item-has-children > a");
	submenuParents.forEach(function (link) {
		var chevron = document.createElement("span");
		chevron.className = "menu-chevron";
		chevron.setAttribute("aria-hidden", "true");
		link.appendChild(chevron);

		// Toggle submenu when chevron is tapped/clicked while mobile menu is open
		chevron.addEventListener("click", function (ev) {
			ev.preventDefault();
			ev.stopPropagation();
			var parent = this.closest(".menu-item-has-children");
			if (!parent) return;
			// Only toggle when mobile overlay is open
			if (nav.classList.contains("toggled")) {
				parent.classList.toggle("show-submenu");
			}
		});
	});

	function openMenu() {
		button.classList.add("is-open");
		button.setAttribute("aria-expanded", "true");
		nav.classList.add("toggled");
		document.body.classList.add("no-scroll");
	}

	function closeMenu() {
		button.classList.remove("is-open");
		button.setAttribute("aria-expanded", "false");
		nav.classList.remove("toggled");
		document.body.classList.remove("no-scroll");
	}

	button.addEventListener("click", function (e) {
		var expanded = this.getAttribute("aria-expanded") === "true";
		if (expanded) {
			closeMenu();
		} else {
			openMenu();
		}
	});

	// Close when clicking outside the nav (but not the hamburger button)
	document.addEventListener("click", function (e) {
		if (!nav.classList.contains("toggled")) return;
		// Don't close if clicking the menu toggle button
		if (button.contains(e.target)) return;
		if (!nav.contains(e.target)) closeMenu();
	});

	// Close on Escape
	document.addEventListener("keydown", function (e) {
		if (
			(e.key === "Escape" || e.key === "Esc") &&
			nav.classList.contains("toggled")
		) {
			closeMenu();
		}
	});

	// Ensure menu closes when resizing to desktop
	window.addEventListener("resize", function () {
		// Close mobile menu if viewport grows to desktop size
		if (window.innerWidth >= 993 && nav.classList.contains("toggled")) {
			closeMenu();
		}
	});
});
