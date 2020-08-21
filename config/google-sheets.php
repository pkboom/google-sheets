<?php

return [
    /*
     * Set access type. Default is online.
     */
    'access_type' => 'online',

    /*
     * Set cache token key. We assume after logging in to google, token is stored in cache using this key.
     * So google client will retrieve a token from cache using key when it is created.
     */
    'access_token_key' => 'google_sheet_token',
];
