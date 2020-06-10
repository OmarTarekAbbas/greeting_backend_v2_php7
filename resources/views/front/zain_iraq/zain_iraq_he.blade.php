<?php

define('ServiceKey', 'BPMgnXIBfLoxjEnE6WUx');
define('uniqueUrlIdentifier', 'token');

define('TransactionID', (isset($_GET['transaction_id']) ? $_GET['transaction_id'] : time()));
define('APIURL', 'http://sg.apiserver.shield.monitoringservice.co/' . ServiceKey . '/' . TransactionID . '/JS');
define('ApiSnippetUrl', 'https://uk.api.shield.monitoringservice.co/');
$head = apache_request_headers();
if (is_array($head) !== false) {
    $h = urlencode(json_encode($head));
} else {
    $h = "";
}
$ctx = stream_context_create(array('http' => array('user_agent' => $_SERVER['HTTP_USER_AGENT'])));
$params = http_build_query(array(
    'lpu' => urlencode((isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http') . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']),
    'timestamp' => str_replace('.', '', isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : microtime(true)),
    'user_ip' => $_SERVER['REMOTE_ADDR'],
    'head' => $h
));
$response = json_decode(file_get_contents(APIURL . "?" . $params, null, $ctx));
if (!empty($response)) {
    $source = $response->source;
    $uniqid = $response->uniqid; // Unique Key To Use For Block API Call
} else {
    $uniqid = md5($params['user_ip'] . '-' . TransactionID . '-' . microtime(true)); // Unique Key To Use For Block API Call
    $source = "(function(s, o, u, r, k){
            b = s.URL;
            a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.setAttribute('crossorigin', 'anonymous');
            a.src = u+'script.js?ak='+k+'&lpi='+" . TransactionID . "+'&lpu='+encodeURIComponent(b)+'&key=$uniqid';
            m.parentNode.insertBefore(a, m);
    })(document, 'script', '" . ApiSnippetUrl . "', '" . TransactionID . "', '" . ServiceKey . "');";
}
?>

<!-- $uniqid Will Be Used To Call Block API -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MCP Shield Server Side Script Load | Demo</title>
    <script type="text/javascript">
        //<![CDATA[
        <?=$source?>
        //]]>
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- Body Will Go Here -->
</body>
</html>
