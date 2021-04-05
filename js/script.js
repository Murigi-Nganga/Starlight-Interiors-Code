var login = document.getElementById('login');
var register = document.getElementById('register');
var reglogBtn = document.getElementById('btn');

function slideRegister() {
  login.style.left = "-400px";
  register.style.left = "50px";
  reglogBtn.style.left = "110px";
}

function slideLogin() {
  login.style.left = "50px";
  register.style.left = "450px";
  reglogBtn.style.left = "0";
}