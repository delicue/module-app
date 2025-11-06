    <!-- Event hydration bridge (processes server-emitted PHP events) -->
    <script src="/js/event-hydrate.js"></script>
    <!-- <script src="/js/dom-refresh.js"></script> -->
    <?php if (class_exists('\App\EventHydrator')) \App\EventHydrator::render(); ?>
</body>

</html>