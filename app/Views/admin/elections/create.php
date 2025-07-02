<?php include_once 'app/Views/layouts/header.php'; ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-6">Add New Election</h2>

    <form action="index.php?url=election/create" method="POST" class="space-y-4">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            <?php if (isset($data['errors']['title'])): ?>
            <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['title']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300"></textarea>
            <?php if (isset($data['errors']['description'])): ?>
            <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['description']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Start Date -->
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="datetime-local" id="start_date" name="start_date" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            <?php if (isset($data['errors']['start_date'])): ?>
            <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['start_date']) ?></p>
            <?php endif; ?>
        </div>

        <!-- End Date -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="datetime-local" id="end_date" name="end_date" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
            <?php if (isset($data['errors']['end_date'])): ?>
            <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['end_date']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="status" name="status" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
                <option value="upcoming">Upcoming</option>
                <option value="active">Active</option>
                <option value="ended">Ended</option>
            </select>
            <?php if (isset($data['errors']['status'])): ?>
            <p class="text-red-600 text-sm"><?= htmlspecialchars($data['errors']['status']) ?></p>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Create Election
            </button>
        </div>
    </form>
</div>

<?php include_once 'app/Views/layouts/footer.php'; ?>