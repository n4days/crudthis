<?= $this->extend('layout/layoutHome') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <?php foreach ($breadcrumb as $key => $value) : ?>
        <li class="breadcrumb-item <?= (count($breadcrumb) - 1 == $key) ? 'active' : '' ?>"><?= (count($breadcrumb) - 1 == $key) ? $value : '<a href="#">' . $value . '</a>' ?></li>
      <?php endforeach ?>
    </ol>
  </nav>

  <?php

  if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success"><i class="fas fa-circle-info"></i> <?= session()->getFlashdata('success') ?></div>
  <?php endif ?>
  <div class="card">
    <div class="card-header">
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahModal"><i class="fas fa-add"></i> Tambah</button>
      <div class="float-right">
        <form action="">
          <div class="input-group">
            <input type="input" class="form-control" name="keyword" placeholder="Search" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : "" ?>">
          </div>
        </form>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Nomor HP</th>
            <th scope="col">Alamat</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($user) > 0) : ?>
            <?php $no = 1;
            foreach ($user as $key => $value) : ?>
              <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $value->nama ?></td>
                <td><?= $value->hp ?></td>
                <td><?= $value->alamat ?></td>
                <td>
                  <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $value->id ?>"><i class="fas fa-edit"></i></button>
                  <button class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $value->id ?>"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            <?php endforeach ?>
          <?php else : ?>
            <tr>
              <td colspan="5" align="center">
                <lottie-player src="https://lottie.host/846f5e86-85dd-435e-826a-782e1e153a1a/QdrjzN5QoU.json" background="#FFFFFF" speed="1" style="width:300px;height:300px" loop autoplay direction="1" mode="normal">
                </lottie-player>
                keyword <strong>"<?= $_GET['keyword'] ?>"</strong> tidak ditemukan.
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <?= $pager->links('user', 'pager') ?>
    </div>
  </div>
</div>

<!-- Modal Insert -->
<div class="modal fade" id="tambahModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>Nomor HP</label>
            <input type="text" class="form-control" name="noHp">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat">
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

<!-- Modal Delete -->
<?php foreach ($user as $key => $value) : ?>
  <div class="modal fade" id="hapusModal<?= $value->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/<?= $value->id ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="DELETE">
          <div class="modal-body">
            Apakah anda akan menghapus data <strong><?= $value->nama ?></strong>?
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

<!-- Modal Edit -->
<?php foreach ($user as $key => $value) : ?>
  <div class="modal fade" id="editModal<?= $value->id ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit data <?= $value->nama ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/<?= $value->id ?>" method="post">
          <?= csrf_field() ?>
          <input type="hidden" name="_method" value="PUT">
          <div class="modal-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama" value="<?= $value->nama ?>">
            </div>
            <div class="form-group">
              <label>Nomor HP</label>
              <input type="text" class="form-control" name="noHp" value="<?= $value->hp ?>">
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <input type="text" class="form-control" name="alamat" value="<?= $value->alamat ?>">
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

<?= $this->endSection() ?>