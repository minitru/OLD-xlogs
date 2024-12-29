<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create a sliding Login box with CSS and jQuery</title>
<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="stylesheet" media="screen" href="demo.css" />
<!-- Demo Styles -->
<style type="text/css">
#demo-header{
    width: 980px;
    margin: 0 auto;
    position: relative;
}
#login-link{
    position: absolute;
    top: 0px;
    right: 0px;
    display: block;
    background: #2a2a2a;
    padding: 5px 15px 5px 15px;
    color: #FFF;
}
#login-panel{
    position: absolute;
    top: 26px;
    right: 0px;
    width: 190px;
    padding: 10px 15px 5px 15px;
    background: #2a2a2a;
    font-size: 8pt;
    font-weight: bold;
    color: #FFF;
    display: none;
}
label{
    line-height: 1.8;
}
</style>
<!-- Demo Scripts -->
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#login-link").click(function(){
        $("#login-panel").slideToggle(200);
    })
})
$(document).keydown(function(e) {
    if (e.keyCode == 27) {
        $("#login-panel").hide(0);
    }
});

</script>

</head>
    <body>
<div id="demo-header">
    <a id="login-link" href="#login" title="Login">Clients Area</a>
<div id="login-panel">
<form action="" method="post">
<p>
<label>Username:
<input name="username" type="text" value="" />
</label> <br />
<label>Password:
<input name="password" type="password" value="" />
</label><br /><br />
<input type="submit" name="submit" value="Sign In" />
<small>Press ESC to close</small>
</p>
</form>
</div><!-- /login-panel -->
</div><!-- /demoheader -->
        <br class="clear" /><br /><br /><br />
        <div id="content">
            <h1 class="pagehead">Sliding Login Box Demo</h1>
            <div class="description">
            <p>Click on Clients Area link to top to view it in action.</p>
            <p>To close the panel you can click the Clients Area Link again or press ESC key on your keyboard.</p>
            <h3><a href="http://www.cssjockey.com/css-tips/jquery-css-login-panel" title="">View and Download Code</a></h3>
            </div>
        </div><!-- /content -->


        <div id="footer">
        </div><!-- /footer -->
    </body>
</html>
