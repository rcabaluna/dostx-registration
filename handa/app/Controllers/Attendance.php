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
        $data['pagetitle'] = "HANDA Pilipinas 2023 - Attendance List";
        $param['event'] = $this->request->getGet('event');
        $data['events'] = $this->attendanceModel->get_all_data('tblevents');
        $data['attendance'] = $this->attendanceModel->get_attendance_list('tblattendance',$param);
        return view('admin/attendance/attendance-list',$data);
    }

    public function AttendanceConfirm(){
        $input = explode("/",$this->request->getPost('data')); ;

        $data['event'] =  $input[0];
        $data['regnumber'] = $input[1];       

        # Check if QR is valid or invalid
        $profile = $this->attendanceModel->get_data('tblparticipants',array('regnumber' => $data['regnumber']));

        if ($profile) {
            # Check if attendance data already exists
            $check = $this->attendanceModel->get_att_data('tblattendance',$data);
            if ($check) {
                echo "EXISTS";
                exit();
            }else{
                return view("admin/attendance/profile",$profile);
            }
        }else{
            echo "INVALID";
        }

    }

    public function AttendanceSave(){
        $input = explode("/",$this->request->getPost('data')); ;

        $data['event'] =  $input[0];
        $data['regnumber'] = $input[1];

        $check = $this->attendanceModel->get_att_data('tblattendance',$data);

        if ($check) {
            echo "EXISTS";
            exit();
        }else{
            $insert = $this->attendanceModel->insert_data('tblattendance',$data);
            if ($insert) {
                echo "SUCCESS";
            }
        }
    }

    public function scanQRCode(){
        $data['pagetitle'] = 'HANDA Pilipinas 2023 - Attendance QR Scanner';
        return view('admin/attendance/scan-qr-code',$data);
    }

    public function deleteAttendance(){
        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['attendanceid'] = $this->request->getGet('attendanceid');
        $this->attendanceModel->delete_attendance('tblattendance',$param);
        
        $this->session->setFlashdata('delete',true);
        
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
        }
        
        $data['pagetitle'] = 'HANDA Pilipinas 2023 - Attendance (Search Participant)';
        return view('admin/attendance/search-user',$data);
    }
    
    public function AttendanceConfirmBySearch(){
        
        $previousUrl = $this->request->getServer('HTTP_REFERER');
        
        

        $data = $this->request->getPost();
  
        $check = $this->attendanceModel->get_att_data('tblattendance',$data);

        if ($check) {
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


    }
    
}
