<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title>@yield('title')</title>
<meta name="description" content="pages login"/>
<meta name="keywords" itemprop="keywords" content="pages login" />
<meta name="news_keywords" content="pages login" />
<meta name="robots" content="noindex"/>
<link rel="alternate" href="{{asset('')}}" hreflang="vi-vn" />

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" >
<style type="text/css">
body,html{margin:0;padding:0;height:100%;background:#60a3bc!important}.user_card{height:400px;width:350px;margin-top:auto;margin-bottom:auto;background:#f39c12;position:relative;display:flex;justify-content:center;flex-direction:column;padding:10px;box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19);-webkit-box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19);-moz-box-shadow:0 4px 8px 0 rgba(0,0,0,.2),0 6px 20px 0 rgba(0,0,0,.19);border-radius:5px}.brand_logo_container{position:absolute;height:170px;width:170px;top:-75px;border-radius:50%;background:#60a3bc;padding:10px;text-align:center}.brand_logo{height:150px;width:150px;border-radius:50%;border:2px solid #fff}.form_container{margin-top:100px}.login_btn{width:100%;background:#c0392b!important;color:white!important}.login_btn:focus{box-shadow:none!important;outline:0px!important}.login_container{padding:0 2rem}.input-group-text{background:#c0392b!important;color:white!important;border:0!important;border-radius:.25rem 0 0 0.25rem!important}.input_user,.input_pass:focus{box-shadow:none!important;outline:0px!important}.custom-checkbox .custom-control-input:checked~.custom-control-label::before{background-color:#c0392b!important}
    </style>
</head>
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="post" action="login">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control input_user" value="" placeholder="Email">
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" value="" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="submit" name="button" class="btn login_btn">Login</button>
                   </div>
                    </form>
                </div>
        
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        Don't have an account? <a href="#" class="ml-2">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
