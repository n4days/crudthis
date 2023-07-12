<?php

namespace App\Controllers;

use App\Models\User;

class Home extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }


    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $user = $this->userModel->getUserSearch($keyword);
        } else {
            $user = $this->userModel->getUser();
        }

        $nama = [
            "pertama" => "irsyad",
            "user" => $user->paginate(3, 'user'),
            'pager' =>  $this->userModel->pager
        ];
        // dd($nama);
        return view('user', $nama);
    }

    public function simpanUser()
    {
        // dd($_POST);

        $dataInsert = [
            'nama' => $this->request->getVar('nama'),
            'hp' => $this->request->getVar('noHp'),
            'alamat' => $this->request->getVar('alamat')
        ];

        if ($this->userModel->insert($dataInsert)) {
            session()->setFlashdata('success', 'Data Berhasil Disimpan');
            return redirect()->to('/');
        }

        // $this->userModel->insert($dataInsert);
        // return redirect()->to('/');
    }

    public function deleteUser($id)
    {
        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Data Berhasil Dihapus');
            return redirect()->to('/');
        }
    }

    public function editUser($id)
    {
        $dataUpdate = [
            'nama' => $this->request->getVar('nama'),
            'hp' => $this->request->getVar('noHp'),
            'alamat' => $this->request->getVar('alamat')
        ];

        if ($this->userModel->update($id, $dataUpdate)) {
            session()->setFlashdata('success', 'Data Berhasil Diubah');
            return redirect()->to('/');
        }
    }

    // public function sapa()
    // {
    //     return view('sapa');
    // }

    // public function hasilsapa()
    // {
    //     echo 'Nama yang diinput : ' . $this->request->getVar('nama');
    // }

    // // Inputan
    // public function login()
    // {
    //     return view('login');
    // }

    // // Outputan
    // public function nlogin()
    // {
    //     return view('nlogin');
    // }

    // public function saya($nama = 'irsyad', $umur = 23)
    // {
    //     echo 'Nama saya : ' . $nama . ' Umur : ' . $umur;
    // }
}
