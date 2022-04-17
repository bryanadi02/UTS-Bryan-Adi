<?php

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
};

if (!empty($_POST['submit']) && isset($_FILES['attachment'])) {

    $from_email         = 'imeilredom@gmail.com';
    $sender_name = $_POST["sender_name"];
    $recipient_email = $_POST["recipient"];
    $reply_to_email = $from_email;
    $subject     = $_POST["subject"];
    $message     = $_POST["message"];

    $tmp_name = $_FILES['attachment']['tmp_name'];
    $name     = $_FILES['attachment']['name'];
    $size     = $_FILES['attachment']['size'];
    $type     = $_FILES['attachment']['type'];
    $error     = $_FILES['attachment']['error'];

    if ($type != "application/pdf") {
        die("hanya menerima file bentuk PDF");
    }
    if ($size > 1000000) {
        die('ukuran file lebih dari 1MB');
    }

    $handle = fopen($tmp_name, "r");
    $content = fread($handle, $size);
    fclose($handle);

    $encoded_content = chunk_split(base64_encode($content));

    $boundary = md5("random");

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From:" . $from_email . "\r\n";
    $headers .= "Reply-To: " . $reply_to_email . "\r\n";
    $headers .= "Content-Type: multipart/mixed;";
    $headers .= "boundary = $boundary\r\n";

    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));

    $body .= "--$boundary\r\n";
    $body .= "Content-Type: $type; name=" . $name . "\r\n";
    $body .= "Content-Disposition: attachment; filename=" . $name . "\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "X-Attachment-Id: " . rand(1000, 99999) . "\r\n\r\n";
    $body .= $encoded_content;

    $sentMailResult = mail($recipient_email, $subject, $body, $headers);

    if ($sentMailResult) {
        $file = fopen("upload.log", "a+");
        fwrite($file, "pengirim :" . $sender_name . "\n");
        fwrite($file, "email tujuan :" . $recipient_email . "\n");
        fwrite($file, "subject :" . $subject . "\n");
        fwrite($file, "message :" . $message . "\n");
        fwrite($file, "attachement file :" . $name . "\n");
        fwrite($file, "status :" . "berhasil" . "\n\n");
        fclose($file);
        alert("email sukses di kirim");
        header("index.php");
    } else {
        $file = fopen("upload.log", "a+");
        fwrite($file, "pengirim :" . $sender_name . "\n");
        fwrite($file, "email tujuan :" . $recipient_email . "\n");
        fwrite($file, "subject :" . $subject . "\n");
        fwrite($file, "message :" . $message . "\n");
        fwrite($file, "attachement file :" . $name . "\n");
        fwrite($file, "status :" . "gagal" . "\n\n");
        fclose($file);
        alert("terjadi kegagalan saat mengirim email, pastikan isi semua form");
        header("index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bryan Adi | Soal 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2> Kirim Email:</h2>
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" action="">
                    <div class="mb-3 mt-3">
                        <label>Nama Pengirim :</label>
                        <input type="text" class="form-control" id="sender" placeholder="Masukan Nama Pengirim" name="sender_name">
                    </div>
                    <div class="mb-3 mt-3">
                        <label>Email Tujuan:</label>
                        <input type="text" class="form-control" id="email" placeholder="Masukan Email Tujuan" value="dummyformailing@gmail.com, dummyformailing2@gmail.com" name="recipient">
                        <p><b>Note: </b>jika mengirim ke lebih dari 1 email pisahkan dengan tanda (,). contoh : email1@gmail.com,email2@gmail.com</p>
                    </div>
                    <div class="mb-3">
                        <label>Subject:</label>
                        <input type="text" class="form-control" id="subject" placeholder="Masukan Subject" name="subject">
                    </div>
                    <div class="mb-3 mt-3">
                        <label>Pesan:</label>
                        <textarea class="form-control" rows="5" id="message" name="message"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Attachement File:</label>
                        <input type="file" class="form-control" id="file" placeholder="masukan File" name="attachment">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </form>
            </div>
        </div>
    </div>

</body>

</html>