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
            $query->select('a.*, e.name,e.shorthand');
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