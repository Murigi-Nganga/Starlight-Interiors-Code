/*Validation Functions*/
/*Functions return true if there is an error*/ 


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

//console.log(valuesMatch(23, '23'))


console.log(emptyInput())
/* .     #     match anything with previous condition checking
     * (?=.*\d)         should contain at least 1 digit
     * (?=(.*\W){2})    should contain at least 2 special characters
     * (?=.*[a-zA-Z])   should contain at least 1 alphabetic character
     * (?!.*\s)         should not contain any blank space


//Date
var today = new Date()
var day = today.getDate()
var month = today.getMonth()+1
var year = today.getFullYear()

    if(day<10){
        day='0'+day
    } 
    if(month<10){
        month='0'+month
    } 

today = year+'-'+month+'-'+day;
document.getElementById("date").setAttribute("max", today);*/

function invalidExtension(fileName) {
    let extenstionName = fileName.substr(fileName.lastIndexOf('.') + 1);
    let allowedExtensions = ['jpg', 'pdf', 'png', 'img']
    let result = true
    for(let i=0;i<allowedExtensions.length;i++) {
        if(extenstionName === allowedExtensions[i]) {
            result = false
            break
        }
    }
    return result
}

//console.log(invalidExtension('myimage'))

