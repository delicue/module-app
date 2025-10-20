<div>
    <h1 class="text-3xl text-center font-bold my-4">Users</h1>
    <ul class="mb-8 px-4 py-8 bg-gray-100 shadow rounded border-slate-200 hover:border-slate-400 border container mx-auto grid grid-cols-2 sm:grid-cols-4 gap-4">
        <?php foreach (data('users') as $user): ?>
            <li class="bg-slate-600 hover:bg-slate-400 text-slate-100 transition-all delay-100 duration-200 hover:text-slate-800 shadow-xl hover:shadow-2xl rounded md:grid md:grid-cols-4">
                <div class="truncate text-center col-span-1 content-center bg-slate-100 text-slate-800 font-bold"><?= htmlspecialchars($user['id']) ?></div>
                <div class="p-4 col-span-3">
                    <div class="truncate"><?= htmlspecialchars($user['name']) ?></div>
                    <div class="truncate"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>