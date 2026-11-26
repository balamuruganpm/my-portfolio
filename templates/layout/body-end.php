<?php
/**
 * Layout: Body End
 * Loads main OS scripts and closes document
 */
?>
<?php $mainJsFile = file_exists(BASE_PATH . 'assets/js/main.min.js') ? 'main.min.js' : 'main.js'; ?>
    <script src="<?php echo BASE_URL; ?>assets/js/<?php echo $mainJsFile; ?>?v=<?php echo JS_VERSION; ?>" defer></script>
    <script src="<?php echo BASE_URL; ?>assets/js/arcade.js?v=<?php echo JS_VERSION; ?>" defer></script>
</body>
</html>
