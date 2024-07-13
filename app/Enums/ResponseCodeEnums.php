<?php
namespace App\Enums;

enum ResponseCodeEnums: int
{

    /*
    |--------------------------------------------------------------------------
    | Employee
    |--------------------------------------------------------------------------
    */
    case EMPLOYEE_NOT_FOUND = 1000;
    case EMPLOYEE_QUERY_ERROR = 1001;

    /*
    |--------------------------------------------------------------------------
    | User Response
    |--------------------------------------------------------------------------
    */
    case USER_REQUEST_ERROR = 2001;
    case USER_REQUEST_SUCCESSFUL = 2002;

    /*
    |--------------------------------------------------------------------------
    | Auth Response
    |--------------------------------------------------------------------------
    */
    case AUTH_REQUEST_ERROR = 3001;
    case AUTH_REQUEST_SUCCESSFUL = 3002;
    case AUTH_REQUEST_VALIDATION_ERROR = 3003;



    public function getCode()
    {
        return $this;
    }

    public function toString()
    {
        return match ($this) {
            /*
            |--------------------------------------------------------------------------
            | Employee Response
            |--------------------------------------------------------------------------
            */
            self::EMPLOYEE_NOT_FOUND => [
                'status' => 400,
                'response_code' => $this,
                'message' => $this->name
            ],
            self::EMPLOYEE_QUERY_ERROR => [
                'status' => 400,
                'response_code' => $this,
                'message' => $this->name
            ],

            /*
            |--------------------------------------------------------------------------
            | User Response
            |--------------------------------------------------------------------------
            */
            self::USER_REQUEST_ERROR => [
                'status' => 400,
                'response_code' => $this,
                'message' => $this->name
            ],
            self::USER_REQUEST_SUCCESSFUL => [
                'status' => 200,
                'response_code' => $this,
                'message' => $this->name
            ],
            /*
            |--------------------------------------------------------------------------
            | Auth Response
            |--------------------------------------------------------------------------
            */
            self::AUTH_REQUEST_ERROR => [
                'status' => 400,
                'response_code' => $this,
                'message' => $this->name
            ],
            self::AUTH_REQUEST_VALIDATION_ERROR => [
                'status' => 400,
                'response_code' => $this,
                'message' => $this->name
            ],
            self::AUTH_REQUEST_SUCCESSFUL => [
                'status' => 200,
                'response_code' => $this,
                'message' => $this->name
            ],
        };
    }
}
