<?php
class UserController extends BaseController
{
    private $entityManager;

    public function __construct($em){
        $this->entityManager = $em;
    }

    /**
     * GET "/user" Endpoint - Get specific users
     */
    public function GET()
    {
        $strErrorDesc = '';

        try {
            $userid = $this->getPathParam();

            $user = $this->entityManager->find('UserModel', $userid);

            //Find Notes
            $query = $this->entityManager->createQuery('SELECT notes.note_id, notes.note_title, notes.note_content FROM NoteModel notes WHERE notes.note_user = ' . $userid);
            $user->setNotes($query->getResult());

            if($user == null){
                $strErrorDesc = 'User Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
            } else{
                $responseData = $this->userToStd($user);
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

            $this->entityManager->getConnection()->beginTransaction();

            $user = $this->entityManager->find('UserModel', array('user_id' => $userid));

            $query = $this->entityManager->createQuery('DELETE FROM NoteModel notes WHERE notes.note_user = ' . $userid);
            $query->execute();

            if($user == null){
                $strErrorDesc = 'User Not Found';
                $strErrorHeader = 'HTTP/1.1 404 Not Found';
                $this->entityManager->getConnection()->rollback();
            } else{
                $this->entityManager->remove($user);
                $this->entityManager->flush();
            }
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (Exception $e) {
            $this->entityManager->getConnection()->rollback();
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
            $user = new UserModel($this->getBody());

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $responseData = $this->userToStd($user);
        } catch (Exception $e) {
            $strErrorDesc = 'Something went wrong! Please contact support: ' . $e->getMessage();
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('HTTP/1.1 201 OK')
            );
        } else {
            $this->sendOutput(
                array('error' => $strErrorDesc),
                array($strErrorHeader)
            );
        }
    }

    private function userToStd(UserModel $user){
        return (object) [
            'user_id' => $user->getId(),
            'user_email' => $user->getEmail(),
            'user_name' => $user->getName(),
            "notes" => []
        ];
    }
}
