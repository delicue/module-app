<form
    class="<?= htmlspecialchars($class ?? '') ?>"
    method="<?= htmlspecialchars($method ?? 'POST') ?>"
    action="<?= htmlspecialchars($action ?? '') ?>">
    <?= $slot ?? '' ?>
    <input type="hidden" name="_csrf_token" value="<?= htmlspecialchars(generateCsrfToken($form_name)) ?>">
</form>