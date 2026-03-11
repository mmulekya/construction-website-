</div>

<footer>

<p>© <?php echo date("Y"); ?> BuildSmart Platform</p>

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
