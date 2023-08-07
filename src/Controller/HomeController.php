<?php

namespace App\Controller;

use App\models\User;
use App\Services\SectorServiceInterface;
use App\Services\UserServiceInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\Twig;

final class HomeController
{
    public function __construct(
        private SectorServiceInterface $sectorService,
        private UserServiceInterface $userService
    ) {
    }
    public function index(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $sectors = $this->sectorService->getSectors();

        return Twig::fromRequest($request)->render(
            $response,
            'index.twig',
            ['sectors' => $sectors,]
        );
    }

    public function form(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getParsedBody();
        $name = $params['name'] ?? "";
        $userSectors = $params['sectors'] ?? [];
        $agreeTerms = $params['terms'] ?? 'off';
        $userId = $params['userId'] ?? "";

        $errors =  $this->sectorService->validateInputs($name, $userSectors, $agreeTerms);

        if (empty($errors)) {
            $sectorIds = $this->sectorService->getSectorIDsByNames($userSectors);

            if (empty($userId) || strlen(trim($userId)) < 1) {
                $userId = $this->userService->saveUser(new User(null, $name));
            } else {
                $this->userService->updateUser(new User($userId, $name));
            }
            $this->sectorService->deleteUserSectors($userId);

            $this->sectorService->saveSectorForm($userId, $sectorIds, true);

            return Twig::fromRequest($request)->render(
                $response,
                'index.twig',
                ['sectors' => $this->sectorService->getSectors(),
                    'name' => $name,
                    'userId' => intval($userId),
                    'agreeTerms' => $agreeTerms,
                    'userSectors' => $userSectors,
                ]
            );
        } else {
            if ($agreeTerms != 'on') {
                $agreeTerms = false;
            }
            return Twig::fromRequest($request)->render(
                $response,
                'index.twig',
                ['sectors' => $this->sectorService->getSectors(),
                    'name' => $name,
                    'agreeTerms' => $agreeTerms,
                    'userId' => $userId,
                    'userSectors' => $userSectors,
                    'errors' => $errors
                ]
            );
        }
    }
}
