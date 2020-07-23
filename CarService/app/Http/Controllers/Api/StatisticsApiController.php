<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\ReportedCarRepository;
use Illuminate\Http\Request;

class StatisticsApiController extends Controller
{

    protected $eventRepository;
    protected $reportedCarRepository;

    public function __construct(EventRepository $eventRepository, ReportedCarRepository $reportedCarRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->reportedCarRepository = $reportedCarRepository;
    }


    public function getStatistics()
    {
        $numberOfNotAcceptedReportedCars = $this->reportedCarRepository->getNotAccepted()->count();
        $numberOfAcceptedReportedCars = $this->reportedCarRepository->getAccepted()->count();
        $numberOfTodayDeliveries = $this->reportedCarRepository->getTodayCarDeliveries()->count();
        $numberOfNewEvents = $this->eventRepository->getNewEvents()->count();
        $numberOfAllEvents = $this->eventRepository->getAllEvents()->count();
        $numberOfTodayEvents = $this->eventRepository->getTodayEvents()->count();
        $numberOfInProgressEvents = $this->eventRepository->getNumberOfInProgressEvents();
        $numberOfReadyCars = $this->eventRepository->getReadyCars()->count();

        return array(
            "numberOfNotAcceptedReportedCars" => $numberOfNotAcceptedReportedCars,
            "numberOfAcceptedReportedCars" => $numberOfAcceptedReportedCars,
            "numberOfTodayDeliveries"=>$numberOfTodayDeliveries,
            "numberOfNewEvents" => $numberOfNewEvents,
            "numberOfAllEvents" => $numberOfAllEvents,
            "numberOfTodayEvents" => $numberOfTodayEvents,
            "numberOfInProgressEvents" => $numberOfInProgressEvents,
            "numberOfReadyCars" => $numberOfReadyCars,
        );

    }
}
