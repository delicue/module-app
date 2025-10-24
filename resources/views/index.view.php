<script>
    function searchUsers() {
        const input = document.querySelector('#userSearch');
        const filter = input.value.toLowerCase();
        const userList = Array.from(document.querySelectorAll('#userList li'));

        function orderByName(a, b) {
            const nameA = a.textContent.toLowerCase();
            const nameB = b.textContent.toLowerCase();
            return nameA.localeCompare(nameB);
        }

        function orderByEmail(a, b) {
            const emailA = a.textContent.toLowerCase();
            const emailB = b.textContent.toLowerCase();
            return emailA.localeCompare(emailB);
        }

        function orderById(a, b) {
            const idA = parseInt(a.querySelector('div').textContent.replace('ID: ', ''));
            const idB = parseInt(b.querySelector('div').textContent.replace('ID: ', ''));
            return idA - idB;
        }

        if(!input.value) {

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
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.querySelector('#userSearch');
        input.addEventListener("keyup", searchUsers());
    });

    // async function fetchUsers() {
    //     try {
    //         const users = <?php echo json_encode(data('users')) ?? '[]' ?>;
    //         const userList = document.getElementById('userList');
    //         users.forEach(user => {
    //             const li = document.createElement('li');
    //             li.className = 'bg-slate-600 hover:bg-stone-200 text-slate-100 transition-all delay-100 duration-100 hover:text-slate-800 hover:translate-y-1 shadow-xl hover:shadow-2xl rounded flex';
    //             li.innerHTML = `
    //                 <div class="truncate text-center basis-1/4 content-center bg-white text-slate-800 font-bold">${user.id}</div>
    //                 <div class="basis-3/4 p-4">
    //                     <div class="truncate">${user.name}</div>
    //                     <div class="truncate">${user.email}</div>
    //                 </div>
    //             `;
    //             userList.appendChild(li);
    //         });
    //     } catch (error) {
    //         console.error('Error fetching users:', error);
    //     }
    // }
</script>
<main class="bg-gray-100 p-4 text-gray-800 h-screen w-full">

    <h1 class="text-3xl text-center font-bold my-4">
        User Database
    </h1>

    <?php
    // Example: emit a flash event from PHP so it can be hydrated to JS (use shared Module dispatcher)
    if (class_exists('\App\Module')) {
        $dispatcher = \App\Module::getDispatcher();
        $dispatcher->emit('flash', ['type' => 'success', 'message' => 'Welcome — this flash was emitted from PHP.']);
    }
    ?>

    <!-- Flash container (will be populated by hydrated PHP events) -->
    <div id="php-flash" class="hidden fixed top-4 right-4 bg-green-600 text-white p-3 rounded shadow-lg z-50"></div>

    <!-- Users List -->
    <div class="container mx-auto px-8 py-4 bg-white rounded shadow shadow-sky-800 hover:shadow-lg mb-4 hover:shadow-sky-700">
        <h3 class="text-2xl font-bold mb-4">Search Users</h3>
        <input id="userSearch" type="text" placeholder="Search by name or email" class="px-2 py-1 rounded w-full bg-gray-50 border border-gray-200 text-gray-800 mb-4">
    </div>
    <ul id="userList" class="mb-8 p-16 bg-white shadow rounded border-slate-100 hover:border-slate-200 border container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <?php foreach (data('users') as $user): ?>
            <li class="text-slate-100 bg-white bg-gradient-to-tr from-10% to-90% from-slate-800 to-amber-300/75 transition-all
            delay-100 duration-100 hover:translate-y-1 shadow-xl hover:shadow-2xl
            rounded-lg">
                <div class="text-center content-center bg-slate-700/75 rounded-t-md p-2 border-b mb-2 lg:mb-4 border-b-emerald-200">ID: <?= htmlspecialchars($user['id']) ?></div>
                <div class="p-4 text-wrap items-center">
                    <p class="text-wrap break-all"><?= htmlspecialchars($user['name']) ?></p>
                    <p class="text-wrap break-all"><?= htmlspecialchars($user['email']) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Add User Form -->
    <form class="container mx-auto px-8 py-4 bg-white rounded shadow mb-4" method="POST" action="/add-user">
        <input type="hidden" name="_csrf_token_add_user" value="<?= htmlspecialchars(generateCsrfToken('add_user')) ?>">
        <h2 class="text-2xl font-bold mb-4">Add New User</h2>
        <div class="mb-4 flex gap-4 justify-center">
            <input type="text" autocomplete="name" name="name" placeholder="Enter user name" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <?= '<span class="text-red-600">'. (htmlspecialchars(\App\Forms\AddUserForm::$errors['name'] ?? '')).'</span>' ?>
            <input type="email" name="email" autocomplete="email" placeholder="Enter user email" class="px-2 py-1 rounded w-1/2 bg-gray-200 text-gray-800">
            <p><?= '<span class="text-red-600">'. (htmlspecialchars(\App\Forms\AddUserForm::$errors['email'] ?? '')).'</span>' ?></p>
        </div>
        <input type="submit" class="bg-cyan-600 hover:bg-cyan-800 text-white font-bold  py-1 px-4 rounded" value="Add User">
    </form>
</main>

<script>
    (function(){
        function showFlash(args){
            var data = Array.isArray(args) ? args[0] : args;
            if (Array.isArray(data) && data.length) data = data[0];
            var msg = (data && data.message) ? data.message : String(data || '');
            var el = document.getElementById('php-flash');
            if (!el) return;
            el.textContent = msg;
            el.classList.remove('hidden');
            setTimeout(function(){ el.classList.add('hidden'); }, 5000);
        }

        // Always listen for DOM CustomEvent dispatched by the hydrator
        document.addEventListener('flash', function(e){ showFlash(e.detail); });

        // If the JS bridge exists, register on it. If not yet present, poll briefly.
        if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function') {
            window.PHPEventEmitter.on('flash', showFlash);
        } else {
            var _i = setInterval(function(){
                if (window.PHPEventEmitter && typeof window.PHPEventEmitter.on === 'function'){
                    window.PHPEventEmitter.on('flash', showFlash);
                    clearInterval(_i);
                }
            }, 50);
        }
    })();
</script>