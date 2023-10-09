<?php

namespace App\Controllers;

use App\Models\AttendanceModel;

class Attendance extends BaseController
{

    public $attendanceModel;

	public function __construct()
    {
        $this->attendanceModel = new AttendanceModel();
    }

    public function index(){
        $data['pagetitle'] = "6th RHRC - Admin | Attendance List";
        $param['event'] = $this->request->getGet('event');
        $data['events'] = $this->attendanceModel->get_all_data('tblevents');
        $data['attendance'] = $this->attendanceModel->get_attendance_list('tblattendance',$param);
        return view('admin/attendance/attendance-list',$data);
    }

    public function AttendanceConfirm(){
        $today = date('Y-m-d');

        $data['regnumber'] = $this->request->getPost('data');
    
            if ($today == '2023-10-10') {
                $data['event'] = 'Day 1';
            }elseif($today == '2023-10-11'){
                $data['event'] = 'Day 2';
            }elseif ($today == '2023-10-12') {
                $data['event'] = 'Day 3';
            }
                
            if (isset($data['event'])) {
                $check = $this->attendanceModel->get_part_data('tblparticipants',$data);
                if ($check) {
                    $checkatt = $this->attendanceModel->get_att_data('tblattendance',$data);
                        if ($checkatt) {
                                echo "EXISTS";
                                exit();
                        }else{
                                return view('admin/attendance/profile',$check);
                        }
                }else{
                    echo "INVALID";
                }
            }else{
                echo "INVALID";
            }
                
    }

    public function AttendanceSave(){
        $today = date('Y-m-d');

        $data['regnumber'] = $this->request->getPost('data');
    
            if ($today == '2023-10-10') {
                $data['event'] = 'Day 1';
            }elseif($today == '2023-10-11'){
                $data['event'] = 'Day 2';
            }elseif ($today == '2023-10-12') {
                $data['event'] = 'Day 3';
            }

            if (isset($data['event'])) {
                $check = $this->attendanceModel->get_part_data('tblparticipants',$data);
                if ($check) {
                    $checkatt = $this->attendanceModel->get_att_data('tblattendance',$data);
                        if ($checkatt) {
                            echo "EXISTS";
                        }else{
                            $insert = $this->attendanceModel->insert_data('tblattendance',$data);
                            if ($insert) {
                                echo "SUCCESS";
                            }
                        }
                }else{
                    echo "INVALID";
                }
            }else{
                echo "INVALID";
            }
    }

    public function scanQRCode(){
        $data['pagetitle'] = '6th RHRC - Admin | Attendance QR Scanner';
        return view('admin/attendance/scan-qr-code',$data);
    }

    public function deleteAttendance(){
        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['attendanceid'] = $this->request->getGet('attendanceid');
        $this->attendanceModel->delete_attendance('tblattendance',$param);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }

        # CONFIRM ATTENDANCE BY USER SEARCH

    
        public function AttendanceSearchUser(){
            $data['participants'] = '';
        
            if ($this->request->getGet()) {
                $param = $this->request->getGet();
                $data['participants'] = $this->attendanceModel->search_participant('tblparticipants',$param);
                $data['events'] = $this->attendanceModel->get_available_events($param);
    
            } 
            $data['pagetitle'] = 'HANDA Pilipinas 2023 - Attendance (Search Participant)';
            return view('admin/attendance/search-user',$data);
        }
        
        public function AttendanceConfirmBySearch(){
            
            $today = date('Y-m-d');
            $previousUrl = $this->request->getServer('HTTP_REFERER');
    
            $data = $this->request->getPost();
      
                if ($today == '2023-10-10') {
                    $data['event'] = 'Day 1';
                }elseif($today == '2023-10-11'){
                    $data['event'] = 'Day 2';
                }elseif ($today == '2023-10-12') {
                    $data['event'] = 'Day 3';
                }

                if (isset($data['event'])) {
                    $check = $this->attendanceModel->get_part_data('tblparticipants',$data);
                    if ($check) {
                        $checkatt = $this->attendanceModel->get_att_data('tblattendance',$data);
                            if ($checkatt) {
                                if (!empty($previousUrl)) {
                                    $this->session->setFlashdata('exists',true);
                                    return redirect()->to($previousUrl);
                                }
                            }else{
                                $insert = $this->attendanceModel->insert_data('tblattendance',$data);
                                if ($insert) {
                                    if (!empty($previousUrl)) {
                                        $this->session->setFlashdata('confirmed',true);
                                        return redirect()->to($previousUrl);
                                    }
                                }
                            }
                    }else{
                        if (!empty($previousUrl)) {
                            $this->session->setFlashdata('invalid',true);
                            return redirect()->to($previousUrl);
                        }
                    }
                }else{
                    if (!empty($previousUrl)) {
                        $this->session->setFlashdata('invalid',true);
                        return redirect()->to($previousUrl);
                    }
                }                
        }       
}
