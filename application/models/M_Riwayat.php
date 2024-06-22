<?php

class M_Riwayat extends CI_Model
{
    public function index()
    {

    }
    public function getAllDataRiwayat()
    {
        return $this->db->get('keranjang')->result();
    }

    // public function generateKode()
    // {
    //     $this->db->select('RIGHT(riwayat.kode_transaksi,3) as kode', false);
    //     $this->db->order_by('kode_transaksi', 'desc');
    //     $this->db->limit(1);
    //     $query = $this->db->get('riwayat');
    //     if ($query->num_rows() > 0) {
    //         $data = $query->row();
    //         $kode = intval($data->kode) + 1;
    //     } else {
    //         $kode = 1;
    //     }
    //     $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
    //     $kodejadi = "" . $kodemax;
    //     return $kodejadi;
    // }

    public function update_status($kode_transaksi, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi');
    }

    public function update_status1($kode_transaksi, $status, $tgl_ambil)
    {
        $this->db->set('status', $status);
        $this->db->set('tgl_ambil', $tgl_ambil);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi');
    }

    public function detail_transaksi($kode_transaksi)
    {
        $result = $this->db->where('kode_transaksi', $kode_transaksi)->limit(1)->get('transaksi');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
        // $this->db->get('transaksi')->result();
    }

    public function detail_keranjang($kode_transaksi)
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('transaksi', 'keranjang.kode_transaksi = transaksi.kode_transaksi');
        $this->db->join('katalog', 'keranjang.kode_katalog = katalog.kode_katalog');
        $this->db->where('keranjang.kode_transaksi', $kode_transaksi);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}