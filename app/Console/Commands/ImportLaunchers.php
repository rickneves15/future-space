<?php

namespace App\Console\Commands;

use App\Models\Launcher;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class ImportLaunchers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:launchers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Routine for importing launchers';

    protected $LIMIT_PER_PAGE = 1;
    protected $LIMIT_RECORDS = 2;

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
     * @return int
     */
    public function handle()
    {
        $launchers = $this->getData("https://ll.thespacedevs.com/2.2.0/launch/?limit={$this->LIMIT_PER_PAGE}&mode=detailed");
    }

    function getData($url)
    {
        try {
            $launchers = [];
            $client = new Client();
            $response = $client->request('GET', $url);
            $data = json_decode($response->getBody());


            foreach ($data->results as $key => $launcher) {

                $queryFindLaunchers = Launcher::whereJsonContains('dataset->id', [$launcher->id])->get();


                if (count($queryFindLaunchers) > 0) {
                    $this->info($key . " Launcher already imported.");
                    break;
                }

                $launcherModel = new Launcher();
                $launcherModel->dataset = $launcher;
                $launcherModel->save();
            }


            if (count($launchers) <= $this->LIMIT_RECORDS) {
                $this->info("Wait a moment for next import.");
                $this->getData($data->next);
            }

            $this->info(count($launchers) . " Launchers imported.");
            return $launchers;
        } catch (ClientException $exception) {
            $this->info("error status code: " . $exception->getResponse()->getStatusCode());
        }
    }
}
