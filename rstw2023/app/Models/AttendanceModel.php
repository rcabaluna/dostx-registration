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

    public function get_all_data_where($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where($param);
        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function get_attendance_list($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->select('*,tblattendance.date_registered AS attendance_date');
        $builder->join('tblparticipants', 'tblparticipants.regnumber = tblattendance.regnumber');
        $builder->join('tblevents', 'tblevents.shorthand = tblattendance.event');

        if ($param['event'] != 'all' && $param['event'] != '') {
            $builder->where('tblattendance.event',$param['event']);
        }
        $query = $builder->orderBy('tblattendance.attendanceid','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function delete_attendance($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }

    public function get_attendance_list_recent_5($tablename){


        $builder = $this->db->table($tablename);
        $builder->select('tblparticipants.*,tblattendance.date_registered AS date_registered,tblevents.shorthand,refregion.regDesc,refprovince.provDesc,tblsector.sectorname,tblevents.name');
        $builder->join('tblparticipants', 'tblparticipants.regnumber = tblattendance.regnumber');
        $builder->join('tblevents', 'tblevents.shorthand = tblparticipants.event');
        $query = $builder->orderBy('tblattendance.date_registered','DESC');
        $query = $builder->limit(5);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function search_participant($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblevents', 'tblevents.shorthand = tblparticipants.event');
        $builder->like('lastname',$param['lastname'],'both');
        $builder->like('firstname',$param['firstname'],'both');
        $builder->orderBy('tblparticipants.participantid','DESC');

        $query   = $builder->get();

        return $query->getResultArray();
    }

    public function get_available_events($param){
        $lastname = $param['lastname'];
        $firstname = $param['firstname'];

        $builder = $this->db->table('tblevents a');
        $builder->select('*');
        $builder->where('a.is_closed !=', 1);
        $builder->whereNotIn('a.shorthand', function($subquery)  use ($lastname, $firstname){

            $subquery->select('b.event')->from('tblparticipants b')
                    ->like('b.lastname',$lastname,'both')
                    ->like('b.firstname',$firstname,'both');
        }
    );
        return $builder->get()->getResultArray();
    }

    public function replicate_participants_data($tablename,$param)
    {
        $builder = $this->db->table('tblparticipants');
        $columns = 'regnumber, title, lastname, firstname, middle_initial, suffix, contactno, email, sex, position, agency_name, agency_address, privileges, event';

        $builder->select($columns);
        $builder->where('regnumber', $param['regnumber']); // Filter based on the regnumber condition
        $query = $builder->get()->getRowArray();

        $query['regnumber'] = $param['new_regnumber'];
        $query['event'] = $param['event'];
        
        $builder = $this->db->table($tablename);
        $builder->insert($query);

        return $this->db->insertID();

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
}