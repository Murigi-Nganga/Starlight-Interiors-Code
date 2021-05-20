// var nav = document.getElementById('nav')

// document.addEventListener('scroll', () => {
// 	var scroll_position = window.scrollY
// 	if (scroll_position > 5) {
//         nav.style.position = 'fixed'
// 	} else {
// 		nav.style.position = 'initial'
// 	}
//   nav.style.transition = '.6s'
// });

const formElements = document.querySelectorAll('#formelement');
console.log(formElements[0]);

function displayForm(number) {
        formElements[number].style.display = 'block';
}