<?php
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// ambil data user login
$stmt = $conn->prepare("SELECT username, foto FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<div class="container mt-4">
    <form method="POST" action="profile_update.php" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= $user['username']; ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Password</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Tuliskan Password Baru Jika Ingin Mengganti Password Saja">
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Foto Profil</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil Saat Ini</label><br>
            <?php if (!empty($user['foto'])): ?>
                <img src="image/<?= $user['foto']; ?>" width="120">
            <?php else: ?>
                <p>Belum ada foto</p>
            <?php endif; ?>
        </div>

        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
