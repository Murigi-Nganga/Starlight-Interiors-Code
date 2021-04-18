/*Validation Functions*/
/*Functions return true if there is an error*/ 

const nav = document.getElementById('nav')

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY
	if (scroll_position > 5) {
		nav.style.backgroundColor = '#29323c'
        nav.style.zIndex = '100'
	} else {
		nav.style.backgroundColor = 'transparent'
	}
  nav.style.transition = '.6s'
});

//Client-Designer Sign Up Form Slider
const register  = document.getElementById('register')
const designerRegister  = document.getElementById('designer-register')
const button = document.getElementById('btn')

function clientSignUp() {
    register.style.left= '50px';
    designerRegister.style.left= '450px'
    button.style.left = '0'
}

function designerSignUp() {
    register.style.left = '-400px';
    designerRegister.style.left = '50px'
    button.style.left = '110px'
}

/*End of Slider*/

function emptyInput(...values) {                                
    let isEmpty = false
    for(let i=0;i<values.length;i++) {
        if(typeof(values[i]) === 'string' && values[i].trim().length === 0) {
            isEmpty = true
            break
        }
        if(typeof(values[i]) === 'undefined') {
            isEmpty = true
            break
        }
    }
    return isEmpty
}

function invalidNumber(myString) {     /*To be used for phone number and ID Number*/
    if (isNaN(myString) || myString.length>15 || myString.length<7) {
        return  true
    }
    return false
}

function invalidName(firstName, secondName) {
    let regExp = /^[a-zA-Z]+$/
    if ((regExp.test(firstName)) && (regExp.test(secondName))) {
        return false
    }
    return true
}

function invalidEmail(email) { 
    let regExp = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z]+.com$/
    if (regExp.test(email)) {
        return false
    }
    return true
}

function invalidPassword(password) {
    let regExp = /^(?=.*\d)(?=(.*\W){1})(?=.*[a-zA-Z])(?!.*\s).{7,15}$/
    if (regExp.test(password)) {
        return false
    }
    return true
}

function valuesMatch(value1, value2) {
    if (value1 !== value2) {
        return true;
    }
    return false
}

/**End Of Validation Functions */

/*HTML Elements*/
//const register = document.getElementById('register') ----Declared above (Line 17)
const idNumber = document.getElementById('idNumber')
const firstName = document.getElementById('firstName')
const secondName = document.getElementById('secondName')
const email = document.getElementById('email')
const phoneNo = document.getElementById('phoneNo')
const userLocation = document.getElementById('location')
const password1 = document.getElementById('password1')
const password2 = document.getElementById('password2')
const errorElement = document.getElementById('display-errors')


/**Registration Form Validation*/
if (register !== null) {                                   //Element gets assigned to null if not found

    register.addEventListener('submit', (e) => {
        let errors = []
        if(emptyInput(idNumber.value, firstName.value, secondName.value, email.value, phoneNo.value, userLocation.value, password1.value,password2.value)) {
            errors.push("<p>Please fill in all fields</p>")
        }

        if(invalidNumber(idNumber.value)) {
            errors.push("<p>Only digits are allowed for the ID Number</p>")
            idNumber.value = null
        }

        if(invalidName(firstName.value, secondName.value)) {
            errors.push("<p>Only letters are allowed for the first and second names</p>")
            firstName.value =  secondName.value = null
        }

        if(invalidEmail(email.value)) {
            errors.push("<p>Please choose a proper email</p>")
            email.value = null
        }
        
        if(invalidNumber(phoneNo.value)){
            errors.push("<p>Please choose a valid phone number</p>")
            phoneNo.value = null
        }
        
        if(invalidName(userLocation.value, 'm')) {
            errors.push("<p>The name of the location can only contain letters</p>")
            userLocation.value = null
        }

        if (invalidPassword(password1.value)) {
            errors.push("<p>Password must be between 7 and 15 characters</p>")
            errors.push("<p>Password must contain special characters such as: !,#,$,%,&</p>")
            errors.push("<p>Password must contain a number</p>")
            password1.value = password2.value = null
        }

        if(valuesMatch(password1.value, password2.value)) {
            errors.push("<p>Password values don't match</p>")
            password2.value = null
        }

        if (errors.length > 0) {
            e.preventDefault()
            errorElement.style.display = 'block'
            errors.unshift('<p id="closebutton" onclick="deleteDiv()">X</p>')
            errorElement.innerHTML  = errors.join("\n")       
        }

    }) 
}
/**End orf Registration Form Validation*/

/**Login Form Validation*/

const emailorid = document.getElementById('emailorid')
const password = document.getElementById('password')
const login = document.getElementById('login')

if (login !== null) {
    login.addEventListener('submit', (e) => {
        let errors = []
        if(emptyInput(password.value, emailorid.value)) {
            errors.push("<p>Please fill in all inputs</P>")
        }

        if (errors.length > 0) {
            e.preventDefault()
            errorElement.style.display = 'block'
            errors.unshift('<p id="closebutton" onclick="deleteDiv()">X</p>')  //Insert at index 0
            errorElement.innerHTML = errors.join("\n")
        }

    })
}
/**End of Login Form Validation */

const closebutton = document.getElementById('closebutton')

function deleteDiv() {
    errorElement.style.display = 'none'
}

function deletedbDiv() {
    closebutton.parentElement.style.display = 'none'
}