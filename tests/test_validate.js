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


const emailorid = document.getElementById('emailorid')
const password = document.getElementById('password')
const form = document.getElementById('form')

//console.log(emptyInput(emailorid.value, password.value))


form.addEventListener('submit', (e) => {
    let messages = []
    //console.log("I am running")
    if(emptyInput(emailorid.value, password.value)) {
        messages.push("Please fill in all fields")
    }

    if (messages.length > 0) {
        e.preventDefault()
        alert(messages.join("\n"))
    }
})


/*Error: Had not added .value to the id Elements*/

            /*if(errors[1] === "<p>Please fill in all fields</p>") {         //1 because I used unshift
                errorElement.innerHTML = errors[0].concat(errors[1])
            } else {
                errorElement.innerHTML  = errors.join("\n")
}*/

const myG = document.getElementById('passord')

document.getElementById('smallform').addEventListener('submit', (e) => {
    let messages = []
    if(emptyInput(myG.value)){
        messages.push("There is an empty input!!!")
    }

    if (messages.length > 0) {
        e.preventDefault()
        alert(messages.join("\n"))
    }
})

/*Error: If statements in the Requirement Form Event Listener were not working
---reqForm was NULL
}*/









