<?php

namespace Interactive\POIWebAppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Interactive\POIWebAppBundle\Entity\User;

class POIUsersCommand extends ContainerAwareCommand{
    protected function configure()
    {
        $this
            ->setName('interactive:poiwebapp:users')
            ->setDescription('Add Jobeet users')
            ->addArgument('username', InputArgument::REQUIRED, 'The username')
            ->addArgument('password', InputArgument::REQUIRED, 'The password')
            ->addArgument('email', InputArgument::REQUIRED, 'The email') 
            ->addArgument('firstName', InputArgument::REQUIRED, 'The firstName')
            ->addArgument('lastName', InputArgument::REQUIRED, 'The lastName')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $email = $input->getArgument('email');
        $firstName = $input->getArgument('firstName');
        $lastName = $input->getArgument('lastName');

        $em = $this->getContainer()->get('doctrine')->getManager();

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setLastName($lastName);
        $user->setFirstName($firstName);
        // encode the password
        $factory = $this->getContainer()->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $encodedPassword = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encodedPassword);
        $em->persist($user);
        $em->flush();

        $output->writeln(sprintf('Added %s user with password %s', $username, $password));
    }
}
