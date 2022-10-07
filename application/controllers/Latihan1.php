<?php
class Latihan1 extends CI_Controller
{
    public function index()
    {
        echo "Selamat Datang.. selamat belajar Web Programming";
        //$this->load->view('view-latihan');
    }

    public function penjumlahan($sn1, $sn2)
    {
        $this->load->model('Model_Latihan');

        $data['nilai'] = $sn1;
        $data['nilai'] = $sn2;
        $data['hasil'] = $this->Model_Latihan->jumlah($sn1, $sn2);

        $this->load->view('view-latihan', $data);
    }