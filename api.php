<?php
$botToken = 'BOT_TOKEN';
$adminChatId = 'ADMIN_CHAT_ID';

$name = $_POST['name'];
$username = $_POST['username'];
$message = $_POST['message'];
$ip = $_POST['ip'];
$userAgent = $_POST['user_agent'];

$telegramMessage = "New Message!\n\nName: $name\nUsername: $username\nMessage:\n$message\n\nIP: $ip\nUser Agent: $userAgent";

$telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$adminChatId&text=" . urlencode($telegramMessage);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
    http_response_code(200);
} else {
    http_response_code(500);
}
