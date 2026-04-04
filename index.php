<?php
// 1. הגדרות תצוגה וכותרות עבור ימות המשיח
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain; charset=utf-8');

// 2. נתיב לקובץ הנתונים (ב-Render הקובץ יישמר בזיכרון השרת)
$dataFile = 'registrations.json';
$maxCapacity = 100; // מכסה מקסימלית

// טעינת נתונים קיימים
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}
$registrations = json_decode(file_get_contents($dataFile), true);

// 3. קבלת מספר הטלפון מה-API
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';

// 4. בדיקת תקינות - אם אין מספר טלפון (כניסה ישירה מהדפדפן)
if (empty($phone)) {
    echo "id_list_message=f-שגיאה. מספר טלפון לא התקבל.";
    exit;
}

// 5. לוגיקה של הרישום
$response = "";

if (isset($registrations[$phone])) {
    // המשתמש כבר רשום
    $response = "id_list_message=f-כבר נרשמת בעבר. המקום שלך שמור.&go_to_folder=hangup";
} 
elseif (count($registrations) >= $maxCapacity) {
    // המכסה מלאה
    $response = "id_list_message=f-מצטערים, המכסה מלאה. לא ניתן להירשם יותר.&go_to_folder=hangup";
} 
else {
    // רישום חדש מוצלח
    $registrations[$phone] = [
        'date' => date('d/m/Y H:i:s'),
        'ip' => $_SERVER['REMOTE_ADDR']
    ];
    file_put_contents($dataFile, json_encode($registrations));
    $response = "id_list_message=f-נרשמת בהצלחה לסמסטר ב. להתראות!&go_to_folder=hangup";
}

// 6. שליחת התשובה לימות המשיח בצורה נקייה
ob_start();
echo $response;
header('Content-Length: ' . ob_get_length());
ob_end_flush();
flush();
exit;
?>
