<?php
namespace common\extend\exception;


use yii\base\UserException;

class MyHttpException extends UserException
{
    /**
     * @var int HTTP status code, such as 403, 404, 500, etc.
     */
    public int $statusCode;


    /**
     * Constructor.
     * @param int $status HTTP status code, such as 404, 500, etc.
     * @param string|null $message error message
     * @param int $code error code
     * @param \Throwable|null $previous The previous exception used for the exception chaining.
     */
    public function __construct(int $status, $message = null, $code = 0, $previous = null)
    {
        $this->statusCode = $status;
        parent::__construct((string)$message, $code, $previous);
    }
}