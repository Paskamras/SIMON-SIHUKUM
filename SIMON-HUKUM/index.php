<?php
    // Koneksi database
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "simon-hukum";

    // Koneksi
    $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

    // Jika tombol simpan diklik
    if (isset($_POST['bsimpan'])) {
        // Data akan disimpan baru
        $simpan = mysqli_query($koneksi, "INSERT INTO tsurat (kode, perihal, Tertuju, lampiran, terlampir, tanggal_diterima)
                                          VALUES ('$_POST[tkode]',
                                                  '$_POST[tperihal]',
                                                  '$_POST[ttertuju]',
                                                  '$_POST[tlampiran]',
                                                  '$_POST[tterlampir]',
                                                  '$_POST[ttanggalmasuk]' )");
        // Jika simpan data sukses
        if ($simpan) {
            echo "<script>
                alert('Simpan data sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Simpan data gagal!');
                document.location='index.php';
            </script>";
        }
    }

    // Jika tombol edit diklik
    if (isset($_POST['bedit'])) {
        $id = $_POST['id'];
        $edit = mysqli_query($koneksi, "UPDATE tsurat SET 
                                          kode = '$_POST[tkode]',
                                          perihal = '$_POST[tperihal]',
                                          Tertuju = '$_POST[ttertuju]',
                                          lampiran = '$_POST[tlampiran]',
                                          terlampir = '$_POST[tterlampir]',
                                          tanggal_diterima = '$_POST[ttanggalmasuk]'
                                          WHERE id_surat = '$id'");
        if ($edit) {
            echo "<script>
                alert('Edit data sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Edit data gagal!');
                document.location='index.php';
            </script>";
        }
    }

    // Jika tombol hapus diklik
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];
        $hapus = mysqli_query($koneksi, "DELETE FROM tsurat WHERE id_surat = '$id'");
        if ($hapus) {
            echo "<script>
                alert('Hapus data sukses!');
                document.location='index.php';
            </script>";
        } else {
            echo "<script>
                alert('Hapus data gagal!');
                document.location='index.php';
            </script>";
        }
    }

    // Jika tombol edit dipilih
    $dataEdit = null;
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = mysqli_query($koneksi, "SELECT * FROM tsurat WHERE id_surat = '$id'");
        $dataEdit = mysqli_fetch_array($result);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMON-HUKUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center">Data Surat</h3>
        <h3 class="text-center">Setda Biro Hukum Provinsi Bali</h3>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-info text-light">
                        Form Input Surat
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $dataEdit ? $dataEdit['id_surat'] : '' ?>">
                            <div class="mb-3">
                                <label class="form-label">Kode Surat</label>
                                <input type="text" name="tkode" class="form-control" placeholder="Input Kode Surat" value="<?= $dataEdit ? $dataEdit['kode'] : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Perihal Surat</label>
                                <input type="text" name="tperihal" class="form-control" placeholder="Input Perihal Surat" value="<?= $dataEdit ? $dataEdit['perihal'] : '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tertuju Pada</label>
                                <select class="form-select" name="ttertuju">
                                    <option value="">Pilih</option>
                                    <option value="PERPU BIRO HUKUM PROVINSI BALI" <?= $dataEdit && $dataEdit['Tertuju'] == 'PERPU BIRO HUKUM PROVINSI BALI' ? 'selected' : '' ?>>PERPU BIRO HUKUM PROVINSI BALI</option>
                                    <option value="JDIH BIRO HUKUM PROVINSI BALI" <?= $dataEdit && $dataEdit['Tertuju'] == 'JDIH BIRO HUKUM PROVINSI BALI' ? 'selected' : '' ?>>JDIH BIRO HUKUM PROVINSI BALI</option>
                                    <option value="KARO BIRO HUKUM PROVINSI BALI" <?= $dataEdit && $dataEdit['Tertuju'] == 'KARO BIRO HUKUM PROVINSI BALI' ? 'selected' : '' ?>>KARO BIRO HUKUM PROVINSI BALI</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Lampiran Surat</label>
                                        <input type="number" name="tlampiran" class="form-control" placeholder="Input Lampiran Surat" value="<?= $dataEdit ? $dataEdit['lampiran'] : '' ?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Terlampir</label>
                                        <select class="form-select" name="tterlampir">
                                            <option>Pilih</option>
                                            <option value="4 Lampiran" <?= $dataEdit && $dataEdit['terlampir'] == '4 Lampiran' ? 'selected' : '' ?>>4 Lampiran</option>
                                            <option value="3 Lampiran" <?= $dataEdit && $dataEdit['terlampir'] == '3 Lampiran' ? 'selected' : '' ?>>3 Lampiran</option>
                                            <option value="2 Lampiran" <?= $dataEdit && $dataEdit['terlampir'] == '2 Lampiran' ? 'selected' : '' ?>>2 Lampiran</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Surat Masuk</label>
                                        <input type="date" name="ttanggalmasuk" class="form-control" placeholder="Input Tanggal Surat Masuk" value="<?= $dataEdit ? $dataEdit['tanggal_diterima'] : '' ?>">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <hr>
                                    <button class="btn btn-primary" name="<?= $dataEdit ? 'bedit' : 'bsimpan' ?>" type="submit"><?= $dataEdit ? 'Update' : 'Simpan' ?></button>
                                    <button class="btn btn-danger" name="bkosongkan" type="reset">Kosongkan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-info"></div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header bg-info text-light">
                Data Surat IN/OUT
            </div>
            <div class="card-body">
                <div class="col-md-8 mx-auto">
                    <form method="POST">
                        <div class="input-group mb-3">
                            <input type="text" name="tcari" class="form-control" placeholder="Masukan Kata Kunci!">
                            <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
                            <button class="btn btn-danger" name="breset" type="submit">Reset</button>
                        </div>
                    </form>
                </div>

                <table class="table table-striped table-hover table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>Kode Surat</th>
                        <th>Perihal Surat</th>
                        <th>Tertuju</th>
                        <th>Lampiran</th>
                        <th>Terlampir</th>
                        <th>Tanggal Surat Masuk</th>
                        <th>Aksi</th>
                    </tr>

                    <?php
                        // Persiapan menampilkan data
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tsurat ORDER BY id_surat DESC");
                        while ($data = mysqli_fetch_array($tampil)) :
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['kode'] ?></td>
                        <td><?= $data['perihal'] ?></td>
                        <td><?= $data['Tertuju'] ?></td>
                        <td><?= $data['lampiran'] ?></td>
                        <td><?= $data['terlampir'] ?></td>
                        <td><?= $data['tanggal_diterima'] ?></td>
                        <td>
                            <a href="?edit=<?= $data['id_surat'] ?>" class="btn btn-warning">Edit</a>
                            <a href="?hapus=<?= $data['id_surat'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <div class="card-footer bg-info"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
