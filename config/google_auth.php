<?php

return [
    "base_url" => "http://letsrepair.dev/auth-google/auth",
        "providers" => [
            "Google" => [
                "enabled" => true,
                "keys"    => ["id" => "71829786145-24g70jt8ib27rdbhc66khsauurkt9ib5.apps.googleusercontent.com",
                    "secret" => "taQFHoMZP_2NNiPAh4uDwciL"
                ],
                    "scope" => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email " . // optional
                               "https://www.googleapis.com/auth/fusiontables"   , // optional
    ]]
];
