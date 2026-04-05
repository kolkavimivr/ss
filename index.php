<?php
$phone = $_REQUEST['phone'] ?? '';
if (!empty($phone)) {
    file_put_contents('reg.txt', $phone . PHP_EOL, FILE_APPEND);
}
header('Content-Type: text/plain');
echo "id_list_message=f-success&";
exit;
?>
