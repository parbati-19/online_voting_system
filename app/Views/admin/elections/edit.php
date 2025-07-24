<?php include_once 'app/Views/layouts/header.php'; ?>

<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
    <h2 class="text-2xl font-bold mb-6">Edit Election</h2>

    <form action="index.php?url=election/edit/<?= $data['election']['id'] ?>" method="POST" class="space-y-4">
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($data['election']['title'] ) ?>"
                required class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="4" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300"><?= htmlspecialchars($data['election']['description']) ?></textarea>
        </div>

        <!-- Start Date -->
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="datetime-local" id="start_date" name="start_date"
                value="<?= date('Y-m-d\TH:i', strtotime($data['election']['start_date'])) ?>" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- End Date -->
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="datetime-local" id="end_date" name="end_date"
                value="<?= date('Y-m-d\TH:i', strtotime($data['election']['end_date'])) ?>" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Status -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <select id="status" name="status" required
                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:ring focus:ring-blue-300">
                <option value="upcoming" <?= $data['election']['status'] === 'upcoming' ? 'selected' : '' ?>>Upcoming
                </option>
                <option value="active" <?= $data['election']['status'] === 'active' ? 'selected' : '' ?>>Active
                </option>
                <option value="ended" <?= $data['election']['status'] === 'ended' ? 'selected' : '' ?>>Ended</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
                Update Election
            </button>
        </div>
    </form>
</div>

<?php include_once 'app/Views/layouts/footer.php'; ?>