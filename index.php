<?php

use src\AzheSpace\Bot\Telegram\TelegramBot;

include_once './src/autoload.php';
include_once './Resources/Config/bot.php';

if (strlen($_GET['chat_id']) >= 9) {
	$bot = new TelegramBot(BOT_TOKEN);
	$bot->handle();
	echo "Sambungkan bot ke repository Anda." .
		"<br>Silakan pasang url di bawah ini di pengaturan Webhook\Integrasi." .
		"<br>https://integrate.azhe.space/236205726.php" .
		"<br><br>Penyedia yang di dukung: GitLab, GitHub";
} else {
	print "you can try send /start in Bot";
	header('Location: https://azhe.space');
}
