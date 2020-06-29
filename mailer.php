<?php

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Ambil data.
$name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$cont_subject = trim($_POST["subject"]);
$message = trim($_POST["message"]);

// Cek data email.
if ( empty($name) OR empty($cont_subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Gagal Request
    http_response_code(400);
    echo "Maaf! Sepertinya terjadi kesalahan pada pesan kamu";
    exit;
}

// Atur set mailku.
// Email.
$recipient = "contact@alfianmahfudfajri.io";

// Atur set.
$subject = "Kontak Baru from $name";

// Bangun email.
$email_content = "Nama: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Subjek: $cont_subject\n\n";
$email_content .= "Pesan:\n$message\n";

// Build the email headers.
$email_headers = "From: $name <$email>";

// Ketika kirim email.
if (mail($recipient, $subject, $email_content, $email_headers)) {
    // Sukses Kirim
    http_response_code(200);
    echo "Terimakasih Sudah mengirimkan pesan";
} else {
    // Error Pesan
    http_response_code(500);
    echo "Maaf! Sepertinya terjadi kesalahan pada pesan kamu";
}

} else {
// Tidak merespon
http_response_code(403);
echo "Halaman Tidak tersedia, Coba lagi deh.";
}

?>
