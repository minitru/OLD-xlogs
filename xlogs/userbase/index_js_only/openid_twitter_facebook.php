<?php
//Always place this code at the top of the Page
session_start();
if (isset($_SESSION['id'])) {
    // Redirection to login page twitter or facebook
    header("location: home.php");
}

if (array_key_exists("login", $_GET)) {
    $oauth_provider = $_GET['oauth_provider'];
    if ($oauth_provider == 'twitter') {
        header("Location: login-twitter.php");
    } else if ($oauth_provider == 'facebook') {
        header("Location: login-facebook.php");
    }
}
?>
<title>OpenID /title>
 <link rel="stylesheet" href="css/f_s.css" type="text/css">
<link type="text/css" rel="stylesheet" href="css/openid.css" />
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/openid-jquery.js"></script>
	<script type="text/javascript" src="js/openid-en.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			openid.init('openid_identifier');
			openid.setDemoMode(false); //Stops form submission for client javascript-only test purposes
		});
	</script>
	<!-- /Simple OpenID Selector -->
	<style type="text/css">
		/* Basic page formatting */
		body {
			font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		}
		#buttons{
		    text-align:left;
		}
	</style>



<div id="buttons">



    <form action="openlogin.php" method="post" id="openid_form">
		<input type="hidden" name="action" value="verify" />
		<fieldset>
			<legend>Sign-in or Create New Account</legend>
			<div id="openid_choice">
				<p>Please click your account provider:</p>
				<div id="openid_btns"></div>
			</div>
			<div id="openid_input_area">
				<input id="openid_identifier" name="openid_identifier" type="text" value="http://" />
				<input id="openid_submit" type="submit" value="Sign-In"/>
			</div>
			<noscript>
				<p>OpenID is service that allows you to log-on to many different websites using a single indentity.
				Find out <a href="http://openid.net/what/">more about OpenID</a> and <a href="http://openid.net/get/">how to get an OpenID enabled account</a>.</p>
			</noscript>
		</fieldset>
    </form>
    

    
    
    <div class='txtl'>
    <p>
	If you do not want to use the openID selector above but want to roll your own then here are all the URLs for the above
	openID providers:
</p>
	<h4>Those without usernames in the URL</h4>
	Google: <b>https://www.google.com/accounts/o8/id</b><br/><br/>
	Yahoo: <b>http://me.yahoo.com/</b><br/>
	
	<br/>
	<h4>Those with usernames in the URL</h4>
	AOL: <b>http://openid.aol.com/{username}</b><br/><br/>
	MyOpenID: <b>http://{username}.myopenid.com/</b><br/><br/>
	LiveJournal: <b>http://{username}.livejournal.com/</b><br/><br/>
	WordPress: <b>http://{username}.wordpress.com/</b><br/><br/>
	BlogSpot: <b>http://{username}.blogspot.com/</b><br/><br/>
	Verisign Labs: <b>http://{username}.pip.verisignlabs.com/</b><br/><br/>
	ClaimID: <b>http://claimid.com/{username}</b><br/><br/>
	ClickPass: <b>http://clickpass.com/public/{username}</b><br/><br/>
	Google Profiles: <b>http://www.google.com/profiles/{username}</b><br/>
	
	<br/><br/>
	 <p>
	Whichever buttons you provide they must send the finished URL as a form POST to openlogin.php in a
	POST field with the ID/Name of "openid_identifier".
	</p>
	  <p>
	You should also provide an empty input box with an ID/Name of "openid_identifier" in a form that POSTS to
	openlogin.php for people with other providers.
	</p>
	<h4>Example:</h4>
	
	<form action="openlogin.php" method="post" id="openid_form_google">
	    <fieldset>
			<legend>Google Example</legend>
			<div id="openid_input_area">
				<input id="openid_identifier" name="openid_identifier" type="hidden" value="https://www.google.com/accounts/o8/id" />
	
				    <input type="image" src="images.large/google.gif"  alt="sign in" border="0"  style='width:75px; height:32px; border:none; padding:0px ;'/>

			</div>
	    </fieldset>
	</form>
    
  </div>
</div>
