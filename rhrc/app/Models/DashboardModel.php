<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function get_par_att_data(){
        $builder = $this->db->table('tblevents a')
            ->select('a.name, a.venue, a.datetime, a.shorthand, a.targetparticipants, a.buffer')
            ->select('(SELECT COUNT(b.participantid) FROM tblparticipants b) AS participantsno', false)
            ->select('(SELECT COUNT(*) FROM tblattendance c WHERE c.event = a.shorthand) AS attendanceno', false)
            ->groupBy('a.shorthand')
            ->orderBy('a.eventid', 'ASC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function get_eval_data(){

        $builder = $this->db->table('tblevaluation a');
        $builder->select('b.name');
        $builder->select('a.event');
        $builder->select('COUNT(a.evaluationid) AS noofrespondents');
        $builder->select('ROUND(AVG(IFNULL(a.q13a, 0)), 1) AS q13a', false);
        $builder->select('ROUND(AVG(IFNULL(a.q13b, 0)), 1) AS q13b', false);
        $builder->select('ROUND(AVG(IFNULL(a.q13c, 0)), 1) AS q13c', false);
        $builder->select('ROUND(AVG(IFNULL(a.q13d, 0)), 1) AS q13d', false);
        $builder->select('ROUND(AVG(IFNULL(a.q13e, 0)), 1) AS q13e', false);
        $builder->select('ROUND(AVG(IFNULL(a.q13f, 0)), 1) AS q13f', false);
        $builder->join('tblevents b', 'b.shorthand = a.event');
        $builder->groupBy('b.shorthand');
        $builder->orderBy('b.eventid');

        return $builder->get()->getResultArray();

    }

}