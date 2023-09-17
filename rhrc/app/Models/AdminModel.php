<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{

    public function get_all_data($tablename){

        $builder = $this->db->table($tablename);
        $query   = $builder->get();

        return $query->getResultArray();
    }

}