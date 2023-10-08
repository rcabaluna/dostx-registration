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

    public function get_part_data($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->where('regnumber',$param['regnumber']);
        $builder->like('event',$param['event'],'both');
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

        $builder = $this->db->table($tablename.' e');
        $builder->select('a.participantid, a.regnumber, a.title, a.lastname, a.firstname, a.middle_initial, a.suffix, a.contactno, a.email, a.sex, a.position, a.sector, a.address_region, a.address_province, a.agency_name, a.privileges, a.event, a.date_registered,c.regDesc,d.provDesc,b.sectorname,e.attendance_date,e.attendanceid');
        $builder->join('tblparticipants a', 'a.regnumber = e.regnumber');
        $builder->join('tblsector b', 'b.sectorid = a.sector');
        $builder->join('refregion c', 'c.regCode = a.address_region');
        $builder->join('refprovince d', 'd.provCode = a.address_province');
        $query = $builder->orderBy('e.attendanceid','DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function delete_attendance($tablename,$param){
        $builder = $this->db->table($tablename);
        $builder->where($param);
        $builder->delete();
    }

    public function search_participant($tablename,$param){

        $builder = $this->db->table($tablename);
        $builder->select('*');
        $builder->join('tblsector', 'tblsector.sectorid = tblparticipants.sector');
        $builder->join('refregion', 'refregion.regCode = tblparticipants.address_region');
        $builder->join('refprovince', 'refprovince.provCode = tblparticipants.address_province');
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
        $columns = 'regnumber, title, lastname, firstname, middle_initial, suffix, contactno, email, sex, position, sector, address_region, address_province, agency_name, privileges, event';

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