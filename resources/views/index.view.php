<main class="bg-gray-200 p-4 text-gray-800 h-screen w-full">
    <h1 class="text-3xl text-center font-bold my-4">
        Users
    </h1>
    <ul class="px-4 py-8 bg-gray-100 shadow rounded border-slate-200 hover:border-slate-400 border container mx-auto grid grid-cols-4 gap-4">
        <?php foreach (data('users') as $user): ?>
            <li class="bg-slate-600 hover:bg-slate-400 text-slate-100 transition-all delay-100 duration-200 hover:text-slate-800 shadow-xl hover:shadow-2xl rounded flex">
                <div class="truncate text-center basis-1/4 content-center bg-slate-100 text-slate-800 font-bold"><?= htmlspecialchars($user['id']) ?></div>
                <div class="basis-3/4 p-4">
                    <div class="truncate"><?= htmlspecialchars($user['name']) ?></div>
                    <div class="truncate"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <form class="mt-8 text-end bg-gray-100 rounded p-4 container mx-auto" method="POST" action="/add-user">
        <input type="hidden" name="_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
        <input type="text" name="name" placeholder="Enter user name" class="px-2 py-1 rounded w-1/3 bg-gray-200 text-gray-800">
        <input type="email" name="email" placeholder="Enter user email" class="px-2 py-1 rounded w-1/3 bg-gray-200 text-gray-800">
        <input type="submit" class="bg-cyan-600 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded" value="Add User">
    </form>
</main>