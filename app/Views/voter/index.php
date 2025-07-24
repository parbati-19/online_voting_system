<?php include_once 'app/Views/layouts/header.php'; ?>

<div class="max-w-4xl mx-auto p-6 mt-8 bg-white shadow-md rounded-lg">

    <p class="font-bold text-center">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>! <a
            href="index.php?url=auth/logout">Logout</a>
    </p>
    <?php if (!empty($_SESSION['message'])): ?>
    <div class="mb-4 rounded-md bg-green-100 p-4 border border-green-300 text-green-800">
        <?= htmlspecialchars($_SESSION['message']) ?>
        <?php unset($_SESSION['message']); ?>
    </div>
    <?php endif; ?>
    <p class="text-gray-700 text-center mb-8">
        Your voice matters! Participate in upcoming elections and help shape the future. </p>


    <!-- fetch all active elections  -->
    <div>
        <?php if (!empty($activeElections)): ?>
        <?php foreach ($activeElections as $activeElection): ?>
        <?php if (!empty($_SESSION['message'])): ?>
        <div class="mb-4 rounded-md bg-green-100 p-4 border border-green-300 text-green-800">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>
        <div class="bg-gray-100 border border-gray-200 rounded p-4 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($activeElection['title']) ?></h2>
            <p><span class="font-medium">Starts:</span> <?= htmlspecialchars($activeElection['start_date']) ?></p>
            <p><span class="font-medium">Ends:</span> <?= htmlspecialchars($activeElection['end_date']) ?></p>
            <a href="index.php?url=voter/ballot/<?= $_SESSION['user']['id']?>/<?= $activeElection['id'] ?>"
                class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Vote Now
            </a>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center text-gray-600">No active elections at the moment.</p>
        <?php endif; ?>
    </div>


    <!-- fetch all upcomingelections -->
    <div>
        <?php if (!empty($upcomingElections)): ?>
        <?php foreach ($upcomingElections as $upcomingElection): ?>
        <div class="bg-gray-100 border border-gray-200 rounded p-4 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2"><?= htmlspecialchars($upcomingElection['title']) ?>
            </h2>
            <p><span class="font-medium">Starts:</span> <?= htmlspecialchars($upcomingElection['start_date']) ?></p>
            <p><span class="font-medium">Ends:</span> <?= htmlspecialchars($upcomingElection['end_date']) ?></p>
            <span class="inline-block mt-4 bg-yellow-400 text-black px-4 py-2 rounded">
                Coming Soon
            </span>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p class="text-center text-gray-600">No upcoming elections at the moment.</p>
        <?php endif; ?>
    </div>


    <div class="text-center">
        <a href="index.php?url=home/index"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded shadow-lg text-lg">
            Read More
        </a>
    </div>
</div>

<?php include_once 'app/Views/layouts/footer.php'; ?>