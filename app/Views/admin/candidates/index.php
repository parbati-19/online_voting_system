<?php
include_once 'app/Views/layouts/header.php';
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Candidates</h2>
        <?php if (!empty($_SESSION['message'])): ?>
        <div class="mb-4 rounded-md bg-green-100 p-4 border border-green-300 text-green-800">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

        <a href="index.php?url=candidate/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Add Candidate
        </a>
    </div>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Bio</th>
                    <th class="px-4 py-2">Photo</th>
                    <th class="px-4 py-2">Election</th>
                    <th class="px-4 py-2">Votes</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidates as $candidate): ?>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2"><?= htmlspecialchars($candidate['name']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($candidate['bio']) ?></td>
                    <td class="px-4 py-2">
                        <img src="assets/images/<?= htmlspecialchars($candidate['photo']) ?>"
                            alt="<?= htmlspecialchars($candidate['name']) ?>"
                            class="h-10 w-10 object-cover rounded-full">
                    </td>
                    <td class="px-4 py-2"><?= htmlspecialchars($candidate['election_title']) ?></td>
                    <td class="px-4 py-2"><?= $candidate['vote_count'] ?? 0 ?></td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="index.php?url=candidate/edit/<?= $candidate['id'] ?>"
                            class="text-blue-600 hover:underline">Edit</a>
                        <a href="index.php?url=candidate/delete/<?= $candidate['id'] ?>"
                            class="text-red-600 hover:underline">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="flex justify-end m-4">
        <a href="index.php?url=admin/dashboard" class="text-red-800 hover:underline hover:text-red-900">Back to
            Dashboard</a>
    </div>
</div>

<?php
include_once 'app/Views/layouts/footer.php'
?>