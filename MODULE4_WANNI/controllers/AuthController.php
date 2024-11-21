<?php

class AuthController
{
    private $conn;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once 'config/database.php';
        $this->conn = $conn;
    }

    public function login()
    {
        $conn = $this->conn;
        {
            if (isset($_POST['submit'])) {
    
               $nim = $_POST['nim'];
               $password = $_POST['password'];
    
                $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
                $result = mysqli_query($this->conn, $query);
                $data_mahasiswa = mysqli_fetch_assoc($result);
    
                if ($data_mahasiswa) {
                    if (password_verify($password, $data_mahasiswa['password'])) {
                        $_SESSION['login'] = true;
                        $_SESSION['user'] = $data_mahasiswa;
                        $_SESSION['message'] = "Login Berhasil";
    
                        if (isset($_POST['remember_me'])) {
                            setcookie('nim', $nim, time() + (86400 * 30), "/");
                            setcookie('password', $password, time() + (86400 * 30), "/");
                        } else {
                            setcookie('nim', 'nim', time() - 3600, "/");
                            setcookie('password', 'password', time() - 3600, "/");
                        }
    
                        header('Location: index.php?controller=dashboard&action=index');
                        exit;
                    } else {
                        $_SESSION['message'] = "Login Gagal NIM atau Password Salah";
                    }
                } else {
                    $_SESSION['message'] = "NIM Tidak Ditemukan";
                }
            }

        include 'views/auth/login.php';
        }
    }

    private function getJurusan($jurusan){
        $kode_jurusan = 0;
        switch (strtolower($jurusan)) {
            case 'kedokteran':
                $kode_jurusan = 11;
                break;
            case 'psikologi':
                $kode_jurusan = 12;
                break;
            case 'biologi':
                $kode_jurusan = 13;
                break;
            case 'teknik informatika':
                $kode_jurusan = 14;
                break;
            default:
                $kode_jurusan = 0;
                break;
        }

        return $kode_jurusan;
    }

    private function generateNIM($id_pendaftaran){
        $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran'";
        $result = mysqli_query($this->conn, $query);
        $data_mahasiswa = mysqli_fetch_assoc($result);
        $tahunmasuk = date('y');

        if ($data_mahasiswa) {
            $jurusan = $data_mahasiswa['jurusan'];
            $kode_jurusan = $this->getJurusan($jurusan);

            if ($kode_jurusan != 0) {
                $nim = $kode_jurusan . $tahunmasuk . str_pad($data_mahasiswa['id'], 2, '0', STR_PAD_LEFT);
                return $nim;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }



    public function register_step_1()
    {
        if (isset($_POST['submit'])) {
            $id_pendaftaran = $_POST['id_pendaftaran'];

            $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran' AND status = 'lulus'";
            $result = mysqli_query($this->conn, $query);
            $data_pendaftaran = mysqli_fetch_assoc($result);

            if ($data_pendaftaran) {
                $_SESSION['id_pendaftaran'] = $id_pendaftaran;
                header('Location: index.php?controller=auth&action=register_step_2');
                exit;
            } else {
                $_SESSION['message'] = "ID Pendaftaran Tidak Valid atau Tidak Lulus";
            }
        }
        
        include 'views/auth/register_step_1.php';
    }


    public function register_step_2() 
    {
        $conn = $this->conn;
        
        if (isset($_POST['submit'])) {
            if (!isset($_SESSION['id_pendaftaran'])) {
                header('Location: index.php?controller=auth&action=register_step_1');
                exit;
            }
    
            if (isset($_POST['id_pendaftaran'])) {
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
    
                if ($password == $confirm_password) {
                    $id_pendaftaran = $_SESSION['id_pendaftaran'];
                    
                    $query = "SELECT * FROM pendaftaran WHERE id = '$id_pendaftaran'";
                    $result = mysqli_query($this->conn, $query);
                    $data_pendaftaran = mysqli_fetch_assoc($result);
                    
                    $nim = $this->generateNIM($id_pendaftaran);
    
                    $query_check_nim = "SELECT nim FROM mahasiswa WHERE nim = '$nim'";
                    $result_check_nim = mysqli_query($this->conn, $check_nim);
                    
                    if (mysqli_num_rows($nim_result) > 0) {
                        $_SESSION['message'] = "NIM sudah terdaftar";
                    } else {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        $nama = $data_pendaftaran['nama'];
                        $jurusan = $data_pendaftaran['jurusan'];
    
                        $query = "INSERT INTO mahasiswa (nim, id_pendaftaran, password, nama, jurusan) 
                                 VALUES ('$nim', '$id_pendaftaran', '$password', '$nama', '$jurusan')";
                        $result = mysqli_query($this->conn, $query);
    
                        if ($result) {
                            $_SESSION['message'] = "Register Berhasil Silahkan Login Menggunakan NIM: $nim dan Password yang telah dibuat";
                            unset($_SESSION['id_pendaftaran']);
                            header('Location: index.php?controller=auth&action=login');
                            exit;
                        } else {
                            $_SESSION['message'] = "Register Gagal";
                        }
                    }
                } else {
                    $_SESSION['message'] = "Password Tidak Cocok";
                }
            }
    
            include 'views/auth/register_step_2.php';
        }
    }

    public function logout() 
    {
        // TODO: Implementasikan fungsi logout
        // 1. Hapus semua data session menggunakan destroy()
        session_destroy();
        // 2. Redirect ke halaman login dengan:
        //    - Gunakan header('Location: index.php?controller=auth&action=login')
        header('Location: index.php?controller=auth&action=login');
        //    - Jangan lupa exit setelah redirect
        exit;
    }
}

?>