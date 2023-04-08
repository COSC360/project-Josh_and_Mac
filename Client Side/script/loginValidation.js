window.onload = function() {
  const loginForm = document.getElementById('loginForm');
  const signupForm = document.getElementById('signupForm');
  const loginUsername = document.getElementById('username');
  const loginPassword = document.getElementById('password');
  const signupUsername = document.getElementById('newusername');
  const signupPassword = document.getElementById('newpassword');
  const signupEmail = document.getElementById('email');
  
  loginForm.addEventListener('submit', validateLoginForm);
  signupForm.addEventListener('submit', validateSignupForm);
  
  function validateLoginForm(event) {
    event.preventDefault();
    var flag = false; 
  
    if (loginUsername.value.trim() === '') {
      loginUsername.classList.add("highlight")
      flag = true; 
    } else {
      loginUsername.classList.remove("highlight")
    }
  
    if (loginPassword.value.trim() === '') {
      loginPassword.classList.add("highlight")
      flag = true; 
    } else {
      loginPassword.classList.remove("highlight")
    }
      if(flag) { 
        alert("please enter valid data");
      }
  
    if (loginUsername.value.trim() !== '' && loginPassword.value.trim() !== '') {
      this.submit();
    }
  }
  
  function validateSignupForm(event) {
    event.preventDefault();
    var flag = false; 
  
    if (signupUsername.value.trim() === '') {
      signupUsername.classList.add("highlight")
      flag = true; 
    } else {
      signupUsername.classList.remove("highlight")
    }
  
    if (signupPassword.value.trim() === '') {
      signupPassword.classList.add("highlight")
      flag = true; 
    } else {
      signupPassword.classList.remove("highlight")
    }
  
    if (signupEmail.value.trim() === '') {
      signupEmail.classList.add("highlight")
      flag = true; 
    } else {
      signupEmail.classList.remove("highlight")
    }
  
    if(flag) { 
      alert("please enter valid data");
    }
  
    if (signupUsername.value.trim() !== '' && signupPassword.value.trim() !== '' && signupEmail.value.trim() !== '') {
      this.submit();
    }
  }};
