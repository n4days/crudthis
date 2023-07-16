<?= $this->extend('layout/layoutHome') ?>

<?= $this->section('content') ?>

<br>

<!-- session alert -->
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success"><i class="fas fa-circle-info"></i> <?= session()->getFlashdata('success') ?></div>
<?php endif ?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($breadcrumb as $key => $value) : ?>
            <li class="breadcrumb-item <?= (count($breadcrumb) - 1 <= $key) ? "active" : "" ?>"><?= (count($breadcrumb) - 1 <= $key) ? $value  : '<a href="#">' . $value . '</a>' ?></li>
        <?php endforeach ?>
    </ol>
</nav>

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModalProduk"><i class="fas fa-add"></i> Tambah Barang</button>
            <div class="float-right">
                <form action="">
                    <input type="input" class="form-control" name="keyword" placeholder="Search" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : "" ?>">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">SKU Barang</th>
                        <th scope="col">Deskripsi Barang</th>
                        <th scope="col">Merek Barang</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($datap) > 0) : ?>
                        <?php $no = 1;
                        foreach ($datap as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $value->namap ?></td>
                                <td><?= $value->nama ?></td>
                                <td><?= $value->skup ?></td>
                                <td><?= $value->desp ?></td>
                                <td><?= $value->merek_nama ?></td>
                                <td><button class="btn btn-warning" data-toggle="modal" data-target="#editModalProduk<?= $value->idp ?>"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#hapusModalProduk<?= $value->idp ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" align="center">
                                <lottie-player src="https://lottie.host/846f5e86-85dd-435e-826a-782e1e153a1a/QdrjzN5QoU.json" background="#FFFFFF" speed="1" style="width:300px;height:300px" loop autoplay direction="1" mode="normal">
                                </lottie-player>
                                Produk <strong><?= $_GET['keyword'] ?></strong> tidak ditemukan.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <?= $pager->links('data', 'pager') ?>
        </div>
    </div>
</div>

<!-- Modal tambah produk -->
<div class="modal fade" id="tambahModalProduk" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="namap">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="kategori">
                            <option value="">-- Pilih kategori --</option>
                            <?php foreach ($kategori as $kat_i => $kat_val) : ?>
                                <option value="<?= $kat_val->id ?>"><?= $kat_val->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>SKU Barang</label>
                        <input type="text" class="form-control" name="skup">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <input type="text" class="form-control" name="desp">
                    </div>
                    <div class="form-group">
                        <label>Merek Barang</label>
                        <select class="form-control" name="merekp">
                            <option value="">-- Pilih merek --</option>
                            <?php foreach ($merek as $mer_i => $mer_val) : ?>
                                <option value="<?= $mer_val->merek_id ?>"><?= $mer_val->merek_nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal hapus produk -->
<?php foreach ($datap as $key => $value) : ?>
    <div class="modal fade" id="hapusModalProduk<?= $value->idp ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Hapus produk <?= $value->namap ?>.
                </div>
                <form action="produk/<?= $value->idp ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<!-- Modal edit produk -->
<?php foreach ($datap as $key => $value) : ?>
    <div class="modal fade" id="editModalProduk<?= $value->idp ?>" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Produk <strong><?= $value->namap ?></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="produk/<?= $value->idp ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="PUT">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="namap" value="<?= $value->namap ?>">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori">
                                <option value="">-- Pilih kategori --</option>
                                <?php foreach ($kategori as $kat_i => $kat_val) : ?>
                                    <option value="<?= $kat_val->id ?>" <?= ($kat_val->id == $value->kategori) ? 'selected' : '' ?>><?= $kat_val->nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>SKU Barang</label>
                            <input type="text" class="form-control" name="skup" value="<?= $value->skup ?>">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Barang</label>
                            <input type="text" class="form-control" name="desp" value="<?= $value->desp ?>">
                        </div>
                        <div class="form-group">
                            <label>Merek Barang</label>
                            <select class="form-control" name="merekp">
                                <option value="">-- Pilih merek --</option>
                                <?php foreach ($merek as $mer_i => $mer_val) : ?>
                                    <option value="<?= $mer_val->merek_id ?>" <?= ($mer_val->merek_id == $value->merekp) ? 'selected' : '' ?>><?= $mer_val->merek_nama ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection('content') ?>