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
            if(count($responseData) == 0){
                $strErrorDesc = 'User Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            }
        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
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
            $userid = $this->getPathParam();
            //Check if Note exists
            $userModel = new UserModel();
            if($userModel->userExists($userid)){
                $userModel->deleteUser($this->getPathParam());
            } else{
                $strErrorDesc = 'User Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            }
            $userModel->deleteUser($this->getPathParam());
        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
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
        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('HTTP/1.1 201 OK')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
            );
        }
    }
}
