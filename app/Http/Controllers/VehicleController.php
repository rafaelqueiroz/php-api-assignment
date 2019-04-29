<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Clients\NCAPHttpClient;


class VehicleController extends Controller
{

    /** @var NCAPHttpClient  */
    private $client;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(NCAPHttpClient $NCAPClient)
    {
        $this->client = $NCAPClient;
    }

    /**
     *
     */
    public function index(Request $request)
    {
        $variants = $this->client->getVariants($request->modelYear, $request->manufacturer, $request->model);       
        foreach ($variants->Results as &$variant) {
            $variant->Description = $variant->VehicleDescription;
            unset ($variant->VehicleDescription);
            if ($request->withRating === 'true') {
                $rating = $this->client->getSafetyRatings($variant->VehicleId);
                $variant->CrashRating = $rating->Results[0]->OverallRating;
            }
        }

        return response()->json([
            'Count' => $variants->Count,
            'Results' => $variants->Results
        ]);     
    }

}
