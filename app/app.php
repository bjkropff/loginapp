<?php

    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";

    //Class constructors Local
    require_once __DIR__."/../src/Account.php";

    session_start();
    if (empty($_SESSION['order_of_init'])) {
        $_SESSION['order_of_init'] = array();
    }

    $app = new Silex\Application();

    //MySQL database info changing to seetings.php outside of the docroot
    //Local
    require_once __DIR__."/../../settings_local.php";

    //Hosted/Live
    //require_once __DIR__."/../../../settings.php";


    $username = $settings['username'];
    $password = $settings['password'];
    $server = 'mysql:host=' .
        $settings['host'] . ':' .
        $settings['port'] . ';dbname=' .
        $settings['namedb'];

    $DB = new PDO($server, $username, $password);

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    // GETS

    // Go to homepage
    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('geammasters' => Gamemaster::getAllGeammaster()));
    });


    return $app;
?>
