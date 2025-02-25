<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- เพิ่ม SweetAlert2 จาก CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Server Status Monitor</h2>
            <div class="flex space-x-2">
                <button id="refreshBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Refresh</button>
                <button id="addServerBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Server</button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Server Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">IP Address | Host Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Port Checked</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Last Checked</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($servers as $server): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $server['server_name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $server['ip_address']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo $server['port']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $server['status'] === 'Online' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo $server['status']; ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo $server['last_checked']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button class="text-blue-600 hover:text-blue-800 mr-2 editServerBtn"
                                    data-id="<?php echo $server['id']; ?>"
                                    data-name="<?php echo $server['server_name']; ?>"
                                    data-ip="<?php echo $server['ip_address']; ?>"
                                    data-port="<?php echo $server['port']; ?>">Edit</button>
                                <a href="/check-server/delete/<?php echo $server['id']; ?>" class="text-red-600 hover:text-red-800 deleteServerBtn" data-id="<?php echo $server['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mb-6">
            <p class="text-red-600 py-2">* The system will check every 1 minute.</p>
            <div class="flex space-x-2">

                <a href="https://github.com/samtheerapong/check-server" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Copyright @samTheerapong</a>
            </div>
        </div>

        <!-- Modal สำหรับ Add Server -->
        <div id="addServerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Add New Server</h3>
                <form id="addServerForm" method="POST" action="/check-server/create">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Server Name</label>
                        <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="ip">IP Address | Host Name</label>
                        <input type="text" name="ip" id="ip" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="port">Port</label>
                        <input type="number" name="port" id="port" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="closeAddModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal สำหรับ Edit Server -->
        <div id="editServerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Edit Server</h3>
                <form id="editServerForm" method="POST">
                    <input type="hidden" name="id" id="editId">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="editName">Server Name</label>
                        <input type="text" name="name" id="editName" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="editIp">IP Address | Host Name</label>
                        <input type="text" name="ip" id="editIp" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="editPort">Port</label>
                        <input type="number" name="port" id="editPort" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="closeEditModalBtn" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript เพื่อควบคุม Modal และ SweetAlert2 -->
    <script>
        // Add Server Modal
        const addServerBtn = document.getElementById('addServerBtn');
        const addServerModal = document.getElementById('addServerModal');
        const closeAddModalBtn = document.getElementById('closeAddModalBtn');
        const addServerForm = document.getElementById('addServerForm');

        addServerBtn.addEventListener('click', () => {
            addServerModal.classList.remove('hidden');
        });

        closeAddModalBtn.addEventListener('click', () => {
            addServerModal.classList.add('hidden');
        });

        addServerModal.addEventListener('click', (e) => {
            if (e.target === addServerModal) {
                addServerModal.classList.add('hidden');
            }
        });

        addServerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            fetch(addServerForm.action, {
                method: 'POST',
                body: new FormData(addServerForm)
            }).then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Server added successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // รีเฟรชหน้า
                    });
                    addServerModal.classList.add('hidden');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to add server.'
                    });
                }
            });
        });

        // Edit Server Modal
        const editServerModal = document.getElementById('editServerModal');
        const closeEditModalBtn = document.getElementById('closeEditModalBtn');
        const editServerForm = document.getElementById('editServerForm');
        const editId = document.getElementById('editId');
        const editName = document.getElementById('editName');
        const editIp = document.getElementById('editIp');
        const editPort = document.getElementById('editPort');
        const editServerButtons = document.querySelectorAll('.editServerBtn');

        editServerButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const ip = button.getAttribute('data-ip');
                const port = button.getAttribute('data-port');

                editId.value = id;
                editName.value = name;
                editIp.value = ip;
                editPort.value = port;
                editServerForm.action = `/check-server/edit/${id}`;

                editServerModal.classList.remove('hidden');
            });
        });

        closeEditModalBtn.addEventListener('click', () => {
            editServerModal.classList.add('hidden');
        });

        editServerModal.addEventListener('click', (e) => {
            if (e.target === editServerModal) {
                editServerModal.classList.add('hidden');
            }
        });

        editServerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            fetch(editServerForm.action, {
                method: 'POST',
                body: new FormData(editServerForm)
            }).then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Server updated successfully.',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // รีเฟรชหน้า
                    });
                    editServerModal.classList.add('hidden');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to update server.'
                    });
                }
            });
        });

        // Delete Server with SweetAlert2
        const deleteServerButtons = document.querySelectorAll('.deleteServerBtn');
        deleteServerButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const id = button.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/check-server/delete/${id}`, {
                            method: 'GET'
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Server has been deleted.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload(); // รีเฟรชหน้า
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Failed to delete server.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
    <!-- JavaScript เพื่อจัดการปุ่ม Refresh -->
    <script>
        const refreshBtn = document.getElementById('refreshBtn');
        refreshBtn.addEventListener('click', () => {
            location.reload(); // รีเฟรชหน้าเว็บ
        });
    </script>
    <script>
        // Refresh the page every 60 seconds (1 minute)
        setTimeout(function() {
            location.reload();
        }, 60000); // 60000 milliseconds = 60 seconds
    </script>
</body>

</html>