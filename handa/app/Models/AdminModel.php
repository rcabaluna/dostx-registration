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

    public function update_status($tablename,$param){
        
        $builder = $this->db->table($tablename);
        $builder->set('is_closed', $param['is_closed']);
        $builder->where('shorthand', $param['shorthand']);

        $builder->update();

    }
}