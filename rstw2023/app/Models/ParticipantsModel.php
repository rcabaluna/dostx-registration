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

    public function check_participant_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where('event',$param['event']);
        $builder->like('lastname',$param['lastname'],'left');
        $builder->like('firstname',$param['firstname'],'left');
        $builder->like('middle_initial',$param['middle_initial'],'left');
        $builder->like('suffix',$param['suffix'],'left');

        $query   = $builder->get();

        return $query->getRowArray();
    }

    function get_doc_number($docnumber){

        $prefix="";
        try {
                $this->db->transStart();
                $generate = $this->db->query("SELECT prefix,`value` FROM tblgenerator WHERE code='$docnumber'  FOR UPDATE");

                $value = $generate->getRow()->value;
                $docprefix = $generate->getRow()->prefix;

                $builder = $this->db->table('tblgenerator');
                $builder->set('value', $value+1);
                $builder->where('code', $docnumber);
                $builder->update();
                $this->db->transComplete();
                
                for($x=1;$x<=(3-strlen($value));$x++){
                    $prefix.="0";
                }    
            return $docprefix.date("Y").$prefix.$value;

		}catch (\Exception $e){
            die($e->getMessage());
		}
    }

    public function insert_data($tablename,$data){

		
        $builder = $this->db->table($tablename);
        $builder->insert($data);

        return $this->db->insertID();
    }

}