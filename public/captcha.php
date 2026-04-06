<?php
session_start();
header('Content-Type: image/png');

// Generate 5 karakter acak (huruf besar + angka, tanpa simbol)
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ123456789';
$text = '';
for ($i = 0; $i < 5; $i++) {
    $text .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha'] = $text;

// Buat gambar
$img = imagecreate(120, 40);
$bg = imagecolorallocate($img, 245, 245, 245); // abu sangat muda
$text_color = imagecolorallocate($img, 80, 60, 40); // coklat tua
$line_color = imagecolorallocate($img, 200, 180, 140);

// Gambar garis acak
for ($i = 0; $i < 5; $i++) {
    imageline($img, rand(0, 120), rand(0, 40), rand(0, 120), rand(0, 40), $line_color);
}

// Tulis teks
imagestring($img, 5, 30, 12, $text, $text_color);

imagepng($img);
imagedestroy($img);
?>