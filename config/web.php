<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/'             => 'WebsiteController@werbeseite',
    "/demo"         => "DemoController@demo",
    '/dbconnect'    => 'DemoController@dbconnect',
    '/debug'        => 'HomeController@debug',
    '/error'        => 'DemoController@error',
    '/requestdata'   => 'DemoController@requestdata',

    // Erstes Beispiel:
    '/m4_6a_queryparameter' => 'ExampleController@m4_6a_queryparameter',
    '/m4' => 'ExampleController@m4_6a_queryparameter',
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte' => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout' => 'ExampleController@m4_7d_layout',
    '/test' => 'ExampleController@test',

    // Werbeseite
    '/werbeseite' => 'WebsiteController@werbeseite',
    '/wunschgericht' => 'WebsiteController@wunschgericht',

    '/anmeldung' => 'WebsiteController@anmeldung',
    '/anmeldung_verfizieren' => 'WebsiteController@anmeldung_verfizieren',
    '/abmeldung' => 'WebsiteController@abmeldung',

    '/test' => 'TestController@test'

);