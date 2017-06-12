<?php

$app->post('/api/Darksky/getTimeMachineRequest', function ($request, $response) {
    /** @var \Slim\Http\Response $response */
    /** @var \Slim\Http\Request $request */
    /** @var \Models\checkRequest $checkRequest */

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'coordinates', 'time']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $postData = $validateRes;
    }

    $param = [];

    $date = DateTime::createFromFormat('Y-m-d  H:i:s', $postData['args']['time']);
    if (!$date instanceof DateTime) {
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Please check time format. Accepted format: YYYY-MM-DD HH:mm:ss';
        return $response->withJson($result);
    }

    $url = $settings['apiUrl'] . "/" . $postData['args']['apiKey'] . "/" . $postData['args']['coordinates'] . ',' . $date->getTimestamp();

    if (!empty($postData['args']['exclude'])) {
        $param['exclude'] = implode(',', $postData['args']['exclude']);
    }

    if (!empty($postData['args']['lang'])) {
        $param['lang'] = $postData['args']['lang'];
    }
    if (!empty($postData['args']['units'])) {
        $param['units'] = $postData['args']['units'];
    }

    try {
        /** @var GuzzleHttp\Client $client */
        $client = $this->httpClient;
        $vendorResponse = $client->get($url, [
            'query' => $param
        ]);
        $vendorResponseBody = $vendorResponse->getBody()->getContents();
        if ($vendorResponse->getStatusCode() == 200) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = json_decode($vendorResponse->getBody());
        }
        else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($vendorResponseBody) ? $vendorResponseBody : json_decode($vendorResponseBody);
        }
    } catch (\GuzzleHttp\Exception\BadResponseException $exception) {
        $vendorResponseBody = $exception->getResponse()->getBody();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = json_decode($vendorResponseBody);
    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);
});
