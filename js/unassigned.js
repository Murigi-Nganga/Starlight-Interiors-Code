const formElements = document.querySelectorAll('#formelement');
console.log(formElements[0]);

function displayForm(number) {
        formElements[number].style.display = 'block';
}