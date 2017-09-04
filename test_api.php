<?php

/**
 * [http ���ýӿں���]
 * @Date   2016-07-11
 * @Author GeorgeHao
 * @param  string       $url     [�ӿڵ�ַ]
 * @param  array        $params  [����]
 * @param  string       $method  [GET\POST\DELETE\PUT]
 * @param  array        $header  [HTTPͷ��Ϣ]
 * @param  integer      $timeout [��ʱʱ��]
 * @return [type]                [�ӿڷ�������]
 */
function http($url, $params, $method = 'GET', $header = array(), $timeout = 5)
{
    //$header = array('Content-Type: application/json'/*, 'Content-Length: ' . strlen($data_string)*/);
    
    // POST �ύ��ʽ�Ĵ��� $set_params �������ַ�����ʽ
    $opts = array(
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => $header
    );
     
    /* �����������������ض����� */
    switch (strtoupper($method)) {
        case 'GET':
            $opts[CURLOPT_URL] = $url;
            if($params != ""){
                $url = $url . '?' . http_build_query($params); 
            }     
            break;
        case 'POST':
            $params = http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        case 'DELETE':
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_HTTPHEADER] = array("X-HTTP-Method-Override: DELETE");
            $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        case 'PUT':
            // $params = http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 0;
            $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        case 'PATCH':
            // $params = http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 0;
            $opts[CURLOPT_CUSTOMREQUEST] = 'PATCH';
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('��֧�ֵ�����ʽ��');
    }
  
    /* ��ʼ����ִ��curl���� */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data = json_decode(curl_exec($ch), true);
    $error = curl_error($ch);
    return $data;
}
?>
