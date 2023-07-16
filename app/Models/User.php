<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'hp', 'alamat', 'created_at', 'updated_at', 'deleted_at'];
    protected $returnType   = 'object';
    protected $useTimestamps   = 'true';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getUserSearch($keyword = null)
    {
        $builder = $this->table($this->table);
        $builder->join('kategori', 'kategori.id=' . $this->table . 'id', '');
        $builder->like($this->table . '.nama', $keyword);
        $builder->orLike($this->table . '.hp', $keyword);
        $builder->orLike($this->table . '.alamat', $keyword);
        $builder->orderBy($this->table . '.id', 'DESC');
        return $builder;
    }

    public function getUser()
    {
        $builder = $this->table($this->table);
        $builder->orderBy($this->table . '.id', 'DESC');
        return $builder;
    }
}
