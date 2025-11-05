<?php

// 📄 Tệp này gửi (chia sẻ) thông tin và đối tượng đến các trang giao diện (views)

// Đường dẫn đến thư mục chứa các file template (header, footer, navbar, v.v.)
$tpl = dirname(__FILE__) . '/templates/';

// Khởi tạo các đối tượng hỗ trợ hiển thị và xử lý dữ liệu
$format = new Format();              // Định dạng dữ liệu, ví dụ: cắt chuỗi, format ngày tháng, v.v.
$path = new Path();                  // Xây dựng đường dẫn tuyệt đối/tương đối cho file CSS, JS, ảnh, v.v.
$common_data = new Get_common_data();// Lấy dữ liệu chung (ví dụ: logo, danh mục, bài viết, tin mới, v.v.)
$date = new Date();                  // Xử lý định dạng ngày tháng
