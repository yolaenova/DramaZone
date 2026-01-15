<?php
include "koneksi.php";

$keyword = $_POST['keyword'];

$sql = "SELECT * FROM gallery 
        WHERE deskripsi LIKE ? OR tanggal LIKE ? OR username LIKE ?
        ORDER BY tanggal DESC";

$stmt = $conn->prepare($sql);
$search = "%" . $keyword . "%";
$stmt->bind_param("sss", $search, $search, $search);
$stmt->execute();

$hasil = $stmt->get_result();

$no = 1;
while ($row = $hasil->fetch_assoc()) {
?>
<tr>
	<td><?= $no++ ?></td>

	<td>
		<?= $row["deskripsi"] ?>
		<br>
		<small>
			pada : <?= $row["tanggal"] ?><br>
			oleh : <?= $row["username"] ?>
		</small>
	</td>

	<td>
    <?php
        if ($row["gambar"] != '') {
            if (file_exists('image/' . $row["gambar"])) {
                echo '<img src="image/' . $row["gambar"] . '" 
                    class="img-fluid rounded"
                    style="max-width:200px; height:auto;"
                    alt="Gambar Gallery">';
            }
        }
    ?>
    </td>

	<td>
		<!-- tombol edit -->
		<a href="#" title="edit"
		   class="badge rounded-pill text-bg-success"
		   data-bs-toggle="modal"
		   data-bs-target="#modalEdit<?= $row["id"] ?>">
		   <i class="bi bi-pencil"></i>
		</a><br>

		<!-- tombol hapus -->
		<a href="#" title="delete"
		   class="badge rounded-pill text-bg-danger"
		   data-bs-toggle="modal"
		   data-bs-target="#modalHapus<?= $row["id"] ?>">
		   <i class="bi bi-x-circle"></i>
		</a>

		<!-- modal edit -->
		<div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Edit Gallery</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<form method="post" enctype="multipart/form-data">
						<div class="modal-body">

							<input type="hidden" name="id" value="<?= $row["id"] ?>">

							<div class="mb-3">
								<label class="form-label">Deskripsi</label>
								<textarea name="deskripsi" class="form-control" required><?= $row["deskripsi"] ?></textarea>
							</div>

							<div class="mb-3">
								<label class="form-label">Ganti Gambar</label>
								<input type="file" name="gambar" class="form-control">
							</div>

							<div class="mb-3">
								<label class="form-label">Gambar Lama</label><br>
								<?php
								if ($row["gambar"] != '') {
									if (file_exists('image/' . $row["gambar"])) {
										echo '<img src="image/' . $row["gambar"] . '" class="img-fluid">';
									}
								}
								?>
								<input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<input type="submit" value="update" name="update" class="btn btn-primary">
						</div>
					</form>

				</div>
			</div>
		</div>
		<!-- akhir modal edit -->

		<!-- modal akhir -->
		<div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5">Konfirmasi Hapus Gallery</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<form method="post">
						<div class="modal-body">
							Yakin akan menghapus gallery ini?
							<input type="hidden" name="id" value="<?= $row["id"] ?>">
							<input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<input type="submit" value="hapus" name="hapus" class="btn btn-primary">
						</div>
					</form>

				</div>
			</div>
		</div>
		<!-- akhir modal akhir -->
	</td>
</tr>
<?php
}
?>
