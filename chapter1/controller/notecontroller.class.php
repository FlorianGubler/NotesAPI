<?php
class NoteController extends BaseController
{
    /**
     * GET "/user/note/{noteid}" Endpoint - Get specific user note
     */
    public function GET()
    {
        $strErrorDesc = '';

        try {
            $userModel = new NoteModel();
            $responseData = $userModel->getNote($this->getPathParam());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please try again later';
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
     * DELETE "/user/note/{noteid}" Endpoint - Delete specific user note
     */
    public function DELETE()
    {
        $strErrorDesc = '';

        try {
            $userModel = new NoteModel();
            $userModel->deleteNote($this->getPathParam());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please try again later';
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
     * POST "/user/note" Endpoint - Create new User Note
     */
    public function POST()
    {
        $strErrorDesc = '';

        try {
            $userModel = new NoteModel();
            $userModel->createNote($this->getBody());
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . 'Something went wrong! Please try again later';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('Content-Type: application/json', 'HTTP/1.1 201 CREATED')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}
