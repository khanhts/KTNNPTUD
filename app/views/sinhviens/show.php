<?php include '/xampp/htdocs/website/KTNNPTUD/app/views/shares/header.php'; ?>

<h1>Danh sách sinh viên</h1>
<a href="?page=add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<ul class="list-group">
    <?php foreach ($sinhviens as $sinhvien): ?>
        <li class="list-group-item">
            <h2>
                <a href="#<?php echo $sinhvien->MaSV; ?>">
                    <?php echo htmlspecialchars($sinhvien->HoTen, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </h2>
            <p>Giới tính: <?php echo ($sinhvien->GioiTinh); ?></p>
            <p>Ngày sinh: <?php echo ($sinhvien->NgaySinh); ?></p>
            <p>Hình: <img src="<?php echo($sinhvien->Hinh);?>" alt="n/a"></p>
            <p>Mã ngành: <?php echo ($sinhvien->MaNganh); ?></p>
            
            <a href="?page=edit&id=<?php echo $sinhvien->MaSV; ?>" class="btn btn-warning">Sửa</a>
            <a href="/webbanhang/Product/delete/<?php echo $sinhvien->MaSV; ?>" 
               class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');">Xóa</a>
        </li>
    <?php endforeach; ?>
</ul>
