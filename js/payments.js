
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

/*function invalidAmount(amount) {
	if
}*/

const amountPaid = document.getElementById('amountPaid')
const payform = document.getElementById('payform')
const errorElement = document.getElementById('display-errors')

payform.addEventListener('submit', (e) =>{
	let messages = []
	if (amountPaid.value.trim() === '' || amountPaid.value=== null) {
		messages.push('Please fill in the amount that you have paid<br>')
	}
	if (amountPaid.value < 2000) {
		messages.push('Amount below Ksh 1000 is not allowed<br>')
		amountPaid.value = null
	}
	if(messages.length > 0) {
		e.preventDefault()
		window.scrollTo(0, 0)
		errorElement.style.display = 'block'
		messages.unshift('<p id="closebutton" onclick="deleteDiv()">X</p>')
		errorElement.innerHTML = messages.join("")
	}
})

function deleteDiv() {
    errorElement.style.display = 'none'
}