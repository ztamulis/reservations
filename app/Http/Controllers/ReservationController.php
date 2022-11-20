<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Services\ReservationsService;
use Illuminate\View\View;

class ReservationController extends Controller {

    private ReservationsService $reservationsService;

    public function __construct(ReservationsService $reservationsService) {
        $this->reservationsService = $reservationsService;
    }

    public function index(): View {
        return view('reservation.create');
    }

    public function store(StoreReservationRequest $request): View {
        $values = $request->validated();
        $this->reservationsService->makeReservation($values);
        return view('reservation.create');
    }
}
