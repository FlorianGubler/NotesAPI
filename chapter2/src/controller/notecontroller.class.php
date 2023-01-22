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
            $noteModel = new NoteModel();
            $responseData = $noteModel->getNote($this->getPathParam());
            if(count($responseData) == 0){
                $strErrorDesc = 'Note Not Found';
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
     * DELETE "/user/note/{noteid}" Endpoint - Delete specific user note
     */
    public function DELETE()
    {
        $strErrorDesc = '';

        try {
            $noteid = $this->getPathParam();
            //Check if Note exists
            $noteModel = new NoteModel();
            if($noteModel->noteExists($noteid)){
                $noteModel->deleteNote($noteid);
            } else{
                $strErrorDesc = 'Note Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            }
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
     * POST "/user/note" Endpoint - Create new User Note
     */
    public function POST()
    {
        $strErrorDesc = '';

        try {
            $noteModel = new NoteModel();
            $noteModel->createNote($this->getBody());
        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                "",
                array('HTTP/1.1 201 CREATED')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
            );
        }
    }
}
