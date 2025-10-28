<main class="px-4 py-8">

    <h1 class="text-3xl text-gray-800 text-center font-bold mb-8">
        User Database- Manage Your Users Easily
    </h1>

    <!-- User Search -->
    <div class="container mx-auto px-8 py-4 bg-white rounded shadow shadow-sky-900 hover:shadow-lg mb-16 hover:shadow-sky-700">
        <h3 class="text-2xl font-bold mb-4">Search Users</h3>
        <input id="userSearch" type="text" placeholder="Search by name or email" class="px-2 py-1 rounded w-full bg-gray-50 border border-gray-200 text-gray-800 mb-4">
    </div>
    <!-- Users List -->
    <ul id="userList" class="mb-16 container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <?php foreach (data('users') as $user): ?>
            <li class="bg-white transition-all duration-200 hover:translate-y-1 shadow-lg hover:shadow-2xl rounded-lg">
                <p class="text-gray-200 bg-slate-700 rounded-t-md p-2 border-b border-b-emerald-200">ID: <?= htmlspecialchars($user['id']) ?></p>
                <div class="text-slate-700 bg-linear from-slate-200 to-gray-800 py-4 px-2 rounded-b-md truncate">
                    <p><?= htmlspecialchars($user['name']) ?></p>
                    <p><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Add User Form -->
    <form class="container mx-auto px-8 py-4 bg-white rounded shadow shadow-sky-900 hover:shadow-lg mb-16 hover:shadow-sky-700" method="POST" action="/add-user">
        <input type="hidden" name="_csrf_token_add_user" value="<?= htmlspecialchars(generateCsrfToken('add_user')) ?>">
        <h2 class="text-2xl font-bold mb-4">Add New User</h2>
        <div class="mb-4 flex gap-4 justify-center">
            <input type="text" autocomplete="name" name="name" placeholder="Enter user name" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <?= '<span class="text-red-600">' . (htmlspecialchars(\App\Forms\AddUserForm::$errors['name'] ?? '')) . '</span>' ?>
            <input type="email" name="email" autocomplete="email" placeholder="Enter user email" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <p><?= '<span class="text-red-600">' . (htmlspecialchars(\App\Forms\AddUserForm::$errors['email'] ?? '')) . '</span>' ?></p>
        </div>
        <input type="submit" class="bg-cyan-600 hover:bg-cyan-800 text-white font-bold  py-1 px-4 rounded" value="Add User">
    </form>
</main>
<script>
    function searchUsers() {
        const input = document.querySelector('#userSearch');
        const filter = input.value.toLowerCase();
        const userList = Array.from(document.querySelectorAll('#userList li'));
        if (!input.value) {

            userList.forEach(user => {
                user.style.display = '';
            });
            return;
        }

        userList.forEach(user => {
            user.style.display = '';
            const name = user.textContent.toLowerCase();
            const email = user.textContent.toLowerCase();
            if (!name.includes(filter) && !email.includes(filter)) {
                user.style.display = '';
            }
            else {
                user.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.querySelector('#userSearch');
        input.addEventListener("keyup", searchUsers);
        console.log('User search initialized.');
    });

    // (function() {
    //     function showFlash(args) {
    //         var data = Array.isArray(args) ? args[0] : args;
    //         if (Array.isArray(data) && data.length) data = data[0];
    //         var msg = (data && data.message) ? data.message : String(data || '');
    //         var el = document.getElementById('php-flash');
    //         if (!el) return;
    //         el.textContent = msg;
    //         el.classList.remove('hidden');
    //         setTimeout(function() {
    //             el.classList.add('hidden');
    //         }, 5000);
    //     }

    //     // Always listen for DOM CustomEvent dispatched by the hydrator
    //     document.addEventListener('flash', function(e) {
    //         showFlash(e.detail);
    //     });

    //     // If the JS bridge exists, register on it. If not yet present, poll briefly.
    //     if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function') {
    //         window.PHPEventEmitter.on('flash', showFlash);
    //     } else {
    //         var _i = setInterval(function() {
    //             if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function') {
    //                 window.PHPEventEmitter.on('flash', showFlash);
    //                 clearInterval(_i);
    //             }
    //         }, 50);
    //     }
    // })();
</script>