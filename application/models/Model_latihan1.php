<?php
class Model_Latihan1 extends CI_Model
{
    //membuat variable untuk menampung nilai
    public $nilai1, $nilai2, $hasil;

    //method penjumlahan
    public function jumlah($n1 = null, $n2 = null)
    {
        $this->nilai1 = $ni11;
        $this=>nilai2 = $ni12;
        $this->hasil = $this->nilai1 + $this->nilai2;
        return $this->hasil;
    }
}