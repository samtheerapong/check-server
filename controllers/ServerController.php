<?php
require_once 'models/ServerModel.php';

class ServerController {
    private $model;
    private $basePath = '';

    public function __construct() {
        $this->model = new ServerModel();
    }

    public function index() {
        $servers = $this->model->getAllServers();
        foreach ($servers as $server) {
            $status = $this->model->checkServerStatus($server['ip_address'], $server['port']);
            $this->model->updateStatus($server['id'], $status);
        }
        $servers = $this->model->getAllServers();
        require_once 'views/server_list.php';
    }

    public function admin() {
        $servers = $this->model->getAllServers();
        foreach ($servers as $server) {
            $status = $this->model->checkServerStatus($server['ip_address'], $server['port']);
            $this->model->updateStatus($server['id'], $status);
        }
        $servers = $this->model->getAllServers();
        require_once 'views/admin_list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->addServer($_POST['name'], $_POST['ip'], $_POST['port']);
            header("Location: {$this->basePath}/");
            exit;
        }
        require_once 'views/server_form.php';
    }

    public function edit($id) {
        $server = $this->model->getServer($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateServer($id, $_POST['name'], $_POST['ip'], $_POST['port']);
            header("Location: {$this->basePath}/");
            exit;
        }
        require_once 'views/server_form.php';
    }

    public function delete($id) {
        $this->model->deleteServer($id);
        header("Location: {$this->basePath}/");
        exit;
    }
}