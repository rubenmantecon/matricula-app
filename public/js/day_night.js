const toggleSwitch = document.querySelector(
	'.theme-switcher__switch input[type="checkbox"]'
);

function switchTheme(e) {

	if (e.target.checked) {
		document.documentElement.setAttribute("data-theme", "dark");
	} else {
		document.documentElement.setAttribute("data-theme", "light");
	}
}

toggleSwitch.addEventListener("change", switchTheme, false);

/* $(function(){
	const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
	const prefersLightScheme = window.matchMedia("(prefers-color-scheme: light)");

	if (prefersDarkScheme.matches) {
		$(toggleSwitch).click()
	}

	if (prefersLightScheme.matches) {
		$(toggleSwitch).click()
		
	}
}) */

	toggleSwitch.addEventListener("change", switchTheme, false);



