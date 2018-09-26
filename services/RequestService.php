<?php

namespace app\services;

use yii\web\Request;

class RequestService
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RequestService constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $formName
     *
     * @return array
     */
    public function getFormBodyParams($formName)
    {
        return $this->request->bodyParams[$formName];
    }

    public function getRequest()
    {
        return $this->request;
    }
}
