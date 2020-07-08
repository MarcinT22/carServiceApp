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
        $numberOfTodayDeliveries = $this->reportedCarRepository->getTodaysCarDeliveries()->count();
        $numberOfNewEvents = $this->eventRepository->getNumberOfNewEvents();
        $numberOfAllEvents = $this->eventRepository->getNumberOfAll();
        $numberOfInProgressEvents = $this->eventRepository->getNumberOfInProgressEvents();
        $numberOfReadyCars = $this->eventRepository->getNumberOfReadyCars();

        return array(
            "numberOfNotAcceptedReportedCars" => $numberOfNotAcceptedReportedCars,
            "numberOfAcceptedReportedCars" => $numberOfAcceptedReportedCars,
            "numberOfTodayDeliveries"=>$numberOfTodayDeliveries,
            "numberOfNewEvents" => $numberOfNewEvents,
            "numberOfAllEvents" => $numberOfAllEvents,
            "numberOfInProgressEvents" => $numberOfInProgressEvents,
            "numberOfReadyCars" => $numberOfReadyCars,
        );

    }
}
