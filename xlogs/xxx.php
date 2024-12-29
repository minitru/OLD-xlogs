<?php

// initialize a session

session_start();

?>

<html>

<head></head>

<body>

<?php

if (!isset($_SESSION['name']) && !isset($_POST['name'])) {

    // if no data, print the form

?>

    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

        <input type="text" name="name">

        <input type="submit" name="submit" value="Enter your name">

    </form>

<?php

}

else if (!isset($_SESSION['name']) && isset($_POST['name'])) {

    // if a session does not exist but the form has been submitted

    // check to see if the form has all required values

    // create a new session

    if (!empty($_POST['name'])) {

        $_SESSION['name'] = $_POST['name'];

        $_SESSION['start'] = time();

        echo "Welcome, " . $_POST['name'] . ". A new session has been activated for you. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page.";

    }

    else {

        echo "ERROR: Please enter your name!";

    }

}

else if (isset($_SESSION['name'])) {

    // if a previous session exists

    // calculate elapsed time since session start and now

    echo "Welcome back, " . $_SESSION['name'] . ". This session was activated " . round((time() - $_SESSION['start']) / 60) . " minute(s) ago. Click <a href=" . $_SERVER['PHP_SELF'] . ">here</a> to refresh the page.";

}

?>

</body>

</html>
