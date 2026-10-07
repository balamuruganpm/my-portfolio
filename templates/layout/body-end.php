<?php
/**
 * Layout: Body End
 * Deferred scripts loading, Bootstrap JS, and closing tags
 */
?>
    <!-- Main JS Loader (Cache Busted & Deferred) -->
    <script src="<?php echo BASE_URL; ?>assets/js/main.min.js?v=<?php echo JS_VERSION; ?>" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>
