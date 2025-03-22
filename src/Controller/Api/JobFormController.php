<?php

namespace App\Controller\Api;

use App\Model\Recruitis\Enum\ResponseCode;
use App\Repository\FormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobFormController extends AbstractController
{
    #[Route(path: '/api/form/{id<\d+|{id}>}', name: 'api_jobForm', methods: ['GET', 'POST'])]
    public function getDefinition(int $id, Request $request, FormRepository $formRepository): JsonResponse
    {
        if ('GET' === $request->getMethod()) {
            $payload = $formRepository->getDefinitonByJob($id);

            return new JsonResponse(
                data: $payload,
                status: $payload->fields ? 200 : 404
            );
        }

        return $this->handlePost(...func_get_args());
    }

    public function handlePost(int $id, Request $request, FormRepository $formRepository): JsonResponse
    {
        $postData = $request->request->all();
        $postData['job_id'] = $id;
        /** @var array<UploadedFile|UploadedFile[]|null> $files */
        $files = $request->files->all();
        foreach ($files as $key => $upload) {
            if (null === $upload) {
                continue;
            }

            if (!is_array($upload)) {
                $upload = [$upload];
            }

            $postData[$key] = array_map(fn (UploadedFile $file) => [
                'name' => $file->getClientOriginalName(),
                'base64' => base64_encode(file_get_contents($file->getRealPath())),
                'path' => null,
            ], $upload);
        }

        $res = $formRepository->submitAnwser($id, $postData);
        $status = ResponseCode::ERROR_FIELD_VALIDATION === $res->meta->code
            ? 400
            : 200;

        return new JsonResponse($res, $status);
    }
}
