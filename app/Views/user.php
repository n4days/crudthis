<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid">
    <div class="alert alert-info">Selamat datang <strong><?= $pertama ?></strong></div>

    <?php

    use Config\Pager;

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
                <td colspan="5" align="center">keyword <strong>"<?= $_GET['keyword'] ?>"</strong> tidak ditemukan.</td>
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

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>