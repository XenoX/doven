<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserAddCommand
 * @package UserBundle\Command
 */
class UserAddCommand extends Command
{
    const MAX_ATTEMPTS = 5;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('user:add')
            ->setDescription('Create user and store in the database')
            ->setHelp($this->getCommandHelp())
            ->addArgument('username', InputArgument::OPTIONAL, 'The username of the new user')
            ->addArgument('password', InputArgument::OPTIONAL, 'The plain password of the new user')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email of the new user')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'If set, the user is created as an administrator')
            ->addOption('kaio', null, InputOption::VALUE_NONE, 'If set, the user is created as an super-administrator')
        ;
    }

    /**
     * UserAddCommand constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $encoder)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;

        parent::__construct();
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (null !== $input->getArgument('username') &&
            null !== $input->getArgument('password') &&
            null !== $input->getArgument('email')
        ) {
            return;
        }

        $output->writeln('');
        $output->writeln('Add User Command Interactive Wizard');
        $output->writeln('-----------------------------------');
        $output->writeln([
            '',
            'If you prefer to not use this interactive wizard, provide the',
            'arguments required by this command as follows:',
            '',
            ' $ php bin/console user:add username password email@example.com',
            '',
        ]);
        $output->writeln([
            '',
            'Now we\'ll ask you for the value of all the missing command arguments.',
            '',
        ]);

        $console = $this->getHelper('question');
        $username = $input->getArgument('username');
        if (null === $username) {
            $question = new Question(' > <info>Username</info>: ');
            $question->setValidator(function ($answer) {
                if (empty($answer)) {
                    throw new \RuntimeException('The username cannot be empty');
                }

                return $answer;
            });
            $question->setMaxAttempts(self::MAX_ATTEMPTS);
            $username = $console->ask($input, $output, $question);
            $input->setArgument('username', $username);
        } else {
            $output->writeln(' > <info>Username</info>: '.$username);
        }

        $password = $input->getArgument('password');
        if (null === $password) {
            $question = new Question(' > <info>Password</info> (your type will be hidden): ');
            $question->setValidator([$this, 'passwordValidator']);
            $question->setHidden(true);
            $question->setMaxAttempts(self::MAX_ATTEMPTS);
            $password = $console->ask($input, $output, $question);
            $input->setArgument('password', $password);
        } else {
            $output->writeln(' > <info>Password</info>: '.str_repeat('*', strlen($password)));
        }

        $email = $input->getArgument('email');
        if (null === $email) {
            $question = new Question(' > <info>Email</info>: ');
            $question->setValidator([$this, 'emailValidator']);
            $question->setMaxAttempts(self::MAX_ATTEMPTS);
            $email = $console->ask($input, $output, $question);
            $input->setArgument('email', $email);
        } else {
            $output->writeln(' > <info>Email</info>: '.$email);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startTime = microtime(true);
        $username = $input->getArgument('username');
        $plainPassword = $input->getArgument('password');
        $email = $input->getArgument('email');
        $isAdmin = $input->getOption('admin');
        $isSuperAdmin = $input->getOption('kaio');

        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(
            ['username' => $username]
        );
        if (null !== $existingUser) {
            throw new \RuntimeException(sprintf(
                'There is already a user registered with the "%s" username.', $username
            ));
        }

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        if ($isAdmin) {
            $user->setRoles(['ROLE_ADMIN']);
        } elseif ($isSuperAdmin) {
            $user->setRoles(['ROLE_KAIO']);
        } else {
            $user->setRoles(['ROLE_USER']);
        }

        $encodedPassword = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encodedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        $output->writeln('');
        $output->writeln(sprintf(
            '[OK] User was successfully created: %s (%s)', $user->getUsername(), $user->getEmail()
        ));

        if ($output->isVerbose()) {
            $finishTime = microtime(true);
            $elapsedTime = $finishTime - $startTime;
            $output->writeln(sprintf(
                '[INFO] New user database id: %d / Elapsed time: %.2f ms', $user->getId(), $elapsedTime * 1000
            ));
        }
    }

    /**
     * @param $plainPassword
     * @return mixed
     * @throws \Exception
     */
    private function passwordValidator($plainPassword)
    {
        if (empty($plainPassword)) {
            throw new \Exception('The password can not be empty');
        }
        if (strlen(trim($plainPassword)) < 4) {
            throw new \Exception('The password must be at least 4 characters long');
        }

        return $plainPassword;
    }

    /**
     * @param $email
     * @return mixed
     * @throws \Exception
     */
    private function emailValidator($email)
    {
        if (empty($email)) {
            throw new \Exception('The email can not be empty');
        }
        if (false === strpos($email, '@')) {
            throw new \Exception('The email should look like a real email');
        }

        return $email;
    }

    /**
     * @return string
     */
    private function getCommandHelp()
    {
        return <<<HELP
The <info>%command.name%</info> command creates new users and saves them in the database:
  <info>php %command.full_name%</info> <comment>username password email</comment>
By default the command creates regular users.
To create administrator users, add the <comment>--admin</comment> option:
  <info>php %command.full_name%</info> username password email <comment>--admin</comment>
To create super-administrator users, add the <comment>--kaio</comment> option:
  <info>php %command.full_name%</info> username password email <comment>--kaio</comment>
HELP;
    }
}