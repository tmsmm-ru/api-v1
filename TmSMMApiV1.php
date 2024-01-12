<?php

class TmSMMApiV1
{
    private $uriAPI = 'https://tmsmm.ru/api/v1/';
    private $token;

    public function __construct($token)
    {
        if (empty($token)) {
            throw new \Exception('Empty token.');
        }

        $this->token = $token;
    }

    public function getProfile()
    {
        return $this->_api('GET', 'profile');
    }

    public function getTaskT1($id)
    {
        return $this->_api('GET', 'tasks/t1/' . $id);
    }

    public function createTaskT1($data)
    {
        return $this->_api('POST', 'tasks/t1', $data);
    }

    public function deleteTaskT1($id)
    {
        return $this->_api('DELETE', 'tasks/t1/' . $id);
    }

    public function pauseTaskT1($data)
    {
        return $this->_api('POST', 'tasks/t1/pause', $data);
    }

    public function getTaskT2($id)
    {
        return $this->_api('GET', 'tasks/t2/' . $id);
    }

    public function createTaskT2($data)
    {
        return $this->_api('POST', 'tasks/t2', $data);
    }

    public function deleteTaskT2($id)
    {
        return $this->_api('DELETE', 'tasks/t2/' . $id);
    }

    public function pauseTaskT2($data)
    {
        return $this->_api('POST', 'tasks/t2/pause', $data);
    }

    public function getTaskT3($id)
    {
        return $this->_api('GET', 'tasks/t3/' . $id);
    }

    public function createTaskT3($data)
    {
        return $this->_api('POST', 'tasks/t3', $data);
    }

    public function deleteTaskT3($id)
    {
        return $this->_api('DELETE', 'tasks/t3/' . $id);
    }

    public function pauseTaskT3($data)
    {
        return $this->_api('POST', 'tasks/t3/pause', $data);
    }

    private function _api($customRequest, $url = '', $params = [])
    {
        $uri = $this->uriAPI . $url . '?token=' . $this->token;

        return $this->_checkResponse(
            $this->_curl($uri, $params, $customRequest)
        );
    }

    private function _checkResponse($response)
    {
        if (empty($response)) {
            throw new \Exception('Empty response.');
        }

        $data = json_decode($response, true);

        if (json_last_error()) {
            throw new \Exception('Error json decode.');
        }

        return $data;
    }

    private function _curl($uri, $params = [], $customRequest = 'GET')
    {
        $curl = curl_init($uri);

        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $customRequest);

        if (! empty($params)) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        }

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}

try {
    $token = ''; // token

    $oTmSMM = new TmSMMApiV1($token);

    // ...
} catch (\Exception $e) {
    echo $e->getMessage();
}
