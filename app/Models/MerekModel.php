<?php

namespace App\Models;

use CodeIgniter\Model;

class MerekModel extends Model
{
    // // Untuk access table . digunakan untuk Read
    // protected $table = 'home';
    // // Untuk penanda primayKey . digunakan untuk Delete
    // protected $primaryKey = 'id';
    // // Untuk penanda isiTable . digunakan untuk Create
    // protected $allowedFields = ['nama', 'hp', 'alamat'];
    // protected $returnType   = 'object';
    // protected $useTimestamps   = 'true';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // master produk
    // Untuk access table . digunakan untuk Read
    protected $table = 'merek';
    // Untuk penanda primayKey . digunakan untuk Delete
    protected $primaryKey = 'merek_id';
    // Untuk penanda isiTable . digunakan untuk Create
    protected $allowedFields = ['merek_nama'];
    protected $returnType   = 'object';
}
