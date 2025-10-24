    
	<!-- Event hydration bridge (processes server-emitted PHP events) -->
	<script src="/js/event-hydrate.js"></script>
	<?php if (class_exists('\App\EventHydrator')) { \App\EventHydrator::render(); } ?>

</body>
</html>