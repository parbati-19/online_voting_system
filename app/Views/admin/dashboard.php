<?php
require_once "app/Views/layouts/header.php";
?>

<div class="bg-gray-100 h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-4 space-y-6">
        <h1 class="text-2xl font-bold text-gray-700">Admin Dasboard</h1>
        <nav class="flex flex-col space-y-2">
            <a href="index.php?url=admin/dashboard" class="text-gray-700 hover:text-blue-500">Dashboard</a>
            <!-- <a href="index.php?url=voter/index" class="text-gray-700 hover:text-blue-500">Users</a> -->
            <a href="index.php?url=election/index" class="text-gray-700 hover:text-blue-500">Elections</a>
            <a href="index.php?url=candidate/index" class="text-gray-700 hover:text-blue-500">Candidates</a>
            <a href="index.php?url=auth/logout" class="text-red-600 hover:text-red-800">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold">Dashboard</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Admin</span>
                <img src="https://i.pravatar.cc/40" alt="Avatar" class="rounded-full h-10 w-10">
            </div>
        </header>

        <!-- Content Area -->
        <main class="p-6">
            <h3 class="text-lg font-semibold mb-4">Quick Stats</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <h4 class="text-gray-500">Total Voters</h4>
                    <p class="text-2xl font-bold">1200</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h4 class="text-gray-500">Active Elections</h4>
                    <p class="text-2xl font-bold">3</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h4 class="text-gray-500">Messages</h4>
                    <p class="text-2xl font-bold">18</p>
                </div>
            </div>

            <!-- Table Section -->
            <h3 class="text-lg font-semibold mt-10 mb-4">Recent Voters</h3>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">DOB</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">John Doe</td>
                            <td class="px-4 py-2">john@example.com</td>
                            <td class="px-4 py-2">1998-04-23</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">Jane Smith</td>
                            <td class="px-4 py-2">jane@example.com</td>
                            <td class="px-4 py-2">1995-12-11</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<?php
    require_once "app/Views/layouts/footer.php";
?>