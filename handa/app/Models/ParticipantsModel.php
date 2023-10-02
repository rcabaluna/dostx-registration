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


        $query = $this->db->table('tblparticipants a');
            $query->select('a.*, b.sectorname, c.regDesc,e.name');
            $query->join('tblsector b', 'b.sectorid = a.sector');
            $query->join('refregion c', 'c.regCode = a.address_region');
            $query->join('refprovince d', 'd.provCode = a.address_province');
            $query->join('tblevents e', 'e.shorthand = a.event');
            
            if ($param['event'] != 'all' && $param['event'] != '') {
                $query->where($param);
            }
            $query->groupBy('a.regnumber');
            $query->orderBy('a.participantid', 'DESC');

        return $query->get()->getResultArray();
    }

    public function delete_participant($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }

}