<form 
    class="<?= htmlspecialchars($class ?? '') ?>"
    method="<?= htmlspecialchars($method ?? 'POST') ?>"
    action="<?= htmlspecialchars($action ?? '') ?>">
    <?= $slot ?? '' ?>
</form>