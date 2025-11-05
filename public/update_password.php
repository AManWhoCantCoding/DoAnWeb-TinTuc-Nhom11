<?php

// =========================================================
// THÔNG TIN KẾT NỐI DATABASE (BƯỚC 1: KẾT NỐI)
// =========================================================
$servername = "localhost"; // Thay thế nếu cần
$username_db = "root"; // Thay thế
$password_db = ""; // Thay thế
$dbname = "mvc_oop"; // Thay thế

// Dữ liệu cần cập nhật
$user_id_to_update = 127; // ID của người dùng cần đổi mật khẩu (ví dụ: ID = 1)
$new_password = "123456"; // Mật khẩu mới người dùng nhập

// =========================================================
// BƯỚC 2: BĂM MẬT KHẨU BẰNG Bcrypt (password_hash)
// =========================================================
// PASSWORD_DEFAULT sẽ tự động chọn thuật toán băm mạnh nhất (hiện tại là Bcrypt).
// Hàm này tự động tạo salt (muối) ngẫu nhiên và thêm vào chuỗi băm.
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Kiểm tra để đảm bảo mã băm đã được tạo
if (empty($hashed_password)) {
    die("Lỗi: Không thể tạo mã băm Bcrypt.");
}

// =========================================================
// BƯỚC 3: CẬP NHẬT MẬT KHẨU VÀO MYSQL
// =========================================================
try {
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sử dụng Prepared Statement để bảo mật
    $sql = "UPDATE users SET password = :hashed_password WHERE id = :user_id";

    $stmt = $conn->prepare($sql);

    // Gán giá trị vào các tham số
    $stmt->bindParam(':hashed_password', $hashed_password);
    $stmt->bindParam(':user_id', $user_id_to_update, PDO::PARAM_INT); // Đảm bảo ID là số nguyên

    // Thực thi câu lệnh
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "✅ Cập nhật mật khẩu thành công cho người dùng ID: " . $user_id_to_update;
    } else {
        echo "⚠️ Không tìm thấy người dùng có ID: " . $user_id_to_update . " hoặc mật khẩu không thay đổi.";
    }

} catch(PDOException $e) {
    echo "❌ Lỗi cơ sở dữ liệu: " . $e->getMessage();
}

$conn = null; // Đóng kết nối
?>