<?php

namespace App\Console\Commands;

use App\Repositories\OrderRepositoryInterface;
use App\Services\MarketPlace\MainMarketPlaceService;
use Illuminate\Console\Command;

class GetOrderDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:order-details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get order details and write it in db';

    /**
     * @var MainMarketPlaceService
     */
    private $mainMarketPlaceService;

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * Create a new command instance.
     *
     * @param MainMarketPlaceService $mainMarketPlaceService
     * @param OrderRepositoryInterface $orderRepository
     */

    public function __construct(MainMarketPlaceService $mainMarketPlaceService, OrderRepositoryInterface $orderRepository)
    {
        parent::__construct();
        $this->mainMarketPlaceService = $mainMarketPlaceService;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        sleep(6);

        $orders = $this->orderRepository->get(100);

        foreach ($orders as $order) {
            do {
                $res = $this->mainMarketPlaceService->getOrderDetails($order);
            } while (!$res);

            $this->orderRepository->firstOrCreate($res);$this->orderRepository->approveOrderType($order);
        }
        return true;
    }
}
