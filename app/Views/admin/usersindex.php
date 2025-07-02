<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Registered Voters</h2>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">DOB</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2"><?= htmlspecialchars($user['name']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($user['email']) ?></td>
                    <td class="px-4 py-2"><?= htmlspecialchars($user['dob']) ?></td>
                    <td class="px-4 py-2">
                        <?php if ($user['has_voted']): ?>
                        <span class="text-green-600">Voted</span>
                        <?php else: ?>
                        <span class="text-gray-600">Not Voted</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-2">
                        <a href="index.php?url=admin/users/block&id=<?= $user['id'] ?>"
                            class="text-red-600 hover:underline">Block</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>