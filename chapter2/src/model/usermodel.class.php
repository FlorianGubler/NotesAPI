<?php
require_once PROJECT_ROOT_PATH . "/model/notemodel.class.php";

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class UserModel
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;
    #[ORM\Column(type: 'string')]
    private string $user_name;
    #[ORM\Column(type: 'string')]
    private string $user_email;
    #[ORM\OneToMany(targetEntity: NoteModel::class, mappedBy: 'user')]
    private Collection $notes;

    public function __construct(){
        $this->notes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUser_name(): string
    {
        return $this->title;
    }

    public function setUser_name(string $title): void
    {
        $this->title = $title;
    }

    public function getUser_email(): string
    {
        return $this->content;
    }

    public function setUser_email(string $content): void
    {
        $this->content = $content;
    }
}
