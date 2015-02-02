<!DOCTYPE html>
<html lang="en">
	<head>
	<title>Bootstrap 101 Template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
	<!-- Custom CSS-->
	<link href="css/screen.css" rel="stylesheet" media="screen"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
        float:left;
      }
      #errors
		{
			margin:0px;
			padding-bottom:10px;
		}
	#float
	{
		float:left;	
	}
    </style>
    

</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
   <button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
    </button>
    <div class="nav-collapse collapse pull-right">
      <ul class="nav">
        <li><a href="#" id="nav-links"><i class="icon-share-alt icon-white"></i><span>Main Website</span></a></li>
        <li><a href="#" id="nav-links"><i class="icon-plus icon-white"></i><span>Register</span></a></li>
      </ul>
    </div>
  </div>
</div>
<div class="row-fluid">&nbsp;</div>
<div class="row-fluid">&nbsp;</div>
<div class="row-fluid">&nbsp;</div>

<div class="row-fluid">
	<div class="span4 offset4"><div style="text-align:center;"><img src="images/logo.png" alt="Logo" title="Logo"></div></div>
</div>
<div class="row-fluid">&nbsp;</div>
<div class="row-fluid">
	<div class="span4 offset4">
    		
    	 <form class="form-signin">
        <h3 class="form-signin-heading"><i class="icon-lock"></i><span id="login-txt"> <strong>Login</strong></span></h3>
        Email or Username:<input type="text" class="input-block-level" placeholder="Email address">
        <div class="text-error" id="errors">
  			 Invalid Email Or Username
		</div>
        Password:<input type="password" class="input-block-level" placeholder="Password">
        <div class="text-error"  id="errors">
  			 Invalid Password
		</div>
        
        <label class="checkbox"  id="float">
          <input type="checkbox" value="remember-me"> Remember me 
        </label> 
         &nbsp;| <a href="#">Forget Password</a>
        <div style="clear:both"></div>
        <button class="btn  btn-primary" type="submit">Sign in</button>
      </form>

        </div>
	</div>
<div class="navbar navbar-inverse navbar-fixed-bottom">
	<div class="navbar-inner">
    	<div class="container-fluid">
        	<ul class="nav pull-left">
            	<li><a href="">Copyright&copy; 2013. All rights reserved.</a></li>
            </ul>
            <ul class="nav pull-right">
            	<li><a href="#">Ithinq</a></li>
            </ul>
        </div>
  	</div>
</div>
<script src="http://code.jquery.com/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>