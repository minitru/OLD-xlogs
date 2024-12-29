<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32405203-1']);
  _gaq.push(['_trackPageview']);

  function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>about | xlogs - logfiles for Amazon AWS EC2</title>
<link rel="shortcut icon" href="xlogs.png" />
<link rel="stylesheet" media="screen" href="xlogs.css" />

<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200' rel='stylesheet' type='text/css'>

<style type="text/css" title="currentStyle">
	@import "dt/media/css/demo_page.css";
       	@import "dt/media/css/demo_table.css";
</style>

<!-- Demo Scripts -->
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="mousy.js"></script>
<script type="text/javascript" language="javascript" src="dt/media/js/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#login-link").click(function(){
        $("#login-panel").slideToggle(200);
    })

    $('#example').dataTable( {
        "sScrollY": "200px",
        "bFilter": false,
        "bPaginate": false,
        "bProcessing": true,
        "aaSorting": [[ 0, "desc" ]],
                "aoColumns": [
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null,
                        null
                ],
        "sAjaxSource": 'json.php'
    } );
} );

$(document).keydown(function(e) {
    if (e.keyCode == 27) {
        $("#login-panel").hide(0);
    }
});
</script>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32405203-1']);
  _gaq.push(['_trackPageview']);

  function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
    <body>
<A HREF="http://xlo.gs"><div id="logo"><IMG SRC="xlogs.png" VALIGN=middle>xlogs</div></A>

<ul id="list-nav">
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="savings.php">Savings</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>


<div id="demo-header">
<div id="login-link">
<?php include "include/loginbutton.php"; ?>
</div>
</div><!-- /demoheader -->
        <br class="clear" /><br /><br /><br />
        <div id="content">
            <h1 class="pagehead"><div class="xl">xlogs:</div>The Mighty Savings Calculator - sample content - login for live content</h1>
		<IMG SRC="savingsdemo.jpg">
            <div class="about">
<P>
	    </div> <!-- / desc -->

        <div id="footer">
        </div><!-- /footer -->
    </body>
</html>
