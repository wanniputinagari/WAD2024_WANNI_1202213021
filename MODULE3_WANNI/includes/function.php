<?php

include("dbconnection.php");

// buatkan function addStudent()
function addStudent()
{
    // variabel global
    global $conn;

    // Silakan buat variabel di bawah dengan data yang diambil dari form
    $name =  $_POST['stuname'];
    $nim =  $_POST['stuid'];
    $major =  $_POST['stuclass'];
    $year =  $_POST['stuangkatan'];

    // Periksa apakah NIM sudah ada
    $ret = mysqli_query($conn, "SELECT nim FROM tb_student WHERE nim = $nim");

    if (mysqli_num_rows($ret) == 0) {
        // Masukkan data ke tabel tb_student
        $query = "INSERT INTO tb_student (nama, nim, jurusan, angkatan) VALUES ('$name','$nim','$major','$year')";
        $result = mysqli_query($conn, $query);

        // Buatlah logika untuk Memeriksa hasil dari operasi penambahan data mahasiswa.
        if ($result) {
            
        // * Jika operasi berhasil, menampilkan pesan bahwa mahasiswa telah ditambahkan
            echo '<script>alert("Student has been added.")</script>';
        // * dan mengarahkan pengguna ke halaman 'add-students.php'.
            echo "<script>window.location.href ='add-students.php'</script>";
        // * Jika operasi gagal, menampilkan pesan kesalahan.
        } else {
            echo '<script>alert("Something Went Wrong. Please try again.")</script>';
            }

    // * Jika NIM sudah ada, menampilkan pesan bahwa NIM sudah ada.
    } else {
        echo "<script>alert('NIM already exists. Please try again.');</script>";
    }
}

function editStudent($id) {
    global $conn;

    // Ambil input dari form dan simpan dalam variabel
    $name =  $_POST['stuname'];
    $nim =  $_POST['stuid'];
    $major =  $_POST['stuclass'];
    $year =  $_POST['stuangkatan'];

    // Isi query dibawah untuk update data mahasiswa berdasarkan ID
    $query = "UPDATE tb_student SET 
                nama ='$name', 
                nim ='$nim', 
                jurusan ='$major', 
                angkatan ='$year' 
              WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Student data has been updated.")</script>';
        echo "<script>window.location.href ='manage-students.php'</script>";
    } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
    }
}


?>