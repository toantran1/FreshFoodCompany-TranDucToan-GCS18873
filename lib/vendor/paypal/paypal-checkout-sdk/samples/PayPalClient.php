<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment which has access
     * credentials context. This can be used invoke PayPal API's provided the
     * credentials have the access to do so.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }
    
    /**
     * Setting up and Returns PayPal SDK environment with PayPal Access credentials.
     * For demo purpose, we are using SandboxEnvironment. In production this will be
     * ProductionEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "<<AVXxiUcVNdBOTz69WN9VQpCJI_xLpIzkaEffgAyCCdaJys-kHpM49xs5L6wN3nqPdqnzBUu6rVuJCT_E>>";
        $clientSecret = getenv("CLIENT_SECRET") ?: "<<EJqyzpa4soBw_3bsRzszFRnFvnrq4M0yi617IbtYCJpm-_Q-fFDhDvKmxUsvykpVZfs3jFg_3wHLpEug>>";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
