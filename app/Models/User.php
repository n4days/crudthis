<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
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
    protected $table = 'produk';
    // Untuk penanda primayKey . digunakan untuk Delete
    protected $primaryKey = 'idp';
    // Untuk penanda isiTable . digunakan untuk Create
    protected $allowedFields = ['namap', 'skup', 'desp', 'merekp'];
    protected $returnType   = 'object';
    protected $useTimestamps   = 'true';
    protected $createdField  = 'created_at_p';
    protected $updatedField  = 'updated_at_p';
    protected $deletedField  = 'deleted_at_p';

    public function getUserSearch($keyword = null)
    {
        $builder = $this->table($this->table);
        $builder->like($this->table . '.namap', $keyword);
        $builder->orLike($this->table . '.skup', $keyword);
        $builder->orLike($this->table . '.desp', $keyword);
        $builder->orLike($this->table . '.merekp', $keyword);
        $builder->orderBy($this->table . '.idp', 'DESC');
        return $builder;
    }

    public function getUser()
    {
        $builder = $this->table($this->table);
        $builder->orderBy($this->table . '.idp', 'DESC');
        return $builder;
    }
}
