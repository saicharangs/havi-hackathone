<?php

require('../vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$app['debug'] = true;

$dbopts = parse_url(getenv('DATABASE_URL'));
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'),
               array(
                'pdo.server' => array(
                   'driver'   => 'pgsql',
                   'user' => $dbopts["user"],
                   'password' => $dbopts["pass"],
                   'host' => $dbopts["host"],
                   'port' => $dbopts["port"],
                   'dbname' => ltrim($dbopts["path"],'/')
                   )
               )
);




// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});


$app->get('/vsignup', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('vsignup.twig');
});


$app->get('/db/', function() use($app) {
  $st = $app['pdo']->prepare('SELECT name FROM test_table');
  $st->execute();

  $names = array();
  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
    $app['monolog']->addDebug('Row ' . $row['name']);
    $names[] = $row;
  }

  return $app['twig']->render('database.twig', array(
    'names' => $names
  ));
});

$app->post('/vsignup', function (Request $request) use($app) {
    $message = $request->get('message');
    $uid=$request->get('uname');
	$pwd=$request->get('cpsd');
	$date=$request->get('date');
	$email=$request->get('email');
	$phno=$request->get('number');

	$st = $app['pdo']->prepare("INSERT INTO table1(name,password,date,email,phoneNo) VALUES ('$uid','$pwd','$date','$email','&phno')");
	$st->execute();


    return new Response('Successfully registered, please click here to <a href="https://havi-hackthon.herokuapp.com/">Login</a>', 201);
});

$app->post('/login', function (Request $request) use($app) {
	$username=$request->get('uname');
	$pass=$request->get('pwd');
	
	$st = $app['pdo']->prepare("SELECT password FROM table1 where uid='$username'");
	$st->execute();

	  $res = array();
	  while ($row = $st->fetch(PDO::FETCH_ASSOC)) {
		$app['monolog']->addDebug('Row ' . $row['name']);
		$res[] = $row;
	  }
	  
	  $loggedinuser;
	  
	  foreach ($res as $key => $val) {
		echo "$key => $val \n";
		if($val['name']==$username && $val['password']==$pass)
		{
		  $loggedinuser	= $username;
		}
	  }
	  
	  if($loggedinuser != null) {
		  return new Response('Login Successfully.', 200);
	  } else {
		  return new Response('Invalid username or password', 200);
	  }
});


$app->run();





