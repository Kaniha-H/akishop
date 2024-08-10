<?php 

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminService 
{
    public function __construct
    ( 
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    public function create(string $fullname, string $email, $password): void
    {
        $user = $this->userRepository->findOneBy(['email' => $email]);

        if(!$user) {
            $user = new User();
            $user
                ->setFullname($fullname)
                ->setEmail($email);
    
            $password = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($password);
        }
      
        $user->setRoles(['ROLE_ADMIN']);

        $this->userRepository->save($user, true);
    }
}