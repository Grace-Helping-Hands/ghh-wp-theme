// Simple navigation toggle for mobile (<=992px)
document.addEventListener("DOMContentLoaded", function () {
	var nav = document.getElementById("site-navigation");
	if (!nav) return;
	var button = nav.querySelector(".menu-toggle");
	var menu = document.getElementById("primary-menu");
	if (!button || !menu) return;

	button.addEventListener("click", function () {
		var expanded = this.getAttribute("aria-expanded") === "true";
		this.setAttribute("aria-expanded", String(!expanded));
		nav.classList.toggle("toggled");
	});
});
