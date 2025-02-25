<?php
require 'vendor/autoload.php'; // โหลด autoload ของ Composer
use Dotenv\Dotenv;

class ServerModel
{
    private $db;

    public function __construct()
    {
        // โหลดค่าจากไฟล์ .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // .env
        $dotenv->load();

        // อ่านค่าจาก .env
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];

        // เชื่อมต่อฐานข้อมูล
        $this->db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getAllServers()
    {
        $stmt = $this->db->prepare("SELECT * FROM server_status");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServer($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM server_status WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addServer($name, $ip, $port)
    {
        $stmt = $this->db->prepare("INSERT INTO server_status (server_name, ip_address, port, status) VALUES (?, ?, ?, 'Unknown')");
        return $stmt->execute([$name, $ip, $port]);
    }

    public function updateServer($id, $name, $ip, $port)
    {
        $stmt = $this->db->prepare("UPDATE server_status SET server_name = ?, ip_address = ?, port = ? WHERE id = ?");
        return $stmt->execute([$name, $ip, $port, $id]); // เพิ่ม $id เข้ามา
    }

    public function deleteServer($id)
    {
        $stmt = $this->db->prepare("DELETE FROM server_status WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function checkServerStatus($ip, $port)
    {
        $status = @fsockopen($ip, $port, $errno, $errstr, 5) ? "Online" : "Offline";
        return $status;
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE server_status SET status = ?, last_checked = NOW() WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
}
