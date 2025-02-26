<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // .env
$dotenv->load();

$pass = $_ENV['ADMIN_PASS']; // เก็บรหัสผ่านจาก .env
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Status</title>
    <link href="./src/output.css" rel="stylesheet">
    <!-- เพิ่ม SweetAlert2 จาก CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Server Status Monitor</h2>
            <div class="flex space-x-2">
                <button id="refreshBtn" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Refresh</button>
                <button id="adminBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Admin</button>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="flex justify-between items-center mb-12">
            <p class="text-red-600 py-2">* The system will check every 1 minute.</p>
        </div>

        <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow-sm md:flex md:items-center md:justify-center md:p-6 dark:bg-gray-800 dark:border-gray-600">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© <?= date('Y') ?> <a href="https://github.com/samtheerapong/check-server" target="_blank" class="hover:underline">samtheerapong</a>. All Rights Reserved.</span>
        </footer>

        <script>
            const refreshBtn = document.getElementById('refreshBtn');
            refreshBtn.addEventListener('click', () => {
                location.reload(); // รีเฟรชหน้าเว็บ
            });

            const adminBtn = document.getElementById('adminBtn');
            adminBtn.addEventListener('click', () => {
                Swal.fire({
                    title: 'กรุณาป้อนรหัสผ่าน',
                    input: 'password', // ใช้ input แบบ password เพื่อซ่อนรหัสที่พิมพ์
                    inputPlaceholder: 'ป้อนรหัสผ่านที่นี่',
                    showCancelButton: true,
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก',
                    inputValidator: (value) => {
                        if (!value) {
                            return 'กรุณาป้อนรหัสผ่าน!';
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const password = result.value;
                        const adminPass = '<?php echo $pass; ?>'; // ดึงรหัสผ่านจาก PHP
                        if (password === adminPass) {
                            window.open('/check-server/admin'); // ถ้ารหัสถูกต้อง เปิดหน้า admin
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'รหัสผ่านไม่ถูกต้อง!',
                                text: 'กรุณาลองใหม่',
                                confirmButtonText: 'ตกลง'
                            });
                        }
                    }
                });
            });

            // Refresh the page every 60 seconds (1 minute)
            setTimeout(function() {
                location.reload();
            }, 60000); // 60000 milliseconds = 60 seconds
        </script>
</body>

</html>