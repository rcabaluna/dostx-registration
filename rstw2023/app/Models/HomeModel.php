<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{

    public function get_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

}