<?php

namespace App\Models;

use CodeIgniter\Model;

class CertificateModel extends Model
{

    public function get_single_data($tablename,$param){

        $builder = $this->db->table('tblevaluation a');
        $builder->select("a.certnumber, a.certnumber_hashed, a.event, a.fullname, a.email, a.agency_name, b.name as eventname, b.datetime");
        $builder->join('tblevents b','b.shorthand = a.event');
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }
}