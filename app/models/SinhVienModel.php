<?php
class SinhVienModel{
    private $conn;
    private $table_name = "sinhvien";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getSinhViens(){
        $query = "SELECT s.MaSV, s.HoTen, s.GioiTinh, s.NgaySinh, s.Hinh, s.MaNganh
                    FROM " . $this->table_name . " s
                    LEFT JOIN nganhhoc n ON s.MaNganh = n.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getSinhVienByMaSV($masv){
        $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaSV', $masv);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function addSinhVien($masv, $hoten, $gioitinh, $ngaysinh, $hinh, $manganh){
        $errors = [];
        if(empty($masv)){
            $error['masv'] = 'Mã sinh viên không được để trống';
        }
        else{
            $query = "SELECT * FROM " . $this->table_name . " WHERE MaSV = :MaSV";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':MaSV', $masv);
            $stmt->execute();
            if($stmt->fetch(PDO::FETCH_OBJ)){
                $error['masv'] = 'Đã tồn tại sinh viên này';
            }
        }
        if(empty($hoten)){
            $error['hoten'] = 'Họ và tên sinh viên không được để trống';
        }
        if(count($errors)>0){
            return $errors;
        }

        $query = "INSERT INTO ".$this->table_name." (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
        $stmt = $this->conn->prepare($query);

        $masv = htmlspecialchars(strip_tags($hoten));
        $hoten = htmlspecialchars(strip_tags($hoten));
        $gioitinh = htmlspecialchars(strip_tags($gioitinh));
        $hinh = htmlspecialchars(strip_tags($hinh));
        $manganh = htmlspecialchars(strip_tags($manganh));

        $stmt->bindParam(':MaSV',$masv);
        $stmt->bindParam(':HoTen',$hoten);
        $stmt->bindParam(':GioiTinh',$gioitinh);
        $stmt->bindParam(':NgaySinh',$ngaysinh);
        $stmt->bindParam(':Hinh',$hinh);
        $stmt->bindParam(':MaNganh',$manganh);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function updateSinhVien($masv, $hoten, $gioitinh, $ngaysinh, $hinh, $manganh){
        $query = "UPDATE ".$this->table_name." SET HoTen=:HoTen, description=:description, price=:price, category_id=:category_id";
        $stmt = $this->conn->prepare($query);

        $hoten = htmlspecialchars(strip_tags($hoten));
        $gioitinh = htmlspecialchars(strip_tags($gioitinh));
        $hinh = htmlspecialchars(strip_tags($hinh));
        $manganh = htmlspecialchars(strip_tags($manganh));

        $stmt->bindParam(':MaSV',$masv);
        $stmt->bindParam(':HoTen',$hoten);
        $stmt->bindParam(':GioiTinh',$gioitinh);
        $stmt->bindParam(':NgaySinh',$ngaysinh);
        $stmt->bindParam(':Hinh',$hinh);
        $stmt->bindParam(':MaNganh',$manganh);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function deleteSinhVien($masv){
        $query = "DELETE FROM ".$this->table_name." WHERE MaSV=:MaSV";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':MaSV',$masv);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>