<?php
$phone = $_REQUEST['phone'] ?? '';

if (!empty($phone)) {
    file_put_contents('reg.txt', $phone . PHP_EOL, FILE_APPEND);
    // תשובה נקייה ללא תווים נסתרים
    echo "id_list_message=f-success&";
} else {
    echo "id_list_message=f-error&";
}
exit;
