<?php

include "pass.php";

$passwd="BOBORULES";

$hash=create_hash($passwd);

print "HASH: $hash\n";

# RETURNS 1 IF THE PASSWORD IS OK
$result=validate_password("BOBORULES", $hash);

print "RESULT: $result\n";

?>
