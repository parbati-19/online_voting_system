<?php include_once 'app/Views/layouts/header.php'; ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-6">Add New Candidate</h2>
    <?php if (!empty($errors)): ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc list-inside">
            <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="index.php?url=candidate/create" method="POST" enctype="multipart/form-data" class="space-y-4">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Candidate Name</label>
            <input type="text" id="name" name="name" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Bio -->
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
            <textarea id="bio" name="bio" rows="4" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300"></textarea>
        </div>

        <!-- Election -->
        <div>
            <label for="election_id" class="block text-sm font-medium text-gray-700">Election</label>
            <select id="election_id" name="election_id" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
                <option value="">Select Election</option>
                <?php foreach ($elections as $election): ?>
                <option value="<?= $election['id'] ?>"><?= htmlspecialchars($election['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Photo -->
        <div>
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
            <input type="file" id="photo" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Create Candidate
            </button>
        </div>
    </form>
</div>

<?php include_once 'app/Views/layouts/footer.php'; ?>