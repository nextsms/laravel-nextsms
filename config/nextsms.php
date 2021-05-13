<?php

return [


    /*
     * Username from NextSMS
     *
     */
    'username' => env('NEXTSMS_USERNAME'),

    /*
     * Password from NextSMS
     *
     */
    'key' => env('NEXTSMS_PASSWORD'),

    /*
     * Shortcode for sending SMS from NextSMS
     *
     */
    'from' => env('NEXTSMS_FROM'),

    /*
     * Enviroment from NextSMS
     *
     */
    'enviroment' => env('NEXTSMS_ENVIROMENT'),
];
