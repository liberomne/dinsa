<?php

class M_Katalog extends CI_Model
{
    public function getBaju()
    {
        return $this->db->get('katalog')->result(); //slider adalah nama tabel pada database
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
}