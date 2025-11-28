 <?php
function sendTelegramMessage($message) {
    $token = "8107752339:AAHY_BXrUo6GZJAcWW1SQBR47P6x1F39-Gg";
    $chat_id = 2045958953;
    $text = urlencode($message);
    $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$text";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}


?> 


