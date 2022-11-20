<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\RestaurantRepository;
use App\Http\Requests\StoreRestaurantRequest;
use Illuminate\View\View;

class RestaurantController extends Controller {

    private RestaurantRepository $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository) {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index(): View {
        return view('restaurant.create');
    }

    public function store(StoreRestaurantRequest $request): View {
        $values = $request->validated();
        $this->restaurantRepository->createNew($values);
        return view('restaurant.create');
    }
}
