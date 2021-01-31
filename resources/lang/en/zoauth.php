<?php

return [
    'invalid_code'          => "Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.",
    'invalid_client'        => 'You have passed an invalid Client ID or secret. Specify the correct client ID and secret.',
    'invalid_client_secret' => 'You have passed an invalid Client secret. Specify the correct client secret.',
    'default'               => 'The following error occurred - :error',
    'no_refresh_token'      => 'Sorry, no access token found in the database. Run zoauth:init first.',
    'db_empty'              => 'Database empty, nothing to clean. Consider running zoauth:prune instead.',
    'successful_save'       => 'Successfully saved authorization codes to the database.',
];
