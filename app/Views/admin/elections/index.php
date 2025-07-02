<?php
include_once 'app/Views/layouts/header.php';
?>
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Elections</h2>
        <?php if (!empty($_SESSION['message'])): ?>
        <div class="mb-4 rounded-md bg-green-100 p-4 border border-green-300 text-green-800">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

        <a href="index.php?url=election/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Add Election
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (!empty($elections) && is_array($elections)): ?>
        <?php foreach ($elections as $election): ?>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-semibold"><?= htmlspecialchars($election['title']) ?></h3>
            <p class="text-gray-600">Start: <?= htmlspecialchars($election['start_date']) ?></p>
            <p class="text-gray-600">End: <?= htmlspecialchars($election['end_date']) ?></p>
            <p
                class="text-sm mt-2 font-semibold 
                    <?= isset($election['statuss']) && $election['statuss'] === 'active' ? 'text-green-600' : 'text-gray-500' ?>">
                Status: <?= isset($election['statuss']) ? ucfirst($election['statuss']) : 'Unknown' ?>
            </p>
            <a href="index.php?url=election/edit/<?= htmlspecialchars($election['id'] )?>"
                class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                Edit
            </a>
            <a href="index.php?url=election/delete/<?= htmlspecialchars($election['id'] )?>"
                class="inline-block mt-3 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                Delete
            </a>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-gray-500">No elections found.</p>
        <?php endif; ?>
    </div>
    <div class="flex justify-end mt-4">
        <a href="index.php?url=admin/dashboard" class="text-red-800 hover:underline hover:text-red-900">Back to
            Dashboard</a>
    </div>
</div>

<?php
include_once 'app/Views/layouts/footer.php'
?>