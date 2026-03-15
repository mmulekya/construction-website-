</div>
<footer>
<p>© 2026 BuildSmart</p>

<?php
// Include security to access session info
include("includes/security.php");

// Check if user is logged in
if(is_logged_in()){ // assume this function is in security.php
?>
    <a href="blog.php">Blog</a>
    <a href="portfolio.php">Portfolio</a>
    <a href="contact.php">Contact</a>
<?php } else { ?>
    <!-- Show only public pages -->
    <a href="privacy.php">Privacy Policy</a>
<?php } ?>

<!-- Always show Privacy link -->
<a href="privacy.php">Privacy Policy</a>
</footer>

<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js')
    .then(function() {
        console.log("Service Worker Registered");
    });
}
</script>

</body>
</html>