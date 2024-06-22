<?php

class M_Keranjang extends CI_Model
{

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    public function get_notif_keranjang($id_pelanggan) {
        // Ambil data keranjang yang belum lunas untuk pelanggan tertentu
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('lunas', 0);
        $keranjang = $this->db->get('keranjang')->result_array();

        // Hitung total jumlah barang yang belum lunas
        $notif_keranjang = 0;
        foreach ($keranjang as $k) {
            $notif_keranjang += $k['jumlah'];
        }

        // Simpan nilai notif_keranjang ke dalam session
        $this->session->set_userdata('notif_keranjang', $notif_keranjang);

        // Opsional: Kembalikan nilai notif_keranjang jika dibutuhkan
        return $notif_keranjang;
    }

    public function getBaju()
    {
        return $this->db->get('katalog')->result(); 
    }
    
    public function find($id)
    {
        $result = $this->db->where('kode_katalog', $id)
                            ->limit(1)
                            ->get('katalog');
        if($result->num_rows() > 0){
            return $result->row();
        }else{
            return array();
        }
    }


    public function getDataWhere($table, $where)
	{
		$this->db->where($where);
		return $this->db->get($table);
	}

    public function getKeranjangByIdUser($id_pelanggan)
    {
        // Ambil data keranjang yang belum lunas untuk pelanggan tertentu
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->where('lunas', 0);
        return $this->db->get('keranjang')->result();
    }

    public function update_status($kode_transaksi, $status)
    {

        $this->db->set('status', $status);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi'); //nama tabel
    }

    public function update_status1($kode_transaksi, $status, $tgl_ambil, $status_bayar)
    {
        $this->db->set('status', $status);
        $this->db->set('tgl_ambil', $tgl_ambil);
        $this->db->set('bayar', $status_bayar);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi'); //nama tabel
    }
}