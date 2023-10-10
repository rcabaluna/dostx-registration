<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluationModel extends Model
{
    public function insert_data($tablename,$data){
		
        $builder = $this->db->table($tablename);
        $builder->insert($data);

        return $this->db->insertID();
    }

    public function get_all_data($tablename){

        $builder = $this->db->table($tablename);
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function get_single_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
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

    public function get_event_data($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

    public function get_participants_list($tablename, $param){
        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblevents', 'tblevents.shorthand = tblevaluation.event');
        if ($param['event'] != 'rstw-exhibits' && $param['event'] != 'opening-ceremony' && $param['event'] != 'closing-ceremony' && $param['event'] != 'press-conference' ) {
            $builder->join('refregion', 'refregion.regCode = tblevaluation.address_region');
            $builder->join('refprovince', 'refprovince.provCode = tblevaluation.address_province');
        }

        if ($param['event'] != 'all' && $param['event'] != '') {
            $builder->where($param);
        }
        $query = $builder->orderBy('tblevaluation.evaluationid','DESC');
        $query = $builder->get();
        
        return $query->getResultArray();
    }

    public function delete_evaluation($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }
}