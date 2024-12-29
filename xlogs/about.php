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
<li><a href="summary.php">Summary</a></li>
<li><a href="contact.php">Contact</a></li>
</ul>


<div id="demo-header">
<div id="login-link">
<?php include "include/loginbutton.php"; ?>
</div>
</div><!-- /demoheader -->
        <br class="clear" /><br /><br /><br />
        <div id="content">
            <h1 class="pagehead"><div class="xl">xlogs:</div> How it Works</h1>
            <div class="about">
<P>
<div class="xl2">xlogs</div class="xl2"> does 3 things: helps save you money, helps track usage, and notifies you on changes.
<BR><BR>
<UL>
<LI>The <A HREF="savingsdemo.php">Savings</A> link above can help you save up to 71% by using <A HREF="http://aws.amazon.com/ec2/reserved-instances/">AWS EC2 Reserved Instances</A>
<LI><A HREF="index.php">Logfiles</A> provide an audit trail - solves a security problem.
<LI><A HREF="index.php">Change Alerts</A> tells you what changed in your AWS EC2 environment.
<LI><A HREF="index.php">View Sharing</A> lets you show others your xlogs AWS information without disclosing your security keys.
</UL>
<BR>
        </div><!-- /content -->
            <h1 class="pagehead"><div class="xl">xlogs:</div> About Security</h1>
            <div class="about">
<P>
<div class="xl2">xlogs</div class="xl2"> needs read-only keys to do its job... but why trust us?
<P>
<UL>
<LI>We use SSL connections for all HTTP traffic.
<LI>We don't store passwords in our database, we hash them using <A HEF="https://defuse.ca/php-pbkdf2.htm">PBKDF2</A>.
<LI>We ask that you provide us READ-ONLY KEYS.
<LI>You keys are never displayed on-screen.  If you need to change them you'll have to enter them over again.
<LI>You can reach a live person by phone if you need to - unheard of on a free service.
</UL>
<BR>
</div>
            <h1 class="pagehead"><div class="xl">xlogs:</div> Is it really free?</h1>
            <div class="about">
<P>
<div class="xl2">xlogs</div class="xl2"> is free.  There are no pricing plans.  We built it because we needed it.  Maybe you do too.
<P>
<UL>
<LI>We get to build a loyal and happy AWS user community.
<LI>We get to see how people are using AWS in real life.
<LI>We get the wisdom of the AWS crowd, to help make xlogs better.
</UL>

</P>
</div>
	    </div> <!-- / desc -->

        <div id="footer">
        </div><!-- /footer -->
    </body>
</html>
