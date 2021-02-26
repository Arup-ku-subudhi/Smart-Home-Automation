 <!DOCTYPE html>

<?php include('server.php'); ?>

<html>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 350px;
  border-radius:10px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>

</head>
<body>
    <div id="login">
        <h2 class="text-center text-dark pt-5 display-3"><strong>LOGIN YOUR HOME</strong></h2>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="s_login.php" method="post">
                            <h2 class="text-center text-dark">Your Smart Home</h2>
                            <div class="form-group">
                                <label for="username" class="text-info"><strong>EM@IL ID</strong></label><br>
                                <input type="text" name="email" id="username" placeholder="Enter your email ID" value="<?php echo "";?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info"><strong>OTP</strong></label>
								<button name="gotp" class="btn btn-info btn-sm ml-2" value="Generate OTP">Generate OTP</button>
								<br>
                                <input type="password" name="otp" id="password" placeholder="Enter OTP sent in email" value="<?php echo "";?>" class="mt-3 form-control">
                            </div>
                            <div class="form-group">
								<input type="submit" name="login" class="btn btn-primary btn-md " value="Login">
								<input type="button" name="gotp" class="btn btn-danger btn-md ml-4" value="Resend OTP">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>