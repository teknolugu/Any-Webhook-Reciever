<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Git Event Integrator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php
$chat_id = $_GET['chat_id'];

?>
<div class="container">
    <h3>Sambungkan bot ke repository Anda.</h3>
    <p>Silakan pasang url di bawah ini di pengaturan Webhook\Integrasi. <br>
        https://integrate.winten.space/<?= $chat_id; ?>.php</p>

    <p>Penyedia layanan Git yang di dukung: GitLab, GitHub. (yang lain segera)</p>
</div>
</body>
</html>
