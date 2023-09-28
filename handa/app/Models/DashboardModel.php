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

    public function get_eval_data(){

        $builder = $this->db->table('tblevaluation a');
        $builder->select('b.name');
        $builder->select('COUNT(a.evaluationid) AS noofrespondents');
        $builder->select('ROUND(AVG(IFNULL(a.responsiveness, 0)), 1) AS responsiveness', false);
        $builder->select('ROUND(AVG(IFNULL(a.reliability, 0)), 1) AS reliability', false);
        $builder->select('ROUND(AVG(IFNULL(a.access_and_facilities, 0)), 1) AS access_and_facilities', false);
        $builder->select('ROUND(AVG(IFNULL(a.communication, 0)), 1) AS communication', false);
        $builder->select('ROUND(AVG(IFNULL(a.cash, 0)), 1) AS cash', false);
        $builder->select('ROUND(AVG(IFNULL(a.integrity, 0)), 1) AS integrity', false);
        $builder->select('ROUND(AVG(IFNULL(a.assurance, 0)), 1) AS assurance', false);
        $builder->select('ROUND(AVG(IFNULL(a.outcome, 0)), 1) AS outcome', false);
        $builder->select('ROUND(AVG(IFNULL(a.overall_satisfaction, 0)), 1) AS overall_satisfaction', false);
        $builder->join('tblevents b', 'b.shorthand = a.event');
        $builder->groupBy('b.shorthand');
        $builder->orderBy('b.eventid');

        return $builder->get()->getResultArray();

    }

}