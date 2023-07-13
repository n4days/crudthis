<?php

namespace App\Controllers;

// Include Models ke Controlles
use App\Models\User;

class Home extends BaseController
{
    // Membentuk __construct Models
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        // $data = $this->userModel->findAll();
        // $nama = [
        //     "user" => $data
        // ];

        // master produk
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data = $this->userModel->getUserSearch($keyword);
        } else {
            $data = $this->userModel->getUser();
        }
        // $data = $this->userModel->findAll();
        $nama = [
            "datap" => $data->paginate(3, 'data')
        ];
        return view('homework', $nama);
    }

    public function createUser()
    {
        // Request data at welcome
        $dataInsert = [
            'nama' => $this->request->getVar('nama'),
            'hp' => $this->request->getVar('hp'),
            'alamat' => $this->request->getVar('alamat')
        ];
        // // Insert data at __construct
        // $this->userModel->insert($dataInsert);
        // return redirect()->to('/');

        // Insert data at __construct dengan session
        if ($this->userModel->insert($dataInsert)) {
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/');
        }
    }

    public function deleteUser($id)
    {
        // // Delete data at __construct
        // $this->userModel->delete($id);
        // return redirect()->to('/');

        // Delete data at __construct dengan session
        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Data berhasil dihapus');
            return redirect()->to('/');
        }
    }

    public function createProduk()
    {
        $produkInsert = [
            'namap' => $this->request->getVar('namap'),
            'skup' => $this->request->getVar('skup'),
            'desp' => $this->request->getVar('desp'),
            'merekp' => $this->request->getVar('merekp')
        ];

        // $this->userModel->insert($produkInsert);
        // return redirect()->to('/');

        if ($this->userModel->insert($produkInsert)) {
            session()->setFlashdata('success', 'Produk ditambah');
            return redirect()->to('/');
        }
    }

    public function deleteProduk($idp)
    {
        // $this->userModel->delete($idp);
        // return redirect()->to('/');

        if ($this->userModel->delete($idp)) {
            session()->setFlashdata('success', 'Produk dihapus');
            return redirect()->to('/');
        }
    }

    public function updateProduk($idp)
    {
        // $this->userModel->delete($idp);
        // return redirect()->to('/');

        $produkUpdate = [
            'namap' => $this->request->getVar('namap'),
            'skup' => $this->request->getVar('skup'),
            'desp' => $this->request->getVar('desp'),
            'merekp' => $this->request->getVar('merekp')
        ];

        if ($this->userModel->update($idp, $produkUpdate)) {
            session()->setFlashdata('success', 'Produk diedit');
            return redirect()->to('/');
        }
    }
}
