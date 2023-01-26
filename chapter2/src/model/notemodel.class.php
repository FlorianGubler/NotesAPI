<?php
require_once PROJECT_ROOT_PATH . "/model/usermodel.class.php";

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'note')]
class NoteModel
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $note_id = null;
    #[ORM\Column(type: 'string')]
    private string $note_title;
    #[ORM\Column(type: 'string')]
    private string $note_content;
    #[ORM\Column(type: 'integer')]
    #[ORM\ManyToOne(targetEntity: UserModel::class, inversedBy: 'notes')]
    #[JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    public UserModel $note_user;

    public function __construct($obj){
        $this->note_title = $obj->note_title;
        $this->note_content = $obj->note_content;
        $this->note_user = $obj->note_user;
    }

    public function getId(): int
    {
        return $this->note_id;
    }

    public function setId(int $id): void
    {
        $this->note_id = $id;
    }

    public function getTitle(): string
    {
        return $this->note_title;
    }

    public function setTitle(string $title): void
    {
        $this->note_title = $title;
    }

    public function getContent(): string
    {
        return $this->note_content;
    }

    public function setContent(string $content): void
    {
        $this->note_content = $content;
    }

    public function getUser(): UserModel|int
    {
        return $this->note_user;
    }

    public function setUser(UserModel $user): void
    {
        $this->note_user = $user;
    }
}
