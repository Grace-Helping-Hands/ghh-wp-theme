// Simple navigation toggle for mobile (<=992px)
document.addEventListener("DOMContentLoaded", function () {
	var nav = document.getElementById("site-navigation");
	if (!nav) return;
	var button = nav.querySelector(".menu-toggle");
	var menu = document.getElementById("primary-menu");
	if (!button || !menu) return;

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
		e.stopPropagation();
		var expanded = this.getAttribute("aria-expanded") === "true";
		if (expanded) closeMenu();
		else openMenu();
	});

	// Close when clicking outside the nav
	document.addEventListener("click", function (e) {
		if (!nav.classList.contains("toggled")) return;
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
		if (window.innerWidth >= 993 && nav.classList.contains("toggled")) {
			closeMenu();
		}
	});

	// Desktop submenu interactions: show on hover and focus for accessibility
	var submenuParents = nav.querySelectorAll(".menu-item-has-children");

	submenuParents.forEach(function (item) {
		item.addEventListener("mouseenter", function () {
			if (window.innerWidth >= 993) item.classList.add("show-submenu");
		});
		item.addEventListener("mouseleave", function () {
			if (window.innerWidth >= 993) item.classList.remove("show-submenu");
		});
		item.addEventListener("focusin", function () {
			if (window.innerWidth >= 993) item.classList.add("show-submenu");
		});
		item.addEventListener("focusout", function () {
			if (window.innerWidth >= 993) item.classList.remove("show-submenu");
		});
	});
});
