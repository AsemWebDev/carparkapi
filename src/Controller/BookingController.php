<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\BookingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends AbstractController
{
    private BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request): Response
    {
        $availableSpaces = $this->bookingService->getAvailability($request->get('from'), $request->get('to'));

        return new JsonResponse(
            [
                'status' => 'success',
                'availableSpaces' => $availableSpaces,
            ],
            Response::HTTP_OK
        );
    }

    public function book(Request $request): Response
    {
        $booking = $this->bookingService->book(
            $request->get('username'),
            $request->get('from'),
            $request->get('to')
        );

        return new JsonResponse(
            $booking,
            Response::HTTP_OK
        );
    }
}
