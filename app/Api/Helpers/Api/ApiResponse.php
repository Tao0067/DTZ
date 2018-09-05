<?php
/**
 * Created by PhpStorm.
 * User: cc
 * Date: 2018/9/3
 * Time: 11:29
 */
namespace App\Api\Helpers\Api;

use Response;
use Symfony\Component\HttpFoundation\Response as FoundationResponse;

trait ApiResponse
{
    protected $statusCode = FoundationResponse::HTTP_OK;


    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respond($data, $header = [])
    {
        return Response::json($data,$this->statusCode,$header);
    }

    public function status($status,array $data,$code = null)
    {
        if ($code) {
            $this->statusCode = $code;
        }

        $status = [
            'status' => $status,
            'code'   => $this->statusCode,
        ];

        $data = array_merge($status,$data);
        return $this->respond($data);
        
    }

    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->status($status,[
            'message' => $message
        ],$code);
    }

    public function message($message,$status = "success")
    {
        return $this->status($status,['message' => $message]);
    }

    /**
     * 500
     * @param string $message
     * @return mixed
     */
    public function internalError($message = 'Internal Error')
    {
         return $this->failed($message,FoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * 201
     * @param string $message
     * @return mixed
     */
    public function created($message = "created")
    {
        return $this->failed($message,FoundationResponse::HTTP_CREATED);
    }

    public function success($data,$status = 'success')
    {
        return $this->status($status,compact('data'));
    }

    /**
     * 404
     * @param string $message
     * @return mixed
     */
    public function notFond($message = 'Not Fond!')
    {
        return $this->failed($message,Foundationresponse::HTTP_NOT_FOUND);
    }

    /**
     * 401
     * @param string $message
     * @return mixed
     */
    public function unauthorised($message = 'unauthorised')
    {
        return $this->failed($message,FoundationResponse::HTTP_UNAUTHORIZED);

    }

    public function error($message = 'Bad Request')
    {
        return $this->failed($message);
    }
}