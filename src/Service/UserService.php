<?php

namespace App\Service;

use App\Entity\User;

class UserService
{
    public function getUserDataForApi(?User $user, string $baseUrl): array
    {
        if (!$user) {
            return [
                'id' => null,
                'username' => 'Invité',
                'image' => null,
            ];
        }

        $userImageUrl = $baseUrl . '/uploads/avatar/' . $user->getPictureFile();
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'image' => $userImageUrl,
        ];
    }

    public function getUserPublicData(User $user): array
    {
        return [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'sports' => $user->getSports(),
            'description' => $user->getDescription(),
            'picture' => $user->getPictureFile(),
        ];
    }
}
