<?php
/**
 * Script: find_mvc_oop.php
 * Tác dụng: Quét toàn bộ dự án để tìm các dòng chứa "/mvc_oop/"
 */

$directory = __DIR__ . '/../'; // ✅ quét toàn bộ dự án 
$keyword = '/mvc_oop/'; // Chuỗi cần tìm
$found = [];

function scanDirectory($dir, $keyword, &$found) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($path)) {
            scanDirectory($path, $keyword, $found);
        } else {
            if (pathinfo($path, PATHINFO_EXTENSION) === 'php') {
                $lines = file($path);
                foreach ($lines as $lineNumber => $line) {
                    if (stripos($line, $keyword) !== false) {
                        $found[] = [
                            'file' => $path,
                            'line' => $lineNumber + 1,
                            'content' => trim($line)
                        ];
                    }
                }
            }
        }
    }
}

scanDirectory($directory, $keyword, $found);

echo "<h2>Kết quả tìm kiếm chuỗi '$keyword'</h2>";
if (empty($found)) {
    echo "<p style='color:green'>✅ Không tìm thấy chuỗi nào chứa '$keyword'.</p>";
} else {
    echo "<p><b>Tổng cộng:</b> " . count($found) . " kết quả.</p>";
    echo "<table border='1' cellpadding='5' cellspacing='0' style='border-collapse:collapse;'>";
    echo "<tr style='background:#f0f0f0'><th>STT</th><th>File</th><th>Dòng</th><th>Nội dung</th></tr>";
    foreach ($found as $i => $item) {
        echo "<tr>";
        echo "<td>" . ($i + 1) . "</td>";
        echo "<td>" . htmlspecialchars($item['file']) . "</td>";
        echo "<td>" . $item['line'] . "</td>";
        echo "<td><code>" . htmlspecialchars($item['content']) . "</code></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
