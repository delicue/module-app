<main class="bg-gray-200 p-4 text-gray-800 h-screen w-full">
    <h1 class="text-3xl text-center font-bold my-4">
        Users
    </h1>

    <!-- Users List -->
    <!-- <ul class="mb-8 px-4 py-8 bg-gray-100 shadow rounded border-slate-200 hover:border-slate-400 border container mx-auto grid grid-cols-4 gap-4">
        <?php foreach (data('users') as $user): ?>
            <li class="bg-slate-600 hover:bg-slate-400 text-slate-100 transition-all delay-100 duration-200 hover:text-slate-800 shadow-xl hover:shadow-2xl rounded flex">
                <div class="truncate text-center basis-1/4 content-center bg-slate-100 text-slate-800 font-bold"><?= htmlspecialchars($user['id']) ?></div>
                <div class="basis-3/4 p-4">
                    <div class="truncate"><?= htmlspecialchars($user['name']) ?></div>
                    <div class="truncate"><?= htmlspecialchars($user['email']) ?></div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul> -->

    <?php //require view('users/index.view') ?>
    <?php require Deli\App\View::render('/users/show.view', ['id' => 1]) ?>

    <!-- Add User Form -->
    <!-- <form class="bg-gray-100 rounded p-4 container mx-auto" method="POST" action="/add-user">
        <input type="hidden" name="_csrf_token_add_user" value="<?= htmlspecialchars(generateCsrfToken('add_user')) ?>">
        <h2 class="text-2xl font-bold mb-4">Add New User</h2>
        <div class="mb-4 flex gap-4 justify-center">
            <input type="text" autocomplete="name" name="name" placeholder="Enter user name" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <?= '<span class="text-red-600">'. (htmlspecialchars(\Deli\App\Forms\AddUserForm::$errors['name'] ?? '')).'</span>' ?>
            <input type="email" name="email" autocomplete="email" placeholder="Enter user email" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <p><?= '<span class="text-red-600">'. (htmlspecialchars(\Deli\App\Forms\AddUserForm::$errors['email'] ?? '')).'</span>' ?></p>
        </div>
        <input type="submit" class="bg-cyan-600 hover:bg-cyan-800 text-white font-bold  py-1 px-4 rounded" value="Add User">
    </form> -->
</main>