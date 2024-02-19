<?php

namespace App\Service;

use App\Repository\SeanceRepository;

class SeanceService
{
    private SeanceRepository $seanceRepository;

    public function __construct(SeanceRepository $seanceRepository)
    {
        $this->seanceRepository = $seanceRepository;
    }

    public function getSeanceDataForApi(string $baseUrl): array
    {
        $seances = $this->seanceRepository->findSeancesOrderedByDesc();
        return array_map(function ($seance) use ($baseUrl) {
            $imageUrl = $baseUrl . '/uploads/picturesSeances/' . $seance->getPictureFile();
            return [
                'id' => $seance->getId(),
                'name' => $seance->getName(),
                'description' => $seance->getDescription(),
                'imageUrl' => $imageUrl,
                'likes' => count($seance->getLikes()),
            ];
        }, $seances);
    }
}
