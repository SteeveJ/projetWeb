<script src="./src/jquery/dist/jquery.min.js"></script>
<script src="./src/js/bootstrap.min.js"></script>
<?php
if( isset( $f_scripts ) && gettype( $f_scripts ) === "array" && sizeof( $f_scripts ) !== 0 ) {
    foreach ( $f_scripts as $s ) {
        echo "<script src=\"".$s."\"></script>";
    }
}
?>
</body>
</html>