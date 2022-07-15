<?php

namespace App\Service;

use App\Entity\Booking;
use App\Repository\BookingRepository;
use DateTime;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BookingService
{
    private BookingRepository $bookingRepository;
    private int $carParkSpaces;

    public function __construct(BookingRepository $bookingRepository, ParameterBagInterface $parameterBag)
    {
        $this->bookingRepository = $bookingRepository;
        $this->carParkSpaces = $parameterBag->get('car_park_spaces');
    }

    public function book(string $username, string $from, string $to): array
    {
        $availability = $this->getAvailability($from, $to);
        foreach ($availability as $space) {
            if ($space == 0) {
                return [
                    'status' => 'error',
                    'message' => 'One or more of the selected dates are fully booked. Try another date range',
                    'availability' => $availability,
                ];
            }
        }

        $booking = new Booking();
        $booking->setCustomer($username);
        $booking->setDateFrom(new DateTime($from));
        $booking->setDateTo(new DateTime($to));

        $this->bookingRepository->add($booking, true);

        return [
            'status' => 'success',
            'message' => 'Your booking is successful',
        ];
    }

    public function getAvailability(string $from, string $to): array
    {
        $booking = $this->bookingRepository->findBookingBetweenTwoDates($from, $to);
        $bookedSpaces = $this->getBookedSpacesPerDay($from, $to, $booking);

        return array_map([$this, 'getAvailableSpaces'], $bookedSpaces);
    }

    public function getAvailableSpaces($value): int
    {
        return $this->carParkSpaces - $value;
    }

    private function getBookedSpacesPerDay(string $from, string $to, array $booking): array
    {
        $dates = $this->initiateDatesArray($from, $to);

        /** @var Booking $item */
        foreach($booking as $item) {
            $dates= $this->fillBookedDates(
                $dates,
                $from,
                $to,
                $item->getDateFrom()->format('Y-m-d'),
                $item->getDateTo()->format('Y-m-d')
            );
        }

        return $dates;
    }

    private function initiateDatesArray(string $from, string $to): array
    {
        $dates = [];
        While (date('Y-m-d', strtotime($from)) <= date('Y-m-d', strtotime($to))) {
            $dates[$from] = 0;
            $from = date('Y-m-d', strtotime('+1 day', strtotime($from)));
        }

        return $dates;
    }

    private function fillBookedDates(
        array $dates,
        string $from,
        string $to,
        string $bookingFrom,
        string $bookingTo
    ): array {
        While (date('Y-m-d', strtotime($bookingFrom)) <= date('Y-m-d', strtotime($bookingTo))) {
            if (date('Y-m-d', strtotime($bookingFrom)) < date('Y-m-d', strtotime($from))) {
                $bookingFrom = date('Y-m-d', strtotime('+1 day', strtotime($bookingFrom)));
                continue;
            }
            if (date('Y-m-d', strtotime($bookingFrom)) > date('Y-m-d', strtotime($to))) break;

            $dates[$bookingFrom]++;
            $bookingFrom = date('Y-m-d', strtotime('+1 day', strtotime($bookingFrom)));
        }

        return $dates;
    }

}