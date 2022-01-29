<?php

namespace App\Console\Commands;

use App\Repositories\OrderRepositoryInterface;
use App\Services\MarketPlace\MainMarketPlaceService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get orders and write it in db';

    /**
     * @var MainMarketPlaceService
     */

    private $mainMarketPlaceService;
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
        $currentPage = 1;
        $lastPage = 2;
        $idParam = [];

        $maxOrderId = $this->orderRepository->max("id");

        if ($maxOrderId > 1) {
            $idParam = ["id" => $maxOrderId];
        }

        do {
            try {
                $res = $this->mainMarketPlaceService->getOrders(["page" => $currentPage] + $idParam);

                if (!$res){
                    sleep(1);
                    continue;
                }

                $currentPage = (int)$res["current_page"] + 1;
                $lastPage = (int)$res["last_page"];

                foreach ($res["data"] as $order){
                    $this->orderRepository->create(collect($order)
                        ->only(["id", "payment_method", "shipping_method", "company_id", "type", "total", "created_at", "updated_at"])
                        ->toArray());
                }

            } catch (\Exception $exception){
                Log::error('GetOrders Command Error: ', [$exception->getMessage()]);
            }

        } while ($currentPage <= $lastPage);

        return true;
    }
}
