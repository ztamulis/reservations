<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\RestaurantRepository;
use App\Repositories\RestaurantTableRepository;
use App\Http\Requests\StoreRestaurantTableRequest;
use Illuminate\View\View;

class RestaurantTableController extends Controller {

    private RestaurantTableRepository $restaurantTableRepository;

    private RestaurantRepository $restaurantRepository;

    public function __construct(
        RestaurantTableRepository $restaurantTableRepository,
        RestaurantRepository $restaurantRepository
    ) {
        $this->restaurantTableRepository = $restaurantTableRepository;
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index(): View {
        return view('restauranttable.create');
    }

    public function store(StoreRestaurantTableRequest $request): View {
        $values = $request->validated();
        $this->restaurantTableRepository->createNew($values);

        $restaurant = $this->restaurantRepository->getById((int) $values['restaurant_id']);
        $restaurant->table_count++;
        $restaurant->max_customers = $restaurant->max_customers + $values['chairs'];
        $restaurant->save();
        return view('restauranttable.create');
    }
}
