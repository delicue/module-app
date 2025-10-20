<div>
    <h1 class="text-3xl text-center font-bold my-4">User Details</h1>
    <div class="bg-gray-100 shadow rounded p-4">
        <p><strong>ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>
</div>