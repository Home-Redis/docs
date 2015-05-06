<?

//$redis = new Redis();
//$redis->connect('localhost:6379');

try {
    $redis = new Redis();
    $redis->connect('localhost:6379');
} catch(RedisException $e) {
    exit('Connect error');
}

$benchmark = microtime(true);

for($i=0;$i < 80000; $i++)
    $redis->set('key','value');

echo microtime(true) - $benchmark;

?>