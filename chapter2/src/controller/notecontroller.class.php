<?php
class NoteController extends BaseController
{
    private $entityManager;

    public function __construct($em){
        $this->entityManager = $em;
    }
    /**
     * GET "/user/note/{noteid}" Endpoint - Get specific user note
     */
    public function GET()
    {
        $strErrorDesc = '';

        try {
            $noteid = $this->getPathParam();

            $note = $this->entityManager->find('NoteModel', $noteid);

            if($note == null){
                $strErrorDesc = 'Note Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            } else{
                $responseData = $this->noteToStd($note);
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

            $note = $this->entityManager->find('NoteModel', array('note_id' => $noteid));

            if($note == null){
                $strErrorDesc = 'Note Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            } else{
                $this->entityManager->remove($note);
                $this->entityManager->flush();
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
            $note = new NoteModel($this->getBody());

            $this->entityManager->persist($note);
            $this->entityManager->flush();

            $responseData = $this->noteToStd($note);

        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('HTTP/1.1 201 CREATED')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
            );
        }
    }

    private function noteToStd(NoteModel $note){
        return (object) [
            'note_id' => $note->getId(),
            'note_title' => $note->getTitle(),
            'note_content' => $note->getContent(),
            'note_user' => $note->getUser()
        ];
    }
}
