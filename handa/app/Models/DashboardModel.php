<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function get_par_att_data(){


        $sql = "SELECT a.name,a.shorthand, (SELECT COUNT(b.participantid) FROM tblparticipants b WHERE b.event = a.shorthand) AS participantsno, (SELECT COUNT(*) FROM tblattendance c WHERE c.event = a.shorthand) AS attendanceno FROM tblevents a GROUP BY a.shorthand ORDER BY a.eventid";
        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

}