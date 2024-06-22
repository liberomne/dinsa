<?php

class M_Baju extends CI_Model
{

    public function generate_kode_baju()
    {
        $this->db->select('RIGHT(katalog.kode_katalog,3) as kode', false);
        $this->db->order_by('kode_katalog', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('katalog');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "K" . $kodemax;
        return $kodejadi;
    }
    public function getBaju()
    {
        return $this->db->get('katalog')->result(); //baju adalah nama tabel pada database
    }

    public function edit_baju($kode_katalog)
    {
        $this->db->where('kode_katalog', $kode_katalog);
        return $this->db->get('katalog')->row_array();
    }

    public function update($data, $kode_katalog){
        $this->db->where('kode_katalog', $kode_katalog);
        $this->db->update('katalog', $data);
    }

    public function total_jenis()
    {
        return $this->db->get('katalog')->num_rows();
    }

    public function total_metode_pembayaran()
    {
        return $this->db->get('pembayaran')->num_rows();
    }

    public function total_transaksi()
    {
        return $this->db->get('transaksi')->num_rows();
    }

    public function total_krisar()
    {
        return $this->db->get('krisar')->num_rows();
    }
}
