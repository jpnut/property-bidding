<?php

namespace App\Console\Commands;

use App\Property;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use SimpleXMLElement;

class SyncPropertiesCommand extends Command
{
    const XML_FEED = 'https://my.bespokedigital.agency/taster-day/property-feed.php?secret';


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'properties:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch, store, and update all properties from the XML feed.';

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var \App\Property
     */
    private $property;

    /**
     * Create a new command instance.
     *
     * @param  \GuzzleHttp\Client  $client
     * @param  \App\Property  $property
     */
    public function __construct(Client $client, Property $property)
    {
        $this->client = $client;
        $this->property = $property;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $listings = $this->getListingsFromXmlFeed()->listing;

        foreach ($listings as $property) {
            $this->property->updateOrCreate(
                ['advert_id' => $property->BusinessInfo->AdvertID],
                [
                    'address'  => $property->CompanyInfo->CompanyAddress,
                    'location' => $property->CompanyInfo->Location,
                    'region'   => $property->CompanyInfo->Region,
                    'postcode' => $property->CompanyInfo->Postcode,

                    'name'     => $property->BusinessInfo->Name,
                    'category' => $property->BusinessInfo->Category,

                    'asking_price'    => intval($property->BusinessSummary->AskingPrice),
                    'leasehold_price' => intval($property->BusinessSummary->LeaseholdPrice),
                ]
            );
        }
    }

    protected function getListingsFromXmlFeed()
    {
        $xml = $this->client->get(self::XML_FEED)->getBody()->getContents();

        return (new SimpleXMLElement($xml));

        return json_decode(json_encode((array) $parsed), true)['listing'];
    }
}
