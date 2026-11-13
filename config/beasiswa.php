<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Status Pembukaan Pendaftaran Beasiswa
    |--------------------------------------------------------------------------
    | Ubah PENDAFTARAN_DIBUKA=true di .env untuk membuka formulir pendaftaran
    | dan menu hasil seleksi pada dashboard peserta.
    */
    'pendaftaran_dibuka' => (bool) env('PENDAFTARAN_DIBUKA', false),
];
