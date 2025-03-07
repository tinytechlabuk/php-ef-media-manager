<?php
// Get a list of combined TV Shows
$app->get('/mediamanager/media/tvshows', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    if ($MediaManager->auth->checkAccess($MediaManager->config->get("Plugins", "Media Manager")['ACL-MEDIAMANAGER'] ?? "ACL-MEDIAMANAGER")) {
        $params = $request->getQueryParams();
        $Results = $MediaManager->getTVShowsTable($params);
        $total = $MediaManager->getTotalTVShows(); // Function to get total count of records
        if ($Results) {
            $MediaManager->api->setAPIResponseData(['total' => $total, 'rows' => $Results]);
        }
    }
    $response->getBody()->write(json_encode($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});

// Run a synchronisation for combined TV Shows
$app->post('/mediamanager/media/tvshows/update', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    if ($MediaManager->auth->checkAccess($MediaManager->config->get("Plugins", "Media Manager")['ACL-MEDIAMANAGER'] ?? "ACL-MEDIAMANAGER")) {
        $Results = $MediaManager->updateTVShowTable();
        if (isset($Results['result'])) {
            if ($Results['result'] != 'Error') {
                $MediaManager->api->setAPIResponseMessage($Results['message']);
            } else {
                $MediaManager->api->setAPIResponse($Results['result'],$Results['message']);
            }
        } else {
            $MediaManager->api->setAPIResponse('Error',$Results);
        }
    }
    $response->getBody()->write(jsonE($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});



// **
// MATCH TAUTULLI -> RADARR
// **

// Get a list of combined Movies
$app->get('/mediamanager/media/movies', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    if ($MediaManager->auth->checkAccess($MediaManager->config->get("Plugins", "Media Manager")['ACL-MEDIAMANAGER'] ?? "ACL-MEDIAMANAGER")) {
        $params = $request->getQueryParams();
        $Results = $MediaManager->getMoviesTable($params);
        $total = $MediaManager->getTotalMovies(); // Function to get total count of records
        if ($Results) {
            $MediaManager->api->setAPIResponseData(['total' => $total, 'rows' => $Results]);
        }
    }
    $response->getBody()->write(json_encode($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});

// Run a synchronisation for combined Movies
$app->post('/mediamanager/media/movies/update', function($request, $response, $args) {
    $MediaManager = new MediaManager();
    if ($MediaManager->auth->checkAccess($MediaManager->config->get("Plugins", "Media Manager")['ACL-MEDIAMANAGER'] ?? "ACL-MEDIAMANAGER")) {
        $Results = $MediaManager->updateMoviesTable();
        if (isset($Results['result'])) {
            if ($Results['result'] != 'Error') {
                $MediaManager->api->setAPIResponseMessage($Results['message']);
            } else {
                $MediaManager->api->setAPIResponse($Results['result'],$Results['message']);
            }
        } else {
            $MediaManager->api->setAPIResponse('Error',$Results);
        }
    }
    $response->getBody()->write(jsonE($GLOBALS['api']));
    return $response
        ->withHeader('Content-Type', 'application/json;charset=UTF-8')
        ->withStatus($GLOBALS['responseCode']);
});