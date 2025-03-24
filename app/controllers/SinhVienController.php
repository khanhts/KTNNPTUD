<?php
require_once('/xampp/htdocs/website/KTNNPTUD/app/config/database.php');
require_once('/xampp/htdocs/website/KTNNPTUD/app/models/SinhVienModel.php');
require_once('/xampp/htdocs/website/KTNNPTUD/app/models/NganhHocModel.php');

class SinhVienController{
    private $sinhvienModel;
    private $db;

    function __construct(){
        $this->db = (new Database())->getConnection();
        $this->sinhvienModel = new SinhVienModel($this->db);
    }

    function index(){
        $sinhviens = $this->sinhvienModel->getSinhViens();
        if($sinhviens)
            include '/xampp/htdocs/website/KTNNPTUD/app/views/sinhviens/show.php';
        else
            echo "Không có sinh viên.";
    }

    function add(){
        $nganhhocs = (new NganhHocModel($this->db))->getNganhHocs();
        include_once '/xampp/htdocs/website/KTNNPTUD/app/views/sinhviens/add.php';
    }

    function save(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $masv = $_POST['masv'] ?? '';
            $hoten = $_POST['hoten'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? null;
            $ngaysinh = $_POST['ngaysinh'] ?? null;
            $hinh = $_POST['hinh'] ?? null;
            $manganh = $_POST['manganh'] ?? null;

            $result = $this->sinhvienModel->addSinhVien($masv, $hoten, $gioitinh, $ngaysinh, $hinh, $manganh);
            if(is_array($result)){
                $errors = $result;
                $nganhhocs = (new NganhHocModel($this->db))->getNganhHocs();
                include '/xampp/htdocs/website/KTNNPTUD/app/views/sinhviens/add.php';
            }
            else{
                header('Location: index.php');
            }
        }
    }

    function edit(){
        $sinhvien = $this->sinhvienModel->getSinhVienByMaSV($_GET['id']);
        $nganhhocs = (new NganhHocModel($this->db))->getNganhHocs();

        if($sinhvien)
            include '/xampp/htdocs/website/KTNNPTUD/app/views/sinhviens/edit.php';
        else
            echo "Không thấy sinh viên này.";
    }

    function update(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $masv = $_POST['masv'];
            $hoten = $_POST['hoten'];
            $gioitinh = $_POST['gioitinh'];
            $ngaysinh = $_POST['ngaysinh'];
            $hinh = $_POST['hinh'];
            $manganh = $_POST['manganh'];

            $edit = $this->sinhvienModel->updateSinhVien($masv, $hoten, $gioitinh, $ngaysinh, $hinh, $manganh);
            if($edit){
                header('Location: /xampp/htdocs/website/KTNNPTUD/app/views/sinhviens/show.php');
            }
            else{
                echo "Đã xảy ra lỗi khi lưu sinh viên";
            }
        }
    }

    function delete(){
        if($this->sinhvienModel->deleteSinhVien($_GET['id'])){
            header('Location: index.php');
        }else{
            echo "Đã xảy ra lỗi khi xóa sinh viên";
        }
    }
}
?>