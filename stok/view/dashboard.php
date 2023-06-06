<?php


define('MENU_TITLE', 'Dashboard');
include "../header.php";
?>
<?php if (!empty($_COOKIE['alert'])) { ?>
    <?php
    $alert = $_COOKIE['alert'];
    $split = explode("|", $alert);
    ?>
    <div class="alert alert-<?= $split[0] ?> alert-dismissible fade show" role="alert">
        <?= $split[1] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php } ?>

<div class="d-grid gap-2 mb-4">
    <button class="btn btn-primary block" type="button" data-bs-toggle="modal" data-bs-target="#backdrop">Tambah Data</button>
</div>

<div class="modal fade text-left" id="backdrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form action="<?= BASE_URL ?>submit/tambah-obat" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">
                        Tambah Data
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Kode</label>
                        <input type="text" class="form-control" placeholder="Kode" id="kode" require name="kode">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama Obat" id="nama" require name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Stok</label>
                        <input type="number" class="form-control" placeholder="Stok" id="stok" require name="stok">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Satuan</label>
                        <input type="text" class="form-control" placeholder="Satuan" id="satuan" require name="satuan">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Harga Pokok</label>
                        <input type="text" class="form-control" placeholder="Harga Pokok" id="harga" require name="harga">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">Simple Datatable</div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Pokok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM stok";
                    $run = mysqli_query($con, $query);
                    foreach ($run as $res) :
                    ?>
                        <tr>
                            <td><?= $res['kode'] ?></td>
                            <td><?= $res['nama'] ?></td>
                            <td><?= $res['stok'] ?></td>
                            <td><?= $res['satuan'] ?></td>
                            <td><?= $res['harga'] ?></td>
                            <td>
                                <button class="btn btn-primary block" type="button" data-bs-toggle="modal" data-bs-target="#edit-<?= $res['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                <a href="<?= BASE_URL ?>submit/hapus-obat?id=<?= $res['id'] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php
$query = "SELECT * FROM stok";
$run = mysqli_query($con, $query);
foreach ($run as $res) :
?>
    <div class="modal fade text-left" id="edit-<?= $res['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="<?= BASE_URL ?>submit/edit-obat" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">
                            Edit Data
                        </h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Kode</label>
                            <input type="text" class="form-control" value="<?= $res['kode'] ?>" id="kode" required name="kode">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama</label>
                            <input type="text" class="form-control" value="<?= $res['nama'] ?>" id="nama" required name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Stok</label>
                            <input type="number" class="form-control" value="<?= $res['stok'] ?>" id="stok" required name="stok">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Satuan</label>
                            <input type="text" class="form-control" value="<?= $res['satuan'] ?>" id="satuan" required name="satuan">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Harga Pokok</label>
                            <input type="text" class="form-control" value="<?= $res['harga'] ?>" id="harga" required name="harga">
                        </div>
                        <input type="hidden" name="id" id="id" value="<?= $res['id'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>
<?php
include "../footer.php";
?>