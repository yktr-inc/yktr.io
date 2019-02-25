<?php

namespace App\Controller\Back;

use App\Entity\Document;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use App\Service\FileUploader;
use App\Form\DocumentType;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function new(Request $request, FileUploader $fileUploader)
    {
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('file')->getData();
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            $fileUploader->upload($file, $fileName);

            $document->setFile($fileName);
            $originalFileName = $form->get('file')->getData()->getClientOriginalName();
            $document->setOriginalName($originalFileName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirect('/');
        }

        return $this->render('Back/_upload/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
}
