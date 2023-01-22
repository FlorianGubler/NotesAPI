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
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $title;
    #[ORM\Column(type: 'string')]
    private string $content;
    #[ORM\Column(type: 'integer')]
    #[ORM\ManyToOne(targetEntity: UserModel::class, inversedBy: 'notes')]
    private UserModel|null $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getUser(): UserModel
    {
        return $this->user;
    }

    public function setUser(UserModel $user): void
    {
        $this->user = $user;
    }
}
