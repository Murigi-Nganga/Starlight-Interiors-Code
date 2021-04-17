
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

function invalidAmount(amount) {
	if
}

const amountPaid = document.getElementById('amountPaid')
const payform = document.getElementById('payform')
const errorElement = document.getElementById('display-errors')

payform.addEventListener('submit', (e) =>{
	let message;
	if(amountPaid.value.trim() === '' || amountPaid.value=== null) {
		message = ""
	}
	if {

	}
	if {

	}
})
