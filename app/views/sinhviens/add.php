<?php include '/xampp/htdocs/website/KTNNPTUD/app/views/shares/header.php'; ?>

<h1>Thêm sinh viên</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="/webbanhang/Product/save" onsubmit="return validateForm()" novalidate>
    <div class="form-group">
        <label for="masv">Mã sinh viên:</label>
        <input type="text" id="masv" name="masv" class="form-control" required/>
    </div>

    <div class="form-group">
        <label for="hoten">Họ và tên:</label>
        <input type="text" id="hoten" name="hoten" class="form-control" required/>
    </div>

    <div class="form-group">
        <label for="gioitinh">Giới tính:</label>
        <input type="text" id="gioitinh" name="gioitinh" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="ngaysinh">Ngày sinh:</label>
        <input type="date" id="ngaysinh" name="ngaysinh" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="hinh">Hình:</label>
        <input type="file" id="hinh" name="hinh" class="form-control"/>
    </div>

    <div class="form-group">
        <label for="manganh">Ngành học:</label>
        <select id="manganh" name="manganh" class="form-control" required>
            <?php foreach ($nganhhocs as $nganhhoc): ?>
                <option value="<?php echo htmlspecialchars($nganhhoc->MaNganh, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php echo htmlspecialchars($nganhhoc->TenNganh, ENT_QUOTES, 'UTF-8'); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Thêm sinh viên</button>
    <a href="?page=index" class="btn btn-secondary mt-2">Quay lại danh sách</a>
</form>
