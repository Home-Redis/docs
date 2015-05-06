<head><link href="/favicon.ico" rel="shortcut icon"><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<?php 

	date_default_timezone_set('America/Los_Angeles');
	require '\predis\autoload.php';

	$redis = new Redis();
	$redis->connect('127.0.0.1',6379);
//	$redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);

	$redis->set('TestData:1','a');
	$redis->set('TestData:2','b');
	$redis->set('TestData:3','c');
	$it = null;
	echo "Scan without prefixes\n";
//	while(false !== ($key = $redis->scan($it, 'TestData:*'))){
//		var_dump($key);
//	}
	$it = null;
	echo "Scan with prefixes\n";
	
	//$redis->setOption(Redis::OPT_PREFIX, 'MySite:');
	//var_dump( $redis->keys('*') );
	//var_dump( $redis->keys('MySite:TestData:*') );
	
	//while(false !== ($key = $redis->scan($it, 'MySite:TestData:*'))){
	//	var_dump($key);
	$keys = $redis->keys('*');
	foreach ($keys as $key) {
		echo "\n *** " . $key;
	}


	
?>