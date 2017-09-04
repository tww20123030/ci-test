<?php
/**
 * ���ݲ�����
 */
class Request
{
    //���������ʽ
    private static $method_type = array('get', 'post', 'put', 'patch', 'delete');
    //��������
    private static $test_class = array(
        1 => array('name' => 'TOEFL', 'count' => 18),
        2 => array('name' => 'IELTS', 'count' => 20),
    );
    
    public static function getRequest()
    {
        //����ʽ
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        if (in_array($method, self::$method_type)) {
            //��������ʽ��Ӧ�ķ���
            $data_name = $method . 'Data';
            return self::$data_name($_REQUEST);
        }
        return false;
    }

    //GET ��ȡ��Ϣ
    private static function getData($request_data)
    {
        $class_id = (int)$request_data['class'];
        //GET /class/ID����ȡĳ��ָ�������Ϣ
        if ($class_id > 0) {
            return self::$test_class[$class_id];
        } else {//GET /class���г����а༶
            return self::$test_class;
        }
    }

    //POST /class���½�һ����
    private static function postData($request_data)
    {
        if (!empty($request_data['name'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            self::$test_class[] = $data;
            return self::$test_class;//���������ɵ���Դ����
        } else {
            return false;
        }
    }

    //PUT /class/ID������ĳ��ָ�������Ϣ��ȫ����Ϣ��
    private static function putData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        $data = array();
        if (!empty($request_data['name']) && isset($request_data['count'])) {
            $data['name'] = $request_data['name'];
            $data['count'] = (int)$request_data['count'];
            self::$test_class[$class_id] = $data;
            return self::$test_class;
        } else {
            return false;
        }
    }

    //PATCH /class/ID������ĳ��ָ�������Ϣ��������Ϣ��
    private static function patchData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        if (!empty($request_data['name'])) {
            self::$test_class[$class_id]['name'] = $request_data['name'];
        }
        if (isset($request_data['count'])) {
            self::$test_class[$class_id]['count'] = (int)$request_data['count'];
        }
        return self::$test_class;
    }

    //DELETE /class/ID��ɾ��ĳ����
    private static function deleteData($request_data)
    {
        $class_id = (int)$request_data['class'];
        if ($class_id == 0) {
            return false;
        }
        unset(self::$test_class[$class_id]);
        return self::$test_class;
    }
}
?>