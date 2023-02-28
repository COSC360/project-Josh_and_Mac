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
