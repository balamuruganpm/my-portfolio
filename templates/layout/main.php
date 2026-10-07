<?php
/**
 * Master Main Layout
 * Wraps head, body-start, navigation, page views, footer, and body-end
 */

// Include head
include __DIR__ . '/head.php';

// Include body start
include __DIR__ . '/body-start.php';

// Include navigation partial
include __DIR__ . '/../partials/navigation.php';

// Render Page Content
echo $content;

// Include footer
include __DIR__ . '/footer.php';

// Include body end
include __DIR__ . '/body-end.php';
