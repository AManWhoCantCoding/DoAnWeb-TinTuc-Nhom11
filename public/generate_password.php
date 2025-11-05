<?php
$pass = "123456"; // bạn có thể đổi thành mật khẩu tùy ý
echo password_hash($pass, PASSWORD_DEFAULT);