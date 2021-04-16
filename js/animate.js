/*Scroll*/
const nav = document.getElementById('nav')

document.addEventListener('scroll', () => {
	var scroll_position = window.scrollY
	if (scroll_position > 20) {
		nav.style.backgroundColor = '#29323c'
	} else {
		nav.style.backgroundColor = 'transparent'
	}
  nav.style.transition = '.6s'
});

/*Error Div Close Button*/
const closebutton = document.getElementById('closebutton')

function deleteDiv() {
  closebutton.parentElement.style.display = 'none'
}

























/*
Login -- Register slider button
var login = document.getElementById('login');
var register = document.getElementById('register');
var reglogBtn = document.getElementById('btn');

function setLoginColor () {
    document.getElementById('white1').style.color = "white";

}
document.getElementById('white1').style.color = "white"

function slideRegister() {
  login.style.left = "-400px";
  register.style.left = "50px";
  reglogBtn.style.left = "110px";
  document.getElementById('white2').style.color = "white"
  document.getElementById('white1').style.color = "black"
}

function slideLogin() {
  login.style.left = "50px";
  register.style.left = "450px";
  reglogBtn.style.left = "0";
  document.getElementById('white1').style.color = "white"
  document.getElementById('white2').style.color = "black"
}*/
