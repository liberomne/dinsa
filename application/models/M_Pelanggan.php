<?php

class M_Pelanggan extends CI_Model
{
    public function is_pelanggan($email)
    {
        $query = $this->db->get_where('pelanggan', ['email' => $email]);
        return $query->num_rows() > 0;
    }

    public function simpanData($data = null)
    {
        $this->db->insert('pelanggan', $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('pelanggan', $where);
    }

    public function getUser()
    {
        return $this->db->get('pelanggan');
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('pelanggan', $where);
    }

    public function cekUserAccess($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->limit(10, 0);
        return $this->db->get();
    }

    public function generate_kode_pelanggan()
    {
        $this->db->select('RIGHT(pelanggan.kode_pelanggan,3) as kode', false);
        $this->db->order_by('kode_pelanggan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('pelanggan');
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "P" . $kodemax;
        return $kodejadi;
    }

    public function getAllDatapelanggan()
    {
        return $this->db->get('pelanggan')->result();
    }

    public function edit($id)
    {
        $this->db->select('*');
        $this->db->from('pelanggan'); //pelanggan adalah nama tabel
        $this->db->where('kode_pelanggan', $id);
        return $this->db->get()->row_array();
    }

    public function update($kode_pelanggan, $data)
    {
        $this->db->where('kode_pelanggan', $kode_pelanggan);
        $this->db->update('pelanggan', $data);

    }

    public function delete($id)
    {
        $this->db->where('kode_pelanggan', $id);
        $this->db->delete('pelanggan');
    }
}