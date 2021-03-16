const toggleSwitch = document.querySelector(
	'.theme-switcher__switch input[type="checkbox"]'
);

$(function(){
	const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)");
	const prefersLightScheme = window.matchMedia("(prefers-color-scheme: light)");

	if (prefersDarkScheme.matches) {
		$(toggleSwitch).click()
	}

	if (prefersLightScheme.matches) {
		$(toggleSwitch).click()
		
	}
})

function switchTheme(e) {

	if (e.target.checked) {
		document.documentElement.setAttribute("data-theme", "dark");
	} else {
		document.documentElement.setAttribute("data-theme", "light");
	}
}

toggleSwitch.addEventListener("change", switchTheme, false);
