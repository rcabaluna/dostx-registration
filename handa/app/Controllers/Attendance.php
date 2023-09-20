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
        $data['pagetitle'] = "HANDA 2023 - Attendance List";
        $param['event'] = $this->request->getGet('event');
        $data['events'] = $this->attendanceModel->get_all_data('tblevents');
        $data['attendance'] = $this->attendanceModel->get_attendance_list('tblattendance',$param);
        return view('attendance/attendance-list',$data);
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
                return view("attendance/profile",$profile);
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
        $data['pagetitle'] = 'HANDA 2023 - Attendance QR Scanner';
        return view('attendance/scan-qr-code',$data);
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

    #CONFIRM ATTENDANCE FROM REGISTRATION LIST

    public function regConfirmAttendance(){
        $input = $this->request->getPost();

        $check = $this->attendanceModel->get_att_data('tblattendance',$input);

        if ($check) {
            echo "EXISTS";
        }else{
            $insert = $this->attendanceModel->insert_data('tblattendance',$input);
            echo "SUCCESS";
        }

    }
    
}
