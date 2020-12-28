<?php declare(strict_types=1);

namespace App\Form\Model;

use App\Document\User;
use Symfony\Component\Validator\Constraints as Assert;

class Registration
{
    /**
     * @Assert\Type(type="App\Document\User")
     */
    protected User $user;

    /**
     * @Assert\NotBlank
     * @Assert\IsTrue()
     */
    protected bool $termsAccepted;

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getTermsAccepted(): bool
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted(bool $termsAccepted): self
    {
        $this->termsAccepted = (bool) $termsAccepted;

        return $this;
    }
}