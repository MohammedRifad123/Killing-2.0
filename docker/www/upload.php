<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $dir = '/tmp/uploads/';
        if (!is_dir($dir)) mkdir($dir, 0755, true);
        move_uploaded_file(
            $_FILES['file']['tmp_name'],
            $dir . basename($_FILES['file']['name'])
        );
        echo json_encode(['status' => 'uploaded']);
    }
} else {
    http_response_code(405);
}
