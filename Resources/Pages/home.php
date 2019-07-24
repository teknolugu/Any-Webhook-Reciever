<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Git Event Integrator</title>
    <link rel="stylesheet" href="https://cdn.winten.space/vendor/bootstrap/bootstrap-4.3.1-dist/css/bootstrap.min.css">
</head>
<body>
<?php
$chat_id = $_GET['chat_id'];

?>
<div class="container">
    <h3>Sambungkan bot ke repository Anda.</h3>
    <p>Silakan pasang url di bawah ini di pengaturan Webhook\Integrasi.</p>
    <label for="myInput">URL</label>
    <input type="text" readonly size="50" value="https://integrate.winten.space/<?= $chat_id; ?>.php" id="myInput">
    <button onclick="copy()">Copy URL</button>
    <label id="statusCopy"></label>
    <br><br>
    <p><b>Catatan:</b> Penyedia layanan Git yang di dukung: GitLab, GitHub. (yang lain segera)</p>
</div>
</body>
<script>
    async function copy() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");
        var statusCopy = document.getElementById("statusCopy");

        /* Select the text field */
        copyText.select();

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        // alert("Copied the text: " + copyText.value);
        statusCopy.innerText = "Berhasil di salin";
        await sleep(2000);
        statusCopy.innerText = "";

    }
</script>
</html>
