<?php
// **
// USED TO DEFINE API ENDPOINTS
// **

$app->get('/plugin/plextvcleaner/settings', function($request, $response, $args) {
    $plextvcleaner = new plextvcleaner();
    if ($plextvcleaner->auth->checkAccess($plextvcleaner->config->get("Plugins", "Plex TV Cleaner")['ACL-PLEXTVCLEANER'] ?? "ACL-PLEXTVCLEANER")) {
        $plextvcleaner->api->setAPIResponseData($plextvcleaner->_pluginGetSettings());
    }
    $response->getBody()->write(jsonE($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});

$app->get('/plugin/plextvcleaner/shows', function($request, $response, $args) {
    $plextvcleaner = new plextvcleaner();
    if ($plextvcleaner->auth->checkAccess($plextvcleaner->config->get("Plugins", "Plex TV Cleaner")['ACL-PLEXTVCLEANER'] ?? "ACL-PLEXTVCLEANER")) {
        $plextvcleaner->getTvShows();
    } else {
        $plextvcleaner->api->setAPIResponse('Error', 'Access Denied');
    }
    $response->getBody()->write(jsonE($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});

$app->post('/plugin/plextvcleaner/cleanup/{showPath}', function($request, $response, $args) {
    $plextvcleaner = new plextvcleaner();
    if ($plextvcleaner->auth->checkAccess($plextvcleaner->config->get("Plugins", "Plex TV Cleaner")['ACL-PLEXTVCLEANER'] ?? "ACL-PLEXTVCLEANER")) {
        $params = $plextvcleaner->api->getAPIRequestData($request);
        $params['path'] = urldecode($args['showPath']);
        $plextvcleaner->cleanup($params);
    } else {
        $plextvcleaner->api->setAPIResponse('Error', 'Access Denied');
    }
    $response->getBody()->write(jsonE($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});