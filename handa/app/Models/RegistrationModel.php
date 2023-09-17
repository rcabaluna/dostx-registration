<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrationModel extends Model
{

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

    public function get_all_data($tablename){

        $builder = $this->db->table($tablename);
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function get_data_where($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

    public function get_data_where_all($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function check_user_exists($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

    public function check_user_exists_by_name($tablename,$param){

        $builder = $this->db->table('tblparticipants');

        // Set the conditions for lastname and firstname
        $builder->where('lastname',$param['lastname']);
        $builder->where('firstname',$param['firstname']);
        $builder->where('middle_initial',$param['middle_initial']);
        $builder->where('suffix',$param['suffix'],'both');
        $builder->where('event',$param['event']);
        $builder->where('email', $param['email']);
        $builder->where('contactno', $param['contactno']);

        $query = $builder->get();

        return $query->getRowArray();
    }

    public function find_qr_data($param){

        $builder = $this->db->table('tblparticipants');

        // Set the conditions for lastname and firstname
        $builder->where('lastname',$param['lastname']);
        $builder->where('firstname',$param['firstname']);
        $builder->where('middle_initial',$param['middle_initial']);
        $builder->where('suffix',$param['suffix']);
        $builder->where('email', $param['email']);
        $builder->where('contactno', $param['contactno']);

        $query = $builder->get();

        return $query->getRowArray();
    }

}