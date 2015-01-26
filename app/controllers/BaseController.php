<?php

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    const OK                    = 200;
    const BAD_REQUEST           = 400;
    const UNAUTHORIZED          = 401;
    const FORBIDDEN             = 403;
    const NOT_FOUND             = 404;
    const CONFLICT              = 409;
    const INTERNAL_SERVER_ERROR = 500;
    const CREATED               = 201;
    const ACCEPTED              = 202;
    const NO_CONTENT            = 204;
    const METHOD_NOT_ALLOW      = 405;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    protected function jsonResponse(array $data, $isError = 0)
    {
        if ($data) {
            $responseCode= self::OK;
        } else {
            $responseCode = self::NOT_FOUND;
        }

        if($isError) {
            $responseCode = $isError;
        }

        $result = array(
            'responseCode' => $responseCode,
            'total'        => count($data),
            'data'         => $data
        );

        return (new Response($result, self::OK))->header('Content-Type', 'application/json');
    }

    protected function pagerJsonResponse(array $data, $isError = 0)
    {
        if (isset($data['data']) && ($data['data'])) {
            $responseCode= self::OK;
        } else {
            $responseCode = self::NOT_FOUND;
            $data['data'] = array();
        }

        if($isError) {
            $responseCode = $isError;
        }

        if(empty($data['totalPage'])) {
            $data['totalPage'] = 0;
        }

        if(empty($data['totalItems'])) {
            $data['totalItems'] = 0;
        }

        if(empty($data['isFavorite'])) {
            $data['isFavorite'] = false;
        }

        $result = array(
            'responseCode' => $responseCode,
            'total'        => count($data['data']),
            'totalPage'    => $data['totalPage'],
            'totalItems'   => $data['totalItems'],
            'isFavorite'   => $data['isFavorite'],
            'data'         => $data['data']
        );

        return (new Response($result, self::OK))->header('Content-Type', 'application/json');
    }

    /**
     * Return api input and extra data
     * @param array $fields
     * @return array
     */
    public function getApiInput($fields = array())
    {
        return self::checkInput($fields);
    }

    static private function checkInput($fields = array()) {
        $errors = array();

        $result = array('isParam' => true, 'field' => $fields);
        if (isset($fields['INT']) || isset($fields['BIGINT'])) {
            $mergeField = array();
            if (isset($fields['INT'])){
                $fields['INT'] = isset($fields['INT']) ? $fields['INT'] : array();
                $mergeField = $fields['INT'];
            }

            if (isset($fields['BIGINT'])){
                $fields['BIGINT'] = isset($fields['BIGINT']) ? $fields['BIGINT'] : array();
                $mergeField = array_merge($mergeField, $fields['BIGINT']);
            }

            foreach($mergeField as $intKey => $intValue) {
                if (!ctype_digit(''.$intValue)) {
                    $errors['INT'][] = $intKey;

                    $result['isParam']    = false;
                    $result['error_code'] = self::BAD_REQUEST;
                    $result['errors']     = $errors;
                }
            }
        }

//        if (isset($fields['CHAR'])) {
//            foreach($fields['CHAR'] as $field) {
//                if (!isset($input[$field]) || !preg_match('/^[A-Za-z0-9,]{0,}$/' , $input[$field])) {
//                    unset($input[$field]);
//                    return '300093';
//                }
//
//                if (strlen($input[$field]) > 255) {
//                    $input[$field] = substr($input[$field], 0, 255);
//                }
//            }
//        }
//
//        if (isset($fields['VARCHAR'])) {
//            foreach($fields['VARCHAR'] as $field) {
//                if (!isset($input[$field]) || !preg_match('/^[A-Za-z0-9,]{0,}$/' , $input[$field])) {
//                    unset($input[$field]);
//                    return '300094';
//                }
//
//                if (strlen($input[$field]) > 65535) {
//                    $input[$field] = substr($input[$field], 0, 65535);
//                }
//            }
//        }
//
//        if (isset($fields['EXIST'])) {
//            foreach($fields['EXIST'] as $field) {
//                if (!isset($input[$field])) {
//                    return '300095';
//                }
//            }
//        }

        return $result;
    }
}
