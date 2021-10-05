<?php

namespace Modules\DiseaseCategory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\DiseaseCategory\Entities\DiseaseCategory;
use Modules\DiseaseCategory\Transformers\DiseaseCategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\DiseaseCategory\Http\Requests\CreateDiseaseCategoryRequest;
use Modules\DiseaseCategory\Http\Requests\SearchDiseaseCategoryRequest;
use Modules\DiseaseCategory\Http\Requests\UpdateDiseaseCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DiseaseCategoryController extends Controller
{

    /**
     * Fetch all diseaseCategories from the database
     * @param null
     * @return ResourceCollection
     */
    public function getAllDiseaseCategories(): ResourceCollection
    {
        /**
         * @var DiseaseCategory $diseaseCategories
         */
        $diseaseCategories = DiseaseCategory::get();
        
        return DiseaseCategoryResource::collection($diseaseCategories);
    }

    /**
     * Get diseaseCategories based on search query
     * @param SearchDiseaseCategoryRequest $request
     * @return JsonResponse
     * @return ResourceCollection
     */
    public function getDiseaseCategories(SearchDiseaseCategoryRequest $request)
    {
        /**
         * @var DiseaseCategory $diseaseCategories
         */

        $diseaseCategories = DiseaseCategory::where('name', 'regexp', $request->diseaseCategory)->get();

        return DiseaseCategoryResource::collection($diseaseCategories);

        // if(count($diseaseCategories) == 0){
        //     return response()
        //     ->json(['Sorry, diseaseCategory not found']);
        // }else{
        //     return DiseaseCategoryResource::collection($diseaseCategories);
        // }

    }

    /**
     * Update resource
     * @param UpdateSysmptomRequest $request
     * @param $uuid
     * @return JsonResponse
     */
    public function updateDiseaseCategory(UpdateDiseaseCategoryRequest $request, $uuid): JsonResponse
    {
        /**
         * @var DiseaseCategory $diseaseCategory
         */
        $diseaseCategory = DiseaseCategory::findUuid($uuid);

        $diseaseCategory->update([
            'name' => $request->name
        ]);
        return response()
        ->json(["DiseaseCategory update successful"]);
    }

    /**
     * view resource
     * @param $uuid
     * @return JsonResponse
     */
    public function showDiseaseCategory($uuid): DiseaseCategoryResource
    {
        /**
         * @var DiseaseCategory $diseaseCategory
         */
       $diseaseCategory = DiseaseCategory::findUuid($uuid);
        
        return new DiseaseCategoryResource($diseaseCategory);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateDiseaseCategoryRequest $request
     * @return JsonResponse
     */
    public function storeDiseaseCategory(CreateDiseaseCategoryRequest $request): JsonResponse
    {
        //
        $diseaseCategory = DiseaseCategory::create([
            'name' => $request->input('name')
        ]);
        return response()->json(['DiseaseCategory creation successful']);
    }

    /**
     * Delete resource
     * @param $uuid
     * @return JsonResponse
     */
    public function deleteDiseaseCategory($uuid)
    {
        /** @var DiseaseCategory $diseaseCategory */
        $diseaseCategory = DiseaseCategory::findUuid($uuid);

        $diseaseCategory->delete();
        
        return response()->json(['DiseaseCategory deleted']);
    }

}
