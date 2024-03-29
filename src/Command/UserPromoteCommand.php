<?php

// src/Command/UserPromoteCommand.php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class UserPromoteCommand extends Command
{


    protected static $defaultName = 'app:user:promote';

    private $om;

    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Promote a user by adding him a new roles.')
            ->addArgument('email', InputArgument::REQUIRED, 'Email address of the user you want to promote.')
            ->addArgument('roles', InputArgument::REQUIRED, 'The roles you want to add to the user.')
        ;
    }

    /**
    * @ORM\Entity(repositoryClass=UserRepository::class)
    */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $roles = $input->getArgument('roles');

        $userRepository = $this->om->getRepository(User::class);
        $user = $userRepository->findOneByEmail;

        if ($user) {
            $user->addRoles($roles);
            $this->om->flush();

            $io->success('The roles has been successfully added to the user.');
        } else {
            $io->error('There is no user with that email address.');
        }

        return 0;
    }
}