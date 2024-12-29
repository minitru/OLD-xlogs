<?php
session_start();
if(isset($_SESSION['fname'])) {
    print '<a id="bobo" href="signin.php"><div id=login>Logout</div></a>';
}
else {
    print '<a id="bobo" href="signup.php"><div id=login>Signup</div></a>';
    print ' / <a id="bobo" href="signin.php"><div id=login>Login</div></a>';
}
?>
