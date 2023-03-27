window.addEventListener("load", function(){
    document.getElementById('loginForm').addEventListener('submit', function(event) {
    var username = document.getElementsByName('username')[0].value;
    var password = document.getElementsByName('password')[0].value;
    if (username ==='' || password === '') {
       event.preventDefault();
       alert('Please fill in the required highlighted fields.');
      if (username === ''){
        document.getElementsByName("username")[0].classList.add("highlight");
      }
      if (password === ""){
        document.getElementsByName("password")[0].classList.add("highlight");
      }
    }
  });
  document.getElementsByName("username")[0].addEventListener("input", function(e){
    if (this.value !==""){
        this.classList.remove("highlight");
    }
  }
  );

  document.getElementsByName("password")[0].addEventListener("input", function(e){
    if (this.value !==""){
        this.classList.remove("highlight");
    }
  }
  );
});

window.addEventListener("load", function(){
  document.getElementById('signupForm').addEventListener('submit', function(event) {
  var username = document.getElementsByName('username')[0].value;
  var password = document.getElementsByName('password')[0].value;
  var email = document.getElementsByName('email')[0].value;
  if (username === '' || password === '' || email ==='') {
     event.preventDefault();
     alert('Please fill in the required highlighted fields.');
    if (username === ''){
      document.getElementsByName("username")[1].classList.add("highlight");
    }
    if (password === ""){
      document.getElementsByName("password")[1].classList.add("highlight");
    }
    if (email === ""){
      document.getElementsByName("email")[0].classList.add("highlight");
    }
  }
});
document.getElementsByName("username")[1].addEventListener("input", function(e){
  if (this.value !==""){
      this.classList.remove("highlight");
  }
}
);
document.getElementsByName("email")[0].addEventListener("input", function(e){
  if (this.value !==""){
      this.classList.remove("highlight");
  }
}
);
document.getElementsByName("password")[1].addEventListener("input", function(e){
  if (this.value !==""){
      this.classList.remove("highlight");
  }
}
);
});
