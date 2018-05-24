<?

if (!$_GET['code']) {
    exit('error code');
}

include 'config.php';

$token = json_decode(file_get_contents('https://graph.facebook.com/v2.9/oauth/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code']), true);

if (!$token) {
    exit('error token');
}

$data = json_decode(file_get_contents('https://graph.facebook.com/v2.9/me?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code'].'&access_token='.$token['access_token'].'&fields=id,name,email,gender,location'), true);

if (!$data) {
    exit('error data');
}

$data['avatar'] = 'https://graph.facebook.com/v2.9/'.$data['id'].'/picture?width=200&height=200';


echo '<pre>';
var_dump($data);
echo '</pre>';

?>
