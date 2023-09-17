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
        return view('attendance/attendance-list',$data);
    }

    public function AttendanceConfirm(){
        $currentDate = date('Y-m-d');
        # CHECK IF QR IS IN VALID DATE
        $input = $this->request->getPost('data');
        $data['regnumber'] = $input;       

        # Check if QR is valid or invalid
        $profile = $this->attendanceModel->get_data('tblparticipants',array('regnumber' => $data['regnumber']));
        $eventsToAttend = explode(", ",$profile['event']);

        foreach ($eventsToAttend as $eventsToAttendRow) {
            if ($eventsToAttendRow == "Day 1") {
                $eventDate = "2023-10-10";
                if ($eventDate == $currentDate) {
                    $check = $this->attendanceModel->get_att_data('tblattendance',array('regnumber' => $input, 'date(attendance_date)' => $eventDate));
                    if (!$check) {
                        return view("attendance/profile",$profile);
                    }else{
                        echo "EXISTS";
                        exit();
                    }
                }
            }else if ($eventsToAttendRow == "Day 2") {
                $eventDate = "2023-10-11";
                if ($eventDate == $currentDate) {
                    $check = $this->attendanceModel->get_att_data('tblattendance',array('regnumber' => $input, 'date(attendance_date)' => $eventDate));
                    if (!$check) {
                        return view("attendance/profile",$profile);
                    }else{
                        echo "EXISTS";
                        exit();
                    }
                }
            }else if ($eventsToAttendRow == "Day 3") {
                $eventDate = "2023-10-12";
                if ($eventDate == $currentDate) {
                    $check = $this->attendanceModel->get_att_data('tblattendance',array('regnumber' => $input, 'date(attendance_date)' => $eventDate));
                    if (!$check) {
                        return view("attendance/profile",$profile);
                    }else{
                        echo "EXISTS";
                        exit();
                    }
                }
            }
        }

        echo "INVALID";
        exit();
    }

    public function AttendanceSave(){
        $currentDate = date('Y-m-d');

        $input = $this->request->getPost('data');

        $data['regnumber'] = $input;
        $data['date(attendance_date)'] = $currentDate;

        $check = $this->attendanceModel->get_att_data('tblattendance',$data);

        if ($check) {
            echo "EXISTS";
            exit();
        }else{
            unset($data['date(attendance_date)']);
            $insert = $this->attendanceModel->insert_data('tblattendance',$data);
            if ($insert) {
                echo "SUCCESS";
            }
        }
    }

    public function scanQRCode(){
        $data['pagetitle'] = '6th RHRC - Admin | Attendance QR Scanner';
        return view('attendance/scan-qr-code',$data);
    }

    public function deleteAttendance(){
        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['attendanceid'] = $this->request->getGet('attendanceid');
        $this->attendanceModel->delete_attendance('tblattendance',$param);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }
    
}
