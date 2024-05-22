<!DOCTYPE html>
<?php include('quiz/db_connect.php') ?>
<html>
	<head>
		<?php include('includes/headerlogin.php') ?>
        <?php 
        session_start();
        if(isset($_SESSION['login_id'])){
            header('Location:dashboard');
        }
        ?>
		<title>Sunray Solar Systems</title>
	</head>

	<body id='login-body'>
                    <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                <div class="login-container">
                     <form id="login-frm" class="form-login">
                            <ul class="login-nav">
                            <li class="login-nav__item ">
                                <a href="index">Home</a>
                            </li>
                            <li class="login-nav__item active">
                                <a href="#">Sign In</a>
                            </li>
                            </ul>

                            <label class="login__label">User Name</label>
                            <input type="username" name="username"  title="User Name" placeholder="User Name" class="login__input">
                            <label class="login__label">Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="login__input" title="Password">
                            
                            <label for="login-sign-up" class="login__label--checkbox">
                            <input id="login-sign-up" onclick="myFunction()" type="checkbox" class="login__input--checkbox" />
                            Show Password
                            </label>
                            
                            <button class="login__submit" name="submit">Login</button>
                    </form>
                    <h1 class="login__forgot" onclick="alert( 'Currently we dont have forgot password feature' )">Forget Password</h1>
                </div>
            </div>

		</body>

        <script>
            $(document).ready(function(){
                $('#login-frm').submit(function(e){
                    e.preventDefault()
                    $('#login-frm button').attr('disable',true)
                    $('#login-frm button').html('Please wait...')

                    $.ajax({
                        url:'quiz/login_auth.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                            console.log(err)
                            alert('An error occured');
                            $('#login-frm button').removeAttr('disable')
                            $('#login-frm button').html('Login')
                        },
                        success:function(resp){
                            if(resp == 1){
                                location.replace('dashboard')
                            }else{
                                alert("Incorrect username or password.")
                                $('#login-frm button').removeAttr('disable')
                                $('#login-frm button').html('Login')
                            }
                        }
                    })

                })
            })

        function myFunction() {
        var x = document.getElementById("password");
            if (x.type === "password") {
                    x.type = "text";
            } else {
                    x.type = "password";
            }
        }
        </script>
</html>