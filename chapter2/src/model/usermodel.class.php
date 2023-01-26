<?php
require_once PROJECT_ROOT_PATH . "/model/notemodel.class.php";
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class UserModel
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $user_id = null;
    #[ORM\Column(type: 'string')]
    private string $user_name;
    #[ORM\Column(type: 'string')]
    private string $user_email;

    private array $notes;

    public function __construct($obj){
        $this->user_name = $obj->user_name;
        $this->user_email = $obj->user_email;
    }

    public function getId(): int
    {
        return $this->user_id;
    }

    public function setId(int $id): void
    {
        $this->user_id = $id;
    }

    public function getName(): string
    {
        return $this->user_name;
    }

    public function setName(string $name): void
    {
        $this->user_name = $name;
    }

    public function getEmail(): string
    {
        return $this->user_email;
    }

    public function setEmail(string $content): void
    {
        $this->user_email = $email;
    }

    public function getNotes(): array
    {
        return $this->notes;
    }

    public function setNotes(array $elements): void
    {
        $this->notes = $elements;
    }
}
