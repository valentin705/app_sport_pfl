<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Seance;
use App\Entity\Exercice;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Likes;
use App\Repository\CategoryRepository;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        ///////////////////////////// USERS /////////////////////////////
        $user = new User();
        $user->setEmail('valoo@hotmail.com');
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user->setRoles(['ROLE_USER']);
        $user->setUsername('Valoo');
        $user->setDescription('J\'aime le sport et je pratique le fitness depuis plusieurs années. Je suis ici pour partager mes séances et en découvrir de nouvelles !');
        $user->setSports('Natation, course à pied, vélo');
        $user->setPictureFile('valooUser.jpg');

        $user2 = new User();
        $user2->setEmail('zakkios@hotmail.com');
        $user2->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user2->setRoles(['ROLE_USER']);
        $user2->setUsername('Zakkios');
        $user2->setDescription('Jeune geek passionné de sport, je suis ici pour partager mes séances et en découvrir de nouvelles !');
        $user2->setSports('Musculation, boxe');
        $user2->setPictureFile('zakkiosUser.jpg');

        $user3 = new User();
        $user3->setEmail('julie@hotmail.com');
        $user3->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user3->setRoles(['ROLE_USER']);
        $user3->setUsername('Julie');
        $user3->setDescription('Je suis ici pour avoir des conseils et partager mes séances !');
        $user3->setSports('Musculation et la danse');
        $user3->setPictureFile('julieUser.jpg');

        $user4 = new User();
        $user4->setEmail('cassou@hotmail.com');
        $user4->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user4->setRoles(['ROLE_USER']);
        $user4->setUsername('Cassou');
        $user4->setDescription('Je pratique l\équitation et la course à pied. Je suis ici pour partager mes séances et en découvrir de nouvelles !');
        $user4->setSports('Equitation, course à pied');
        $user4->setPictureFile('cassouUser.jpg');

        $user5 = new User();
        $user5->setEmail('hakim@hotmail.com');
        $user5->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user5->setRoles(['ROLE_USER']);
        $user5->setUsername('Hakim');
        $user5->setDescription('Je suis un utilisateur de l\'application');
        $user5->setSports('Boxe');
        $user5->setPictureFile('hakimUser.gif');

        $user6 = new User();
        $user6->setEmail('lefooteux@hotmail.com');
        $user6->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user6->setRoles(['ROLE_USER']);
        $user6->setUsername('LeFooteux');
        $user6->setDescription('Je suis un utilisateur de l\'application');
        $user6->setSports('Football');
        $user6->setPictureFile('lefooteuxUser.jpg');

        $user7 = new User();
        $user7->setEmail('basketforever@hotmail.com');
        $user7->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user7->setRoles(['ROLE_USER']);
        $user7->setUsername('BasketForever');
        $user7->setDescription('Je suis un utilisateur de l\'application');
        $user7->setSports('Basketball, course à pied');
        $user7->setPictureFile('basketForeverUser.jpg');

        $user8 = new User();
        $user8->setEmail('sportifenherbe@hotmail.com');
        $user8->setPassword($this->userPasswordHasher->hashPassword($user, 'mdp705'));
        $user8->setRoles(['ROLE_USER']);
        $user8->setUsername('SportifEnHerbe');
        $user8->setDescription('Je suis un utilisateur de l\'application');
        $user8->setSports('Football, boxe');
        $user8->setPictureFile('sportifEnHerbeUser.jpg');

        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->persist($user5);
        $manager->persist($user6);
        $manager->persist($user7);
        $manager->persist($user8);

        /////////////////////////// SEANCE 1 ///////////////////////////
        $categoryCardio = new Category();
        $categoryCardio->setName('Cardio');
        $categoryRenforcementMusculaire = new Category();
        $categoryRenforcementMusculaire->setName('Renforcement musculaire');
        $categoryStretching = new Category();
        $categoryStretching->setName('Stretching');
        $categoryUpperBody = new Category();
        $categoryUpperBody->setName('Upper body');
        $categoryLowerBody = new Category();
        $categoryLowerBody->setName('Lower body');
        $categoryFullBody = new Category();
        $categoryFullBody->setName('Full body');

        $seance = new Seance();
        $seance->setUser($user);
        $seance->setName('Séance de musculation');
        $seance->setDescription('Séance de musculation pour les pectoraux');
        $seance->setPictureFile('seanceDeMusculation.jpeg');
        $seance->setCreateAt(new \DateTime('2021-06-01'));

        $categoryUpperBody->addSeance($seance);
        $seance->addCategory($categoryUpperBody);
        $categoryRenforcementMusculaire->addSeance($seance);
        $seance->addCategory($categoryRenforcementMusculaire);

        $exercice = new Exercice();
        $exercice->setName('Développé couché');
        $exercice->setDescription('Allongé sur un banc, les pieds au sol, les fesses et les épaules en contact avec le banc, les bras tendus à la verticale, les mains écartées de la largeur des épaules, descendre la barre jusqu’à ce qu’elle touche la poitrine, puis la remonter à la verticale.');
        $exercice->setPictureFile('dv.png');
        $exercice->setSerie(4);
        $exercice->setRepetition(10);
        $exercice->setRecuperation(90);
        $exercice->setSeance($seance);
        $seance->addExercice($exercice);
        $exercice1 = new Exercice();
        $exercice1->setName('Développé incliné');
        $exercice1->setDescription('Allongé sur un banc incliné à 45°, les pieds au sol, les fesses et les épaules en contact avec le banc, les bras tendus à la verticale, les mains écartées de la largeur des épaules, descendre la barre jusqu’à ce qu’elle touche la poitrine, puis la remonter à la verticale.');
        $exercice1->setPictureFile('ic.jpg');
        $exercice1->setSerie(4);
        $exercice1->setRepetition(10);
        $exercice1->setRecuperation(90);
        $exercice1->setSeance($seance);
        $seance->addExercice($exercice1);
        $exercice2 = new Exercice();
        $exercice2->setName('Dips');
        $exercice2->setDescription('Suspendu à une barre fixe, les bras tendus, les mains écartées de la largeur des épaules, descendre le corps jusqu’à ce que les bras soient fléchis à 90°, puis remonter à la position de départ.');
        $exercice2->setPictureFile('dips.png');
        $exercice2->setSerie(4);
        $exercice2->setRepetition(10);
        $exercice2->setRecuperation(90);
        $exercice2->setSeance($seance);
        $seance->addExercice($exercice2);

        $comment = new Comment();
        $comment->setUser($user2);
        $comment->setSeance($seance);
        $comment->setContenu('Super séance !');
        $comment->setCreatedAt(new \DateTime('2021-06-01, 10:00:00'));
        $comment1 = new Comment();
        $comment1->setUser($user3);
        $comment1->setSeance($seance);
        $comment1->setContenu('Très bonne séance !');
        $comment1->setCreatedAt(new \DateTime('2021-06-01, 11:56:00'));

        $manager->persist($seance);
        $manager->persist($categoryUpperBody);
        $manager->persist($categoryRenforcementMusculaire);
        $manager->persist($exercice);
        $manager->persist($exercice1);
        $manager->persist($exercice2);
        $manager->persist($comment);
        $manager->persist($comment1);

        /////////////////////////// SEANCE 2 ///////////////////////////

        $seance2 = new Seance();
        $seance2->setUser($user2);
        $seance2->setName('Séance de boxe');
        $seance2->setDescription('Séance de boxe pour les abdos');
        $seance2->setPictureFile('seanceDeBoxe.jpg');
        $seance2->setCreateAt(new \DateTime('2023-03-05'));

        $categoryCardio->addSeance($seance2);
        $seance2->addCategory($categoryCardio);
        $categoryRenforcementMusculaire->addSeance($seance2);
        $seance2->addCategory($categoryRenforcementMusculaire);

        $exercice3 = new Exercice();
        $exercice3->setName('Abdos Crunch');
        $exercice3->setDescription('Allongé sur le dos, les jambes fléchies, les mains derrière la tête, relever le buste jusqu’à ce que les omoplates se décollent du sol, puis redescendre à la position de départ.');
        $exercice3->setPictureFile('crunch.jpg');
        $exercice3->setSerie(3);
        $exercice3->setRepetition(15);
        $exercice3->setRecuperation(60);
        $exercice3->setSeance($seance2);
        $seance2->addExercice($exercice3);
        $exercice4 = new Exercice();
        $exercice4->setName('Gainage');
        $exercice4->setDescription('Allongé sur le ventre, les coudes au sol, les avant-bras à la verticale, les pieds au sol, les fesses et les épaules alignées, contracter les abdominaux et maintenir la position.');
        $exercice4->setPictureFile('gainage.jpg');
        $exercice4->setSerie(3);
        $exercice4->setTemps(30);
        $exercice4->setRecuperation(60);
        $exercice4->setSeance($seance2);
        $seance2->addExercice($exercice4);

        $comment2 = new Comment();
        $comment2->setUser($user3);
        $comment2->setSeance($seance2);
        $comment2->setContenu('Ca pique !');
        $comment2->setCreatedAt(new \DateTime('2023-03-08, 08:25:32'));
        $comment3 = new Comment();
        $comment3->setUser($user2);
        $comment3->setSeance($seance2);
        $comment3->setContenu('Hey merci ;)');
        $comment3->setCreatedAt(new \DateTime('2023-03-08, 08:30:00'));
        $comment4 = new Comment();
        $comment4->setUser($user3);
        $comment4->setSeance($seance2);
        $comment4->setContenu('Peux tu partager d\'autres séances comme ca xD');
        $comment4->setCreatedAt(new \DateTime('2023-03-08, 08:35:00'));

        $manager->persist($seance2);
        $manager->persist($categoryCardio);
        $manager->persist($categoryRenforcementMusculaire);
        $manager->persist($exercice3);
        $manager->persist($exercice4);
        $manager->persist($comment2);
        $manager->persist($comment3);
        $manager->persist($comment4);

        /////////////////////////// SEANCE 3 ///////////////////////////

        $seance3 = new Seance();
        $seance3->setUser($user3);
        $seance3->setName('Seance fessiers');
        $seance3->setDescription('Séance fessiers');
        $seance3->setPictureFile('seanceFessiers.jpg');
        $seance3->setCreateAt(new \DateTime('2023-02-08'));
        $like3 = new Likes();
        $like3->setUser($user2);
        $like3->setSeance($seance3);
        $like4 = new Likes();
        $like4->setUser($user3);
        $like4->setSeance($seance3);
        $like5 = new Likes();
        $like5->setUser($user);
        $like5->setSeance($seance3);

        $categoryRenforcementMusculaire->addSeance($seance3);
        $seance3->addCategory($categoryRenforcementMusculaire);
        $categoryLowerBody->addSeance($seance3);
        $seance3->addCategory($categoryLowerBody);

        $exercice5 = new Exercice();
        $exercice5->setName('Squat');
        $exercice5->setDescription('Debout, les pieds écartés de la largeur du bassin, les bras tendus devant soi, fléchir les jambes jusqu’à ce que les cuisses soient parallèles au sol, puis se redresser.');
        $exercice5->setPictureFile('squat.png');
        $exercice5->setSerie(3);
        $exercice5->setRepetition(15);
        $exercice5->setRecuperation(60);
        $exercice5->setSeance($seance3);
        $seance3->addExercice($exercice5);
        $exercice6 = new Exercice();
        $exercice6->setName('Fentes');
        $exercice6->setDescription('Debout, les pieds écartés de la largeur du bassin, les mains sur les hanches, faire un grand pas en avant avec le pied droit, fléchir les jambes jusqu’à ce que la cuisse droite soit parallèle au sol, puis se redresser et revenir à la position de départ.');
        $exercice6->setPictureFile('fente.jpeg');
        $exercice6->setSerie(3);
        $exercice6->setRepetition(15);
        $exercice6->setRecuperation(60);
        $exercice6->setSeance($seance3);
        $seance3->addExercice($exercice6);

        $comment5 = new Comment();
        $comment5->setUser($user);
        $comment5->setSeance($seance3);
        $comment5->setContenu('Merci pour cette séance !');
        $comment5->setCreatedAt(new \DateTime('2023-03-08, 08:25:32'));
        $comment6 = new Comment();
        $comment6->setUser($user3);
        $comment6->setSeance($seance3);
        $comment6->setContenu('Avec plaisir !');
        $comment6->setCreatedAt(new \DateTime('2023-03-08, 08:30:00'));
        $comment7 = new Comment();
        $comment7->setUser($user5);
        $comment7->setSeance($seance3);
        $comment7->setContenu('Je pense la mettre dans ma routine');
        $comment7->setCreatedAt(new \DateTime('2023-03-08, 08:35:00'));

        $manager->persist($seance3);
        $manager->persist($categoryRenforcementMusculaire);
        $manager->persist($categoryLowerBody);
        $manager->persist($exercice5);
        $manager->persist($exercice6);
        $manager->persist($comment5);
        $manager->persist($comment6);
        $manager->persist($comment7);
        $manager->persist($like3);
        $manager->persist($like4);
        $manager->persist($like5);

        /////////////////////////// SEANCE 4 ///////////////////////////
        $seance4 = new Seance();
        $seance4->setUser($user4);
        $seance4->setName('Running fractionné');
        $seance4->setDescription('La séance de fractionné running est un entraînement intense qui alterne des périodes de sprint à une allure maximale avec des périodes de récupération active à une allure lente. Cette méthode permet d\'améliorer la vitesse, l\'endurance et la résistance du coureur.
        Pour réaliser cette séance, commencez par un échauffement de 10 minutes à une allure modérée. Ensuite, enchaînez avec des sprints de 30 secondes à une allure maximale, suivis de 30 secondes de récupération active à une allure lente. Répétez ce cycle de sprint et récupération 10 fois, pour un total de 20 minutes d\'entraînement.
        Cette séance est particulièrement exigeante, car elle vous pousse à donner le maximum de vos capacités à chaque sprint. Il est important de bien vous hydrater et de vous étirer après la séance pour éviter les blessures.');
        $seance4->setPictureFile('running.jpg');
        $seance4->setCreateAt(new \DateTime('2023-02-08'));
        $like6 = new Likes();
        $like6->setUser($user2);
        $like6->setSeance($seance4);
        $like7 = new Likes();
        $like7->setUser($user3);
        $like7->setSeance($seance4);



        $manager->persist($seance4);
        $manager->persist($like6);
        $manager->persist($like7);

        /////////////////////////// SEANCE 5 ///////////////////////////
        $seance5 = new Seance();
        $seance5->setUser($user5);
        $seance5->setName('Circuit training');
        $seance5->setDescription('Le circle training est un entraînement complet qui combine des exercices de cardio et de renforcement musculaire. Il permet de brûler des calories, de tonifier les muscles et d\'améliorer la condition physique générale.
        Le but sera de faire le plus de tours possible en 20 minutes. Pour cela, enchaînez les exercices suivants, sans temps de repos entre chaque exercice :');
        $seance5->setPictureFile('circuit.jpg');
        $seance5->setCreateAt(new \DateTime('2023-01-10'));

        $exercice7 = new Exercice();
        $exercice7->setName('Jumping jack');
        $exercice7->setDescription('Debout, les pieds joints, les bras le long du corps, sauter en écartant les jambes et en levant les bras au-dessus de la tête, puis sauter à nouveau en ramenant les bras le long du corps et les jambes jointes.');
        $exercice7->setPictureFile('jumping.png');
        $exercice7->setSerie(1);
        $exercice7->setRepetition(15);
        $exercice7->setSeance($seance5);
        $seance5->addExercice($exercice7);
        $exercice8 = new Exercice();
        $exercice8->setName('Pompes');
        $exercice8->setDescription('Allongé sur le ventre, les mains à plat au sol, les bras tendus, les jambes tendues et les pieds joints, soulever le corps en appui sur les mains et les pieds, puis redescendre en fléchissant les bras.');
        $exercice8->setPictureFile('pompe.png');
        $exercice8->setSerie(1);
        $exercice8->setRepetition(15);
        $exercice8->setSeance($seance5);
        $seance5->addExercice($exercice8);
        $exercice9 = new Exercice();
        $exercice9->setName('Mountain climber');
        $exercice9->setDescription('En position de planche, les mains à plat au sol, les bras tendus, les jambes tendues et les pieds joints, ramener un genou vers la poitrine, puis le ramener en arrière et répéter le mouvement avec l\'autre jambe.');
        $exercice9->setPictureFile('climber.jpg');
        $exercice9->setSerie(1);
        $exercice9->setRepetition(15);
        $exercice9->setSeance($seance5);
        $seance5->addExercice($exercice9);

        $categoryCardio->addSeance($seance5);
        $seance5->addCategory($categoryCardio);
        $categoryFullBody->addSeance($seance5);
        $seance5->addCategory($categoryFullBody);

        $comment5 = new Comment();
        $comment5->setUser($user);
        $comment5->setSeance($seance5);
        $comment5->setContenu('Super fatiguant la séance mais j\'ai adoré !');
        $comment5->setCreatedAt(new \DateTime('2023-01-10 10:00:00'));
        $comment6 = new Comment();
        $comment6->setUser($user5);
        $comment6->setSeance($seance5);
        $comment6->setContenu('Merci, quand tu veux on l\a fait ensemble !');
        $comment6->setCreatedAt(new \DateTime('2023-01-10 10:30:00'));

        $like8 = new Likes();
        $like8->setUser($user2);
        $like8->setSeance($seance5);
        $like9 = new Likes();
        $like9->setUser($user3);
        $like9->setSeance($seance5);
        $like10 = new Likes();
        $like10->setUser($user);
        $like10->setSeance($seance5);


        $manager->persist($seance5);
        $manager->persist($exercice7);
        $manager->persist($exercice8);
        $manager->persist($exercice9);
        $manager->persist($categoryCardio);
        $manager->persist($categoryFullBody);
        $manager->persist($comment5);
        $manager->persist($comment6);
        $manager->persist($like8);
        $manager->persist($like9);
        $manager->persist($like10);

        /////////////////////////// SEANCE 6 ///////////////////////////
        $seance6 = new Seance();
        $seance6->setUser($user);
        $seance6->setName('Seance dos');
        $seance6->setDescription('Le dos est une partie du corps qui est souvent négligée. Pourtant, il est important de le travailler pour éviter les douleurs dorsales et les problèmes de posture. Voici une séance de musculation pour le dos qui vous permettra de le renforcer et de le tonifier.');
        $seance6->setPictureFile('dos.jpg');
        $seance6->setCreateAt(new \DateTime('2023-04-07'));

        $categoryUpperBody->addSeance($seance6);
        $seance6->addCategory($categoryUpperBody);
        $categoryRenforcementMusculaire->addSeance($seance6);
        $seance6->addCategory($categoryRenforcementMusculaire);

        $exercice10 = new Exercice();
        $exercice10->setName('Traction');
        $exercice10->setDescription('Suspendu à une barre fixe, les bras tendus, les mains écartées de la largeur des épaules, les paumes vers l\'avant, soulever le corps en fléchissant les bras, puis redescendre en tendant les bras.');
        $exercice10->setPictureFile('traction.png');
        $exercice10->setSerie(3);
        $exercice10->setRepetition(10);
        $exercice10->setRecuperation(60);
        $exercice10->setSeance($seance6);
        $seance6->addExercice($exercice10);

        $manager->persist($seance6);
        $manager->persist($exercice10);
        $manager->persist($categoryUpperBody);
        $manager->persist($categoryRenforcementMusculaire);

        /////////////////////////// SEANCE 7 ///////////////////////////
        $seance7 = new Seance();
        $seance7->setUser($user4);
        $seance7->setName('Seance relaxation / étirement');
        $seance7->setDescription('Le stretching est une pratique qui consiste à étirer les muscles pour les assouplir. Il permet de se détendre et de se relaxer. Voici une séance de stretching pour vous aider à vous relaxer et à vous détendre.');
        $seance7->setPictureFile('stretchSeance.jpg');
        $seance7->setCreateAt(new \DateTime('2023-02-08'));

        $categoryStretching->addSeance($seance7);
        $seance7->addCategory($categoryStretching);

        $exercice11 = new Exercice();
        $exercice11->setName('Étirement des ischio-jambiers');
        $exercice11->setDescription('Allongé sur le dos, les jambes tendues, les bras le long du corps, ramener une jambe vers la poitrine, en la tenant avec les mains, puis ramener la jambe en arrière et répéter le mouvement avec l\'autre jambe.');
        $exercice11->setPictureFile('et.jpg');
        $exercice11->setSerie(3);
        $exercice11->setTemps(45);
        $exercice11->setSeance($seance7);
        $seance7->addExercice($exercice11);


        $manager->persist($seance7);
        $manager->persist($exercice11);
        $manager->persist($categoryStretching);


        $manager->flush();
    }
}
