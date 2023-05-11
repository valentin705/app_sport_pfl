<?php

namespace App\Service;

use App\Entity\Seance;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\ORM\EntityManagerInterface;

class SlugGenerator
{
    private $slugify;
    private $entityManager;

    public function __construct(
        SlugifyInterface $slugify,
        EntityManagerInterface $entityManager)
    {
        $this->slugify = $slugify;
        $this->entityManager = $entityManager;
    }

    public function generateUniqueSlug(string $title): string
    {
        $slug = $this->slugify->slugify($title);

        // vérifie que le slug est unique en base de données
        $repository = $this->entityManager->getRepository(Seance::class);
        $i = 1;
        $originalSlug = $slug;
        while ($repository->findOneBy(['slug' => $slug])) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}