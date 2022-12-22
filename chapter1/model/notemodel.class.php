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
        return $this->select("DELETE FROM note WHERE note_id = ?", "i", [$noteid]);
    }

    public function createNote($note)
    {
        return $this->modify("INSERT INTO note (note_title, note_content, note_user) VALUES (?, ?, ?)", "ssi", [$note->title, $note->content, $note->user]);
    }
}
