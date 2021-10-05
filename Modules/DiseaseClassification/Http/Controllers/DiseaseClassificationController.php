<?php

namespace Modules\DiseaseClassification\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\DiseaseClassification\Entities\DiseaseClassification;
use Modules\DiseaseClassification\Transformers\DiseaseClassificationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\DiseaseClassification\Http\Requests\CreateDiseaseClassificationRequest;
use Modules\DiseaseClassification\Http\Requests\SearchDiseaseClassificationRequest;
use Modules\DiseaseClassification\Http\Requests\UpdateDiseaseClassificationRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiseaseClassificationController extends Controller
{

    /**
     * Fetch all diseaseClassifications from the database
     * @param null
     * @return ResourceCollection
     */
    public function getAllDiseaseClassifications(): ResourceCollection
    {
        /**
         * @var DiseaseClassification $diseaseClassifications
         */
        $diseaseClassifications = DiseaseClassification::get();
        
        return DiseaseClassificationResource::collection($diseaseClassifications);
    }

    /**
     * Get diseaseClassifications based on search query
     * @param SearchDiseaseClassificationRequest $request
     * @return JsonResponse
     * @return ResourceCollection
     */
    public function getDiseaseClassifications(SearchDiseaseClassificationRequest $request)
    {
        /**
         * @var DiseaseClassification $diseaseClassifications
         */

        $diseaseClassifications = DiseaseClassification::where('name', 'regexp', "$request->diseaseCategory")->get();

        if(count($diseaseClassifications) == 0){
            return response()
            ->json(['Sorry, diseaseCategory not found']);
        }else{
            return DiseaseClassificationResource::collection($diseaseClassifications);
        }

    }

    /**
     * Update resource
     * @param UpdateDIseaseClassificationRequest $request
     * @param $uuid
     * @return JsonResponse
     */
    public function updateDiseaseClassification(UpdateDiseaseClassificationRequest $request, $uuid): JsonResponse
    {
        /**
         * @var DiseaseClassification $diseaseCategory
         */
        $diseaseCategory = DiseaseClassification::findUuid($uuid);

        $diseaseCategory->update([
            'name' => $request->name
        ]);
        return response()
        ->json(["DiseaseClassification update successful"]);
    }

    /**
     * view resource
     * @param $uuid
     * @return JsonResponse
     */
    public function showDiseaseClassification($uuid): DiseaseClassificationResource
    {
        /**
         * @var DiseaseClassification $diseaseCategory
         */
       $diseaseCategory = DiseaseClassification::findUuid($uuid);
        
        return new DiseaseClassificationResource($diseaseCategory);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateDiseaseClassificationRequest $request
     * @return JsonResponse
     */
    public function storeDiseaseClassification(CreateDiseaseClassificationRequest $request): JsonResponse
    {
        //
        $diseaseCategory = DiseaseClassification::create([
            'name' => $request->input('name')
        ]);
        return response()->json(['DiseaseClassification creation successful']);
    }

    /**
     * Delete resource
     * @param $uuid
     * @return JsonResponse
     */
    public function deleteDiseaseClassification($uuid)
    {
        /**
         * @var DiseaseClassification $diseaseCategory
         */
        $diseaseCategory = DiseaseClassification::findUuid($uuid);

        $diseaseCategory->delete();
        
        return response()->json(['DiseaseClassification deleted']);
    }

}
