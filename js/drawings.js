
var nav = document.getElementById('nav')

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY
	if (scroll_position > 5) {
        nav.style.position = 'fixed'
	} else {
		nav.style.position = 'initial'
	}
  nav.style.transition = '.6s'
});