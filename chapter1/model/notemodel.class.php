<?php
require_once PROJECT_ROOT_PATH . "/model/database.class.php";

class NoteModel extends Database
{
    public function getNote($noteid)
    {
        return $this->select("SELECT * FROM note WHERE note_id = ?", "i", [$noteid]);
    }

    public function deleteNote($noteid)
    {
        return $this->modify("DELETE FROM note WHERE note_id = ?", "i", [$noteid]);
    }

    public function createNote($note)
    {
        return $this->modify("INSERT INTO note (note_title, note_content, note_user) VALUES (?, ?, ?)", "ssi", [$note->note_title, $note->note_content, $note->note_user]);
    }

    public function noteExists($userid){
        return count($this->getNote($userid)) > 0;
    }
}
