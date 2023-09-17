<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
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

    public function get_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblsector', 'tblsector.sectorid = tblparticipants.sector');
        $builder->join('refregion', 'refregion.regCode = tblparticipants.address_region');
        $builder->join('refprovince', 'refprovince.provCode = tblparticipants.address_province');
        $builder->join('tblevents', 'tblevents.shorthand = tblparticipants.event');
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

    public function get_att_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getRowArray();
    }

    public function get_attendance_list($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblparticipants', 'tblparticipants.regnumber = tblattendance.regnumber');
        $builder->join('tblsector', 'tblsector.sectorid = tblparticipants.sector');
        $builder->join('refregion', 'refregion.regCode = tblparticipants.address_region');
        $builder->join('refprovince', 'refprovince.provCode = tblparticipants.address_province');
        $builder->join('tblevents', 'tblevents.shorthand = tblattendance.event');

        if ($param['event'] != 'all' && $param['event'] != '') {
            $builder->where('tblattendance.event',$param['event']);
        }
        $query = $builder->orderBy('tblattendance.regnumber','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function delete_attendance($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }
}