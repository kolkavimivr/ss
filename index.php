<?php
// 1. קבלת מספר הטלפון שימות המשיח שולחים (הפרמטר phone)
$phone = isset($_GET['phone']) ? $_GET['phone'] : '';

// 2. אם המספר לא ריק - שמור אותו
if (!empty($phone)) {
    // שמירה לקובץ בשם reg.txt (כל טלפון בשורה חדשה)
    file_put_contents('reg.txt', $phone . PHP_EOL, FILE_APPEND);
    
    // 3. שליחת הודעה חזרה לימות המשיח
    echo "id_list_message=f-נרשמת בהצלחה לסמסטר ב. תודה.&";
} else {
    // אם משום מה הטלפון לא הגיע
    echo "id_list_message=f-שגיאה, מספר הטלפון לא נקלט במערכת&";
}

exit;
