<?php
/**
 * Layout: Body Start
 * Opens <body>, renders preloader overlay, mascot character scene, and opens <main>
 */
?>
<body class="preloader-active">

    <!-- Preloader Overlay -->
    <div id="preloader" class="preloader-overlay"></div>

    <!-- Interactive Mascot Character -->
    <?php include BASE_PATH . 'templates/partials/mascot-svg.php'; ?>

    <main class="container my-5 animate-fade-in">
