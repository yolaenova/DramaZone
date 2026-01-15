<?php
session_start();
include "koneksi.php"; 

// fungsi upload foto
function upload_foto($file) {
    $namaFile = $file['name'];
    $tmpName = $file['tmp_name'];
    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    if (!in_array($ekstensi, $allowed)) {
        return [
            'status' => false,
            'message' => 'Ekstensi file tidak diperbolehkan'
        ];
    }

    // buat nama file baru unik
    $namaFileBaru = uniqid() . "." . $ekstensi;

    if (!move_uploaded_file($tmpName, 'image/' . $namaFileBaru)) {
        return [
            'status' => false,
            'message' => 'Gagal upload file'
        ];
    }

    return [
        'status' => true,
        'message' => $namaFileBaru
    ];
}

// cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// ambil foto lama
$stmt = $conn->prepare("SELECT foto FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();
$foto_lama = $data['foto'] ?? '';
$stmt->close();

// update foto lama
if (!empty($_POST['password'])) {
    $password_md5 = md5($_POST['password']); // pakai MD5 supaya login.php bisa baca
    $stmt = $conn->prepare("UPDATE user SET password=? WHERE username=?");
    $stmt->bind_param("ss", $password_md5, $username);
    $stmt->execute();
    $stmt->close();
}

// update foto
if (!empty($_FILES['foto']['name'])) {

    $upload = upload_foto($_FILES['foto']);

    if ($upload['status']) {

        $foto_baru = $upload['message'];

        // hapus foto lama jika ada
        if (!empty($foto_lama) && file_exists("image/" . $foto_lama)) {
            unlink("image/" . $foto_lama);
        }

        // update database
        $stmt = $conn->prepare("UPDATE user SET foto=? WHERE username=?");
        $stmt->bind_param("ss", $foto_baru, $username);
        if (!$stmt->execute()) {
            echo "Error update foto: " . $stmt->error;
            exit;
        }
        $stmt->close();

        // update session
        $_SESSION['foto'] = $foto_baru;

    } else {
        echo "<script>alert('{$upload['message']}');history.back();</script>";
        exit;
    }
}

// alert & direct
echo "<script>
    alert('Profile berhasil diperbarui');
    document.location='admin.php';
</script>";
