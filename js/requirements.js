/*Validation Functions*/
/*Functions return true if there is an error*/ 

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

function invalidBudget(myString, minValue) {     /*To be used for the budget*/
    if (isNaN(myString)) {
        return  [true,1]
    }
    if(parseInt(myString)<minValue) {
        return [true,2]
    }
    return false
}

function invalidName(...values) {
    let regExp = /^[ a-zA-Z ]+$/
    let result = false
    for(let i=0;i<values.length;i++) {
        if (regExp.test(values[i]) === false) {
            result = true
            break
        }
    }
    return result
}

function invalidSize(roomSize) {
    let regExp = /^[ a-zA-Z0-9]+$/
    if(regExp.test(roomSize)) {
        return false
    }
    return true
}

function invalidExtension(fileName) {
    let extenstionName = fileName.substr(fileName.lastIndexOf('.') + 1);
    let allowedExtensions = ["jpg", "pdf", "png", "img", "jpeg"]
    let result = true
    for(let i=0;i<allowedExtensions.length;i++) {
        if(allowedExtensions[i] === extenstionName) {
            result = false
            break
        }
    }
    console.log(result)
    return result
}

const reqform = document.getElementById('reqform')
const typeofroom = document.getElementById('typeofroom') 
const roompic = document.getElementById('roompic') 
const approxsize = document.getElementById('approxsize') 
const colors = document.getElementById('colors')
const discolors = document.getElementById('discolors')
const inspopic = document.getElementById('inspopic')
const specialneeds = document.getElementById('specialneeds')
const budget = document.getElementById('budget')
const errorElement = document.getElementById('display-errors')


if (reqform !== null) {                                  
    reqform.addEventListener('submit', (e) => {  
       let messages = []

        if(emptyInput(typeofroom.value, approxsize.value, colors.value, discolors.value, specialneeds.value, budget.value)) {
            messages.push("Please fill in all fields<br>")
        }

        if(invalidName(typeofroom.value)) {
            messages.push("Only letters are allowed for the type of room<br>")
            typeofroom.value = null
        }

        if(invalidExtension(roompic.value)) {
            messages.push("Type of file is not allowed<br>")
            roompic.value = null
        }

        if(invalidSize(approxsize.value)) {
            messages.push("Only letters and numbers are allowed<br>")
            approxsize.value = null
        }

        if(invalidName(colors.value.replaceAll(',',''))) {
            messages.push("Only letters are allowed for colors<br>")
            colors.value = null
        }

        if(invalidName(discolors.value.replaceAll(',',''))) {
            messages.push("Only letters are allowed for colors<br>")
            discolors.value = null
        }

        if(invalidExtension(inspopic.value)) {
            messages.push("Type of file is not allowed<br>")
            inspopic.value = null
        }

        if(invalidBudget(budget.value, 2000)[0]){
            if(invalidBudget(budget.value, 2000)[1] === 1) {
                messages.push("Please enter digits only<br>")
                budget.value = null
            } else {
                messages.push("We encourage a budget of more than Ksh 2000<br>")
                budget.value = null
            }
        }
        
        if (messages.length > 0) {
            window.scrollTo(0, 0)
            // window.location.href = 'http://localhost/Starlight-Interiors-Code/php/requirements.php#show';
            e.preventDefault()
            if(messages[0] === "Please fill in all fields<br>") {
                messages = messages.splice(0,1)
            }
            messages.unshift('<p id="closebutton" onclick="deleteDiv()">X</p>')
            errorElement.style.display = 'block'
            errorElement.innerHTML = messages.join("")
        }
    }) 
}

function deleteDiv() {
    errorElement.style.display = 'none'
}


