<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
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
    protected $allowedFields = ['namap', 'skup', 'desp', 'merekp', 'kategori'];
    protected $returnType   = 'object';
    protected $useTimestamps   = 'true';
    protected $createdField  = 'created_at_p';
    protected $updatedField  = 'updated_at_p';
    protected $deletedField  = 'deleted_at_p';

    public function getDataSearch($keyword = null)
    {
        $builder = $this->table($this->table);
        $builder->join('kategori', 'kategori.id=' . $this->table . '.kategori', 'LEFT');
        $builder->join('merek', 'merek.merek_id=' . $this->table . '.merekp', 'LEFT');
        $builder->like($this->table . '.namap', $keyword);
        $builder->orLike($this->table . '.skup', $keyword);
        $builder->orLike($this->table . '.desp', $keyword);
        $builder->orLike($this->table . '.merekp', $keyword);
        $builder->orderBy($this->table . '.idp', 'DESC');
        return $builder;
    }

    public function getData()
    {
        $builder = $this->table($this->table);
        $builder->join('kategori', 'kategori.id=' . $this->table . '.kategori', 'LEFT');
        $builder->join('merek', 'merek.merek_id=' . $this->table . '.merekp', 'LEFT');
        $builder->orderBy($this->table . '.idp', 'DESC');
        return $builder;
    }
}
