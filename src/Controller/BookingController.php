<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function index(Request $request): Response
    {
        $bookingRepository = $this->entityManager->getRepository(Booking::class);
////        $bookingRepository->findAll();
        $availability = $bookingRepository->createQueryBuilder('b')
            ->andWhere('b.date_to >= :from')
            ->andWhere('b.date_from <= :to')
            ->setParameter('from', '2022-08-05')
            ->setParameter('to', '2022-08-14')
            ->getQuery()
            ->execute();
//
            dd($availability);



        return new JsonResponse(
            [
                'status' => 'ok',
                'paymentId' => '1111',
                'verifoneUrl' => 'hi',
            ],
            Response::HTTP_CREATED
        );
    }
}
