<?php
include "db/checksession.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="xlogs provides logfiles for Amazon Web Services instances AWS as well as usage optimization and securtiy alerts" />
<meta name="keywords" content="free, logfiles, AWS, Amazon Web Services, monitoring, metrics, cost, savings, reserved instances strategy, cloud change alert, monthly spend" />
<link rel="canonical" href="http://www.tickletrunk.ca/" />

<title>xlogs - logfiles for Amazon AWS EC2</title>
	<link rel="SHORTCUT ICON" href="favicon.ico" type="image/x-icon">

<link href='https://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200' rel='stylesheet' type='text/css'>

<style type="text/css" title="currentStyle">
	@import "dt/media/css/demo_page.css";
       	@import "dt/media/css/demo_table.css";
</style>

<link rel="stylesheet" media="screen" href="xlogs.css" />
<!--
<script type="text/javascript" src="js/form.js"></script>
-->

<!-- Demo Scripts -->
<script type="text/javascript" src="mousy.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="joyride/modernizr.foundation.js"></script>
<script type="text/javascript" language="javascript" src="dt/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="dt/extras/TableTools/media/js/TableTools.js"></script>
<script type="text/javascript" src="dygraph-combined.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#example').dataTable( {
        "sDom": '<"top"i>lrt<"bottom">f<"#filter"T><"clear">',
        "sScrollY": "250px",
        "bPaginate": false,
        "bProcessing": true,
        "oTableTools": {
            "sSwfPath": "/dt/tt/media/swf/copy_csv_xls_pdf.swf",
        },
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
<A HREF="https://xlo.gs"><div id="logo"><IMG SRC="xlogs.png" VALIGN=middle>xlogs</div></A>

<ul id="list-nav">
<li><a href="index.php">Home</a></li>
<li><a href="about.php">About</a></li>
<li><a href="savingsdemo.php">Savings</a></li>
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
            <h1 class="pagehead"><div class="xl">xlogs:</div> 
<?php
        include "/var/www/xlogs/chart.php";
        include "/var/www/xlogs/spend.php";
?>
</H1>
            <div class="description">
        <div id="dynamic" style="font-weight: regular; font-family: 'Ubuntu Mono', sans-serif;">
<table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
        <thead>
                <th width="100%" colspan=8>
                        <div  style="font-family: 'Yanone Kaffeesatz', sans-serif;"> <h2>Recent transactions: <B>Amazon AWS EC2</B></H2> </div>
                </th>
                <tr>
                        <th width="23%">Date</th>
                        <th width="2%">From</th>
                        <th width="8%">Instance</th>
                        <th width="8%">Action</th>
                        <th width="5%">Type</th>
                        <th width="6%">Runtime</th>
                        <th width="4%">Cost</th>
                        <th width="50%">Comments</th>
                </tr>
        </thead>
        <tbody>

        </tbody>
</table>
<BR><BR><BR>

            </div> <!-- /dynamic -->
           </div><!-- /desc -->


<table cellpadding="10" cellspacing="10" border="1" class="display">
<TR><TD id=c1 class=cell>
          <h2><div class=xl2>xlogs:</div> <A HREF="savingsdemo.php">Save Money & View Trends</A></h2>
<div id="graphdiv2" style="width:260px; height:80px;"></div>
<script type="text/javascript">
  g2 = new Dygraph(
    document.getElementById("graphdiv2"),
   "/cdata/1", // path to CSV file
   {
      rollPeriod: 7,
	gridLineColor: 'orange',
	strokeWidth: 3
}          // options
  );
</script>
</TD>
<TD id=c2 class="cell">
<?php
if (! $key1) print "<h2><div class=xl2>xlogs is free</div> - Sign Up Now</h2>";
else print "<h2><div class=xl2>xlogs:</div> Update your EC2 keys</h2>";
?>
<div id="hdr">Just confirm your email address</div><BR>
   <form name="signup"  class="control-group" method="post" action="process.php?action=invite">
        <input id="signup" type="text" placeholder="Email" name="email">
<BR>
       <input type="submit" id="submit" value="Next"  class="medium signin button radius">
       </form>
</TD>
<TD id=c3 class="cell">
          <h2><div class=xl2>xlogs:</div> Get Change Alerts</h2>
           <p>
<input type="checkbox" name="notify" value="asap"> As soon as possible<br>
<input type="checkbox" name="notify" value="daily"> Daily <BR>
<input type="checkbox" name="notify" value="weekly"> Weekly<BR>
<input type="checkbox" name="notify" value="monthly"> Monthly
<input type="hidden" name="id" value=<?php echo $id;?> >
<input id="submit" type="submit" name="submit" class="notify" value="Go"></div>
</form>
</TD></TR></table>
        </div><!-- /content -->

        <div id="footer">
        </div><!-- /footer -->
 <script> (function(d, s, id) { bubble_bubble_autoshow_timer = 0; var js, hbjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = window.location.protocol + "//www.heybubble.com/vchat/frame/100292B642D48A83B6641B8453AD9BBD" + "?current_url=" + encodeURIComponent(window.location) + "&referer=" + encodeURIComponent(document.referrer); hbjs.parentNode.insertBefore(js, hbjs); }(document, 'script', 'heybubble-jssdk')); </script>
    </body>
</html>
