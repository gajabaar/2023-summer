logincore = document.querySelector(".logincore")
loginform = document.querySelector(".loginform")
loginform.addEventListener("click", () => {
    logincore.style.display = 'block';
    loginform.style.display = 'none';
})
signupcore = document.querySelector(".signupcore")
signupform = document.querySelector(".signupform")
signupform.addEventListener("click", () => {
    signupform.style.display = 'none';
    signupcore.style.display = 'block';

})