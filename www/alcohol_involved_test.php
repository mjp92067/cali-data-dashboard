<?php
require 'db.php';
$rows = alcohol_involved( '3711' );
?>
<pre><?php print_r( $rows ); ?></pre>

