<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipantsModel extends Model
{

    public function get_all_data($tablename){

        $builder = $this->db->table($tablename);
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function get_participants_list($tablename,$param){


        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblsector', 'tblsector.sectorid = tblparticipants.sector');
        $builder->join('refregion', 'refregion.regCode = tblparticipants.address_region');
        $builder->join('refprovince', 'refprovince.provCode = tblparticipants.address_province');

        if ($param['event'] != 'all' && $param['event'] != '') {
            $builder->where($param);
        }
        $query = $builder->orderBy('tblparticipants.regnumber','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function delete_participant($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }

}