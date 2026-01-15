<div class="container">
    <div class="row mb-2">
        <div class="col-md-6">
            <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-lg"></i> Tambah Gallery
            </button>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="search" class="form-control" placeholder="Cari gallery...">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="result"></tbody>
        </table>
    </div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="edit_id">
        <input type="hidden" name="gambar_lama" id="edit_gambar_lama">

        <div class="modal-header">
          <h5 class="modal-title">Edit Gallery</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" id="edit_deskripsi" class="form-control" required></textarea>
          </div>

          <div class="mb-3">
            <label>Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ganti gambar</small>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="update" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function loadData(keyword = '') {
    $.ajax({
        url: "gallery_search.php",
        type: "POST",
        data: { keyword: keyword },
        success: function(data) {
            $("#result").html(data);
        }
    });
}

loadData();

$("#search").keyup(function () {
    let keyword = $(this).val();
    if (keyword.length >= 3 || keyword.length === 0) {
        loadData(keyword);
    }
});
</script>

<script>
$(document).on("click", ".editBtn", function () {
  $("#edit_id").val($(this).data("id"));
  $("#edit_deskripsi").val($(this).data("deskripsi"));
  $("#edit_gambar_lama").val($(this).data("gambar"));

  $("#modalEdit").modal("show");
});
</script>


<?php
include "upload_foto.php";

// simpan
if (isset($_POST['simpan'])) {
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';

    if ($_FILES['gambar']['name'] != '') {
        $cek_upload = upload_foto($_FILES['gambar']);
        if ($cek_upload['status']) {
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('{$cek_upload['message']}');</script>";
            die;
        }
    }

    $stmt = $conn->prepare(
        "INSERT INTO gallery (deskripsi, gambar, tanggal, username)
         VALUES (?,?,?,?)"
    );
    $stmt->bind_param("ssss", $deskripsi, $gambar, $tanggal, $username);
    $stmt->execute();

    echo "<script>
        alert('Data gallery berhasil disimpan');
        document.location='admin.php?page=gallery';
    </script>";
}

// update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = $_POST['gambar_lama'];

    if ($_FILES['gambar']['name'] != '') {
        $cek_upload = upload_foto($_FILES['gambar']);
        if ($cek_upload['status']) {
            unlink("image/" . $gambar);
            $gambar = $cek_upload['message'];
        } else {
            echo "<script>alert('{$cek_upload['message']}');</script>";
            die;
        }
    }

    $stmt = $conn->prepare(
        "UPDATE gallery 
         SET deskripsi=?, gambar=?, tanggal=?, username=?
         WHERE id=?"
    );
    $stmt->bind_param("ssssi", $deskripsi, $gambar, $tanggal, $username, $id);
    $stmt->execute();

    echo "<script>
      alert('Data gallery berhasil diupdate');
      document.location='admin.php?page=gallery';
    </script>";
}

// hapus
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        unlink("image/".$gambar);
    }

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>
        alert('Data gallery berhasil dihapus');
        document.location='admin.php?page=gallery';
    </script>";
}
?>
