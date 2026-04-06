<?php
class AbsensiController extends Controller {
    public function qr($sesi_id) {
        require_once '../libraries/phpqrcode/qrlib.php';
        
        $data = base64_encode(json_encode([
            'sesi_id' => $sesi_id,
            'timestamp' => time()
        ]));
        
        QRcode::png($data, false, QR_ECLEVEL_L, 10);
    }
}
?>