<?php
declare(strict_types=1);

(function (): void {
    global $db, $auth;
    
    if (!isset($db) || !$db instanceof db) {
        http_response_code(500);
        echo '<div class="container my-4"><div class="alert alert-danger">DB unavailable.</div></div>';
        return;
    }
    
    $conn = $db->connect();
    if ($conn === null) {
        http_response_code(500);
        echo '<div class="container my-4"><div class="alert alert-danger">DB connection failed.</div></div>';
        return;
    }
    
    // Get slug from URL
    $uriPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $uriPath = rtrim($uriPath, '/');

    $slug = '';
    if (strpos($uriPath, '/forge') === 0) {
        $slug = trim(substr($uriPath, strlen('/forge')), '/');
    }

    if ($slug === '') {
        http_response_code(404);
        echo '<div class="container my-4"><div class="alert alert-secondary">Page not found.</div></div>';
        return;
    }
    
    // sanitize
    $slug = preg_replace('~[^a-z0-9\-_\/]~i', '', $slug);
    
    // Forge requires auth
    
    // All views are contained within forge/views/*.php
    
    /**
     * Typical expected flow
     * Student enrolls and learns about module development
     * Student creates a module in the Sandbox
     * Forge Master ensures the module's correctness and compliance
     * Instructors dig through the code
     * Approved/Not Approved based on the things above.
     * If not approved, student is urged to try again.
     * If approved, student becomes a Certified ChAoS Module Developer.
     * The student sets the selling price on the module
     * Forge Master lists the module on the ChAoS Shop
   */
})();
