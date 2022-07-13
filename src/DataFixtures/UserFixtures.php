<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Film;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        $number = 1;
        for($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setPassword($this->passwordEncoder->hashPassword(
                $user,
                'password'
            ));
            for($j = 0; $j < 3; $j++) {
                $film = new Film();
                $film->setTitle('Avengers ' . $number);
                $film->setYear($faker->year());
                $film->setGender('action');
                $user->addFilm($film);

                $number++;
            }
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
