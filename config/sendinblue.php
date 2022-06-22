<?php

return [
    /*
     * ----------------------------------------------------
     * Sendinblue Credentials
     * ----------------------------------------------------
     *
     * This option specifies the Sendinblue credentials for
     * your account. You must put thoses settings into your
     * .env & .env.example file.
     *
     */
    'apikey' => env('SENDINBLUE_API_KEY', null),
    'name' => env('SENDINBLUE_NAME', null),
    'email' => env('SENDINBLUE_EMAIL', null)
];
