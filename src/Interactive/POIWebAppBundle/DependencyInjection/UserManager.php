<?php

namespace Interactive\POIWebAppBundle\DependencyInjection;

use Interactive\POIWebAppBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager
{
    protected $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function getEncoder(User $user)
    {
        return $this->encoderFactory->getEncoder($user);
    }

    public function setUserEncodedPassword(User $user)
    {
       $plainPassword = $user->getPassword();
       $encoder = $this->getEncoder($user);
       $user->setPassword($encoder->encodePassword($plainPassword, $user->getSalt()));
    }
}