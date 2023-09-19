<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function get_par_att_data(){


        $builder = $this->db->table('tblevents a')
            ->select('a.name, a.shorthand, a.targetparticipants, a.buffer')
            ->select('(SELECT COUNT(b.participantid) FROM tblparticipants b WHERE b.event = a.shorthand) AS participantsno', false)
            ->select('(SELECT COUNT(*) FROM tblattendance c WHERE c.event = a.shorthand) AS attendanceno', false)
            ->groupBy('a.shorthand')
            ->orderBy('a.eventid', 'ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }

}