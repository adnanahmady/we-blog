<?php

namespace App\Controller\Api\V1;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1/posts', name: 'v1.posts.')]
class PostsController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(
        PostRepository $postRepository
    ): JsonResponse {
        return $this->json([
            'data' => $postRepository->findAll(),
        ]);
    }
}
