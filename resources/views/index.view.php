<main class="bg-slate-800 p-4 text-slate-100 h-screen w-full">
    <h1 class="text-3xl font-bold underline">
        Home
    </h1>
    <p>This is the Module App</p>
    <ul>
        <?php foreach (Deli\App\View::$data['users'] as $user): ?>
            <li><?= htmlspecialchars($user['name']) ?></li>
        <?php endforeach; ?>
    </ul>
</main>