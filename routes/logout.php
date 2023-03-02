<?php
setcookie("token", "", time() + 1, "/", "", false, true);
echo '200';
?>