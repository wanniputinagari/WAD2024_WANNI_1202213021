<?php

class DashboardController {
    private $conn;
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once 'config/database.php';
        $this->conn = $conn;
    }

    public function index() {
        if (!isset($_SESSION['l'])) {
            if (isset($_COOKIE['nim']) && isset($_COOKIE['password'])) {
                $nim = $_COOKIE['nim'];
                $password = $_COOKIE['password'];

                $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
                $result = mysqli_query($this->conn, $query);
                $data_mahasiswa = mysqli_fetch_assoc($result);

                if ($data_mahasiswa && password_verify($password, $data_mahasiswa[''])) {
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $data_mahasiswa;
                    $_SESSION['message'] = "Login Berhasil (Melalui Cookie)";
                } else {
                    $_SESSION['message'] = "Login Gagal (Melalui Cookie)";
                    header('Location: index.php?controller=auth&action=login');
                    exit;
                }
            } else {
                $_SESSION['message'] = "Please login first";
                header('Location: index.php?controller=auth&action=login');
                exit;
            }
        }

        $nim = $_SESSION['user']['nim'];
        $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
        $result = mysqli_query($this->conn, $query);
        $mahasiswa = mysqli_fetch_assoc($result);

        include 'views/dashboard/index.php';
    }

}

?>