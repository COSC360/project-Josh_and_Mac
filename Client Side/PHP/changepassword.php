<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/layout.css"/>
    <!-- <script type="text/javascript" src="../script/validation.js"></script> -->
    <script type="text/javascript" src="../script/validate.js"></script>
    <script>
        function checkPasswordMatch(e) {
            // get the values of the password fields
            const password1 = document.getElementById("newpassword").value;
            const password2 = document.getElementById("confirmpass").value;
            
            // check if the passwords match
            if (password1 !== password2) {
            // if not, highlight the field and show an alert
            makeRed(document.getElementById("newpassword"));
            makeRed(document.getElementById("confirmpass"));
            alert("Passwords do not match.");
            // prevent submission of the form
            e.preventDefault();
            }
        }
</script>
</head>
<header>
    <?php session_start(); include "navbar.php";?>
</header>
<body>
	<h1>Change Password</h1>
	<div>
		<div class="columnleft">
			<form method="get" action="updatePassword.php" id="passwordForm">
                    <p>
                        <label for="username">Username: </label>
                        <input type="text" id="username" name="username" class="required">
                    </p>
                    <p>
                        <label for="oldpassword">Old Password: </label>
                        <input type="password" id="oldpassword" name="oldpassword" class="required">
                    </p>
                    <p>
                        <label for="newpassword">New Password: </label>
                        <input type="password" id="newpassword" name="newpassword" class="required">
                    </p>
                    <p>
                        <label for="confirmpass">Confirm New Password: </label>
                        <input type="password" id="confirmpass" name="confirmpass" class="required">
                    </p>
                    <button type="submit">Submit</button>
    
			</form>
            <button onclick="location.href = 'editcustomer.php';">Back</button>
		</div>
		
        </div>
        </body>
        <footer>
            <p>
                <a href="home.html">Home</a> |
                <a href="browse.html">Browse</a>
            </p>
            <p>
                <small><i>Copyright &copy; 2023 COSC 360 Project XTREME GPT</i></small>
            </p>
        </footer>
        </html>