<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Laporan extends CI_Model
{


    public function getTransaksi()
    {
        $this->db->select('transaksi.*, GROUP_CONCAT(keranjang.jenis_katalog SEPARATOR "<br>") as jenis_katalog, 
        GROUP_CONCAT(katalog.harga_satuan SEPARATOR "<br>") as harga_satuan, 
        GROUP_CONCAT(keranjang.jumlah SEPARATOR "<br>") as jumlah,
        GROUP_CONCAT(keranjang.subtotal SEPARATOR "<br>") as subtotal');
        $this->db->from('keranjang');
        $this->db->join('transaksi', 'keranjang.kode_transaksi = transaksi.kode_transaksi');
        $this->db->join('katalog', 'keranjang.kode_katalog = katalog.kode_katalog');
        $this->db->group_by('transaksi.kode_transaksi');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function filter_laporan($tgl_masuk, $tgl_ambil)
    {
        $this->db->select('transaksi.*, GROUP_CONCAT(keranjang.jenis_katalog SEPARATOR "<br>") as jenis_katalog, 
        GROUP_CONCAT(katalog.harga_satuan SEPARATOR "<br>") as harga_satuan, 
        GROUP_CONCAT(keranjang.jumlah SEPARATOR "<br>") as jumlah,
        GROUP_CONCAT(keranjang.subtotal SEPARATOR "<br>") as subtotal');
        $this->db->from('keranjang');
        $this->db->join('transaksi', 'keranjang.kode_transaksi = transaksi.kode_transaksi');
        $this->db->join('katalog', 'keranjang.kode_katalog = katalog.kode_katalog');

        // Tambahkan validasi untuk tanggal
        if ($tgl_masuk && $tgl_ambil) {
            $this->db->where('transaksi.tgl_masuk >=', $tgl_masuk);
            $this->db->where('transaksi.tgl_masuk <=', $tgl_ambil);
            $this->db->where('transaksi.tgl_ambil >=', $tgl_masuk);
            $this->db->where('transaksi.tgl_ambil <=', $tgl_ambil);
        }

        $this->db->group_by('transaksi.kode_transaksi');
        $query = $this->db->get();
        return $query->result();
    }
}