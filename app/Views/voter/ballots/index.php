<?php include_once 'app/Views/layouts/header.php'; ?>

<div class="max-w-3xl mx-auto mt-8 bg-white p-6 shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">
        <?= is_array($election) && isset($election['title']) ? htmlspecialchars($election['title']) : 'Election Title Not Found' ?>
        - Ballot
    </h1>

    <?php if (!empty($candidates)): ?>
    <form action="index.php?url=voter/vote" method="POST">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">
        <input type="hidden" name="election_id" value="<?= $election['id'] ?>">

        <?php foreach ($candidates as $candidate): ?>
        <div class="border p-4 rounded mb-4 flex items-center space-x-4">
            <?php
            // Path to candidate photo or default
            $photoPath = !empty($candidate['photo']) && file_exists('assets/images/' . $candidate['photo'])
                ? 'assets/images/' . $candidate['photo']
                : 'assets/images/logo.png';
        ?>
            <img src="<?= htmlspecialchars($photoPath) ?>" alt="<?= htmlspecialchars($candidate['name']) ?> Photo"
                class="w-20 h-20 object-cover rounded-full border" />

            <label class="flex-1 flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="candidate_id" value="<?= $candidate['id'] ?>" required class="cursor-pointer">
                <div>
                    <p class="font-bold"><?= htmlspecialchars($candidate['name']) ?></p>
                    <p class="text-gray-600"><?= htmlspecialchars($candidate['bio']) ?></p>
                </div>
            </label>
        </div>
        <?php endforeach; ?>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Submit Vote
        </button>
    </form>
    <?php else: ?>
    <p class="text-gray-600">No candidates available for this election.</p>
    <?php endif; ?>
</div>

<?php include_once 'app/Views/layouts/footer.php'; ?>