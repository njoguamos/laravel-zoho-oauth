<?php

return [
    'invalid_grant'         => 'The grant_type is not specified as authtooauth. Change the grant type in your request to "authtooauth".',
    'access_denied'         => 'The Authtoken you specified has already been used to generate OAuth tokens. \n Enter a different Authtoken in your request.',
    'invalid_code'          => "Invalid Code. \n 1. The grant token has expired. Generate the access and refresh tokens before the grant token expires. \n 2. You have already used the grant token.\n 3. The refresh token to generate a new access token is wrong or revoked. Specify the correct refresh token value while refreshing an access token.",
    'invalid_client'        => 'The client ID you specified is wrong. Enter a valid client ID, and ensure that the client ID and Authtoken in your request have the same owner.',
    'invalid_authtoken'     => 'The authtoken you specified is wrong. Ensure that your Authtoken is correct and that it hasn\'t already been converted to OAuth.',
    'invalid_client_secret' => 'You have passed an invalid Client secret. Specify the correct client secret.',
    'invalid_request'       => 'You have not specified a valid soid parameter.',
    'default'               => "The following error occurred - :error",
    'no_refresh_token'      => 'Sorry, no access token found in the database. Run zoauth:init first.',
    'db_empty'              => 'Database empty, nothing to clean. Consider running zoauth:prune instead.',
    'successful_save'       => 'Successfully saved authorization codes to the database.'
];