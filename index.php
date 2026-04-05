<?php
ob_start();
$phone = $_REQUEST['phone'] ?? '';
if (!empty($phone)) {
    file_put_contents('reg.txt', $phone . PHP_EOL, FILE_APPEND);
}
ob_end_clean();
echo "id_list_message=f-success&";
exit;
