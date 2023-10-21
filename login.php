<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Account Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="includes/login-inc.php">
              <h1>Login Form</h1>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              <div>
                <button type="submit" name="btn_submit" class="btn btn-primary">Log in</button>
                <button type="button" class="btn btn-danger">Lost your password?</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Doesn't have and account?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i></h1>
                  <p>©2023 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form method="POST" action="includes/login-inc.php">
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="First Name" required="" name="f_name"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Last Name" required="" name="l_name" />
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Contact Number" required="" name="contact"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Address" required="" name="address"/>
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" id="account_password"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Confirm Password" required="" name="confirm_password" ID="confirm_password"/>
              </div>
              <p id="conpasscheck" style="color: red;"></p>
              <div>
                <button type="subit" name="btn_submit_register" id="btn_submit_register" disabled="disabled" class="btn btn-primary submit">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i></h1>
                  <p>©2023 All Rights Reserved</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
        $("#conpasscheck").hide();
        let confirmPasswordError = true;
        $("#confirm_password").keyup(function () {
            validateConfirmPassword();
        });

        function validateConfirmPassword() {
        let confirmPasswordValue = $("#confirm_password").val();
        let passwordValue = $("#account_password").val();
        if (passwordValue != confirmPasswordValue) {
             $("#btn_submit_register").prop('disabled', true);
            $("#conpasscheck").show();
            $("#conpasscheck").html("Password didn't Match");
            $("#conpasscheck").css("color", "red");
            confirmPasswordError = false;
            return false;
        } else {
            $("#conpasscheck").hide();
            $("#btn_submit_register").removeAttr("disabled");
        }
    }
        
    });

    </script>
  </body>
</html>
