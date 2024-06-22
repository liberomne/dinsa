<?php

class M_Home extends CI_Model
{

    public function getProfil()
    {
        $query = $this->db->query("SELECT * FROM profil_laundry");
        return $query->result_array();
    }

    public function total_konsumen()
    {
        return $this->db->get('konsumen')->num_rows();
        // konsumen di sini adalah tabel konsumen

    }
    public function transaksi_baru()
    {
        $this->db->where('status', 'Baru');
        // untuk memanggil berapa jumlah transaksi yang statusnya masih baru (ada pada tabel transaksi kolom status)
        return $this->db->get('transaksi')->num_rows();

    }

    public function total_transaksi()
    {
        return $this->db->get('transaksi')->num_rows();
    }
    
}
