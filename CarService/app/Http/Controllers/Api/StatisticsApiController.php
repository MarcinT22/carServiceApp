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
        $amountNotAcceptedReportedCars = $this->reportedCarRepository->getCountNotAccepted();
        $amountAcceptedReportedCars = $this->reportedCarRepository->getCountAccepted();
        $amountDeliveredReportedCars = $this->reportedCarRepository->getCountDelivered();
        $amountEvents = $this->eventRepository->getAmountAll();
        $amountInProgressEvents = $this->eventRepository->getAmountInProgressEvents();
        $amountReadyCars = $this->eventRepository->getAmountReadyCars();

        return array(
            "amountNotAcceptedReportedCars" => "$amountNotAcceptedReportedCars",
            "amountAcceptedReportedCars" => "$amountAcceptedReportedCars",
            "amountDeliveredReportedCars" => "$amountDeliveredReportedCars",
            "amountEvents" => "$amountEvents",
            "amountInProgressEvents" => "$amountInProgressEvents",
            "amountReadyCars" => "$amountReadyCars",
        );

    }
}
