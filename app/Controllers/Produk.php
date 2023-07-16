<?php

namespace App\Controllers;

// Include Models ke Controlles
use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\MerekModel;

class Produk extends BaseController
{
    // Membentuk __construct Models
    protected $produkModel;
    protected $kategoriModel;
    protected $merekModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
        $this->merekModel = new MerekModel();
    }

    public function index()
    {
        // $data = $this->produkModel->findAll();
        // $nama = [
        //     "Produk" => $data
        // ];

        // master produk
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data = $this->produkModel->getDataSearch($keyword);
        } else {
            $data = $this->produkModel->getData();
        }

        // $data = $this->produkModel->findAll();
        $nama = [
            "title" => "Data Produk",
            "breadcrumb" => ["Home", "Produk"],
            "datap" => $data->paginate(4, 'data'),
            "kategori" => $this->kategoriModel->findAll(),
            "merek" => $this->merekModel->findAll(),
            'pager' =>  $this->produkModel->pager
        ];

        // dd($nama['datap']);
        return view('produk', $nama);
    }

    public function createProduk()
    {
        $produkInsert = [
            'namap' => $this->request->getVar('namap'),
            'skup' => $this->request->getVar('skup'),
            'desp' => $this->request->getVar('desp'),
            'merekp' => $this->request->getVar('merekp'),
            'kategori' => $this->request->getVar('kategori')
        ];

        // $this->produkModel->insert($produkInsert);
        // return redirect()->to('/');

        if ($this->produkModel->insert($produkInsert)) {
            session()->setFlashdata('success', 'Produk ditambah');
            return redirect()->to('produk');
        }
    }

    public function deleteProduk($idp)
    {
        // $this->produkModel->delete($idp);
        // return redirect()->to('/');

        if ($this->produkModel->delete($idp)) {
            session()->setFlashdata('success', 'Produk dihapus');
            return redirect()->to('produk');
        }
    }

    public function updateProduk($idp)
    {
        $produkUpdate = [
            'namap' => $this->request->getVar('namap'),
            'skup' => $this->request->getVar('skup'),
            'desp' => $this->request->getVar('desp'),
            'merekp' => $this->request->getVar('merekp'),
            'kategori' => $this->request->getVar('kategori')
        ];

        if ($this->produkModel->update($idp, $produkUpdate)) {
            session()->setFlashdata('success', 'Produk diedit');
            return redirect()->to('produk');
        }
    }
}
