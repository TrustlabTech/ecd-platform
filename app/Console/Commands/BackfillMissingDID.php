<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

use App\Models\Child;
use App\Models\Staff;
use App\Models\Centre;

class BackfillMissingDID extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backfill-did {--confirm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix all Staff, Children and Centers that have no DID';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Finding missing DIDs");

        $this->info("[child] Missing: " . Child::where('did', '')->count());
        $this->info("[centre] Missing: " . Centre::where('did', '')->count());
        $this->info("[practitioner] Missing: " . Staff::where('did', '')->count());

        $this->info('');

        if ($this->option('confirm'))
        {
            $this->info("--confirm switch on, starting sync.");

            foreach(Child::where('did', '')->get() as $res)
                $this->post($res->id, 'child');

            foreach(Centre::where('did', '')->get() as $res)
                $this->post($res->id, 'centre');

            foreach(Staff::where('did', '')->get() as $res)
                $this->post($res->id, 'practitioner');
        }
        else
        {
            $this->info("--confirm not set, doing nothing");
        }

    }

    private function post($resource_id, $resource_type)
    {
        $endpoint = env('API_V2_CREATE_DID_ENDPOINT', 'http://api.amply.tech/eis');
        $payload = JWTFactory::sub(-1)->make(); // center
        $token = JWTAuth::encode($payload);

        $restClient = new GuzzleHttp\Client();

        try {
            $restClient->post($endpoint, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token
                ],
                'json' => [
                    'id' => $resource_id,
                    'type' => $resource_type
                ]
            ]);

            $this->info("[$resource_type] ID $resource_id posted to EIS");

        }
        catch(\Exception $ex)
        {
            $this->error("[$resource_type] ID $resource_id could not be posted!");
            dd($ex->getMessage());
        }

    }
}
