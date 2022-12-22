<?php
class UserController extends BaseController
{
    /**
     * GET "/user" Endpoint - Get specific users
     */
    public function GET()
    {
        $strErrorDesc = '';

        try {
            $userModel = new UserModel();
            $responseData = $userModel->getUser($this->getPathParam());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * DELETE "/user" Endpoint - Delete a User
     */
    public function DELETE()
    {
        $strErrorDesc = '';

        try {
            $userModel = new UserModel();
            $userModel->deleteUser($this->getPathParam());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    /**
     * POST "/user" Endpoint - Create new User
     */
    public function POST()
    {
        $strErrorDesc = '';

        try {
            $userModel = new UserModel();
            $userModel->createUser($this->getBody());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('Content-Type: application/json', 'HTTP/1.1 201 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
