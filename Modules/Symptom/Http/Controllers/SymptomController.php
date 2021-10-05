<?php

namespace Modules\Symptom\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Symptom\Entities\Symptom;
use Modules\Symptom\Transformers\SymptomResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Symptom\Http\Requests\CreateSymptomRequest;
use Modules\Symptom\Http\Requests\SearchSymptomRequest;
use Modules\Symptom\Http\Requests\UpdateSymptomRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SymptomController extends Controller
{

    /**
     * Fetch all symptoms from the database
     * @param null
     * @return ResourceCollection
     */
    public function getAllSymptoms($get = null): ResourceCollection
    {
        if($get == "true"){
            $symptoms = Symptom::get();
        }else{
        /**
         * @var Symptom $symptoms
         */
        $symptoms = Symptom::paginate(10);
        }
        
        return SymptomResource::collection($symptoms);
    }

    /**
     * Get symptoms based on search query
     * @param SearchSymptomRequest $request
     * @return JsonResponse
     * @return ResourceCollection
     */
    public function getSymptoms(SearchSymptomRequest $request)
    {
        /**
         * @var Symptom $symptoms
         */
        $symptoms = Symptom::where('name', 'regexp', "$request->symptom")->paginate(2);

        if(count($symptoms) == 0){
            return response()
            ->json(['Sorry, symptom not found']);
        }else{
            return SymptomResource::collection($symptoms);
        }

    }

    /**
     * Update resource
     * @param UpdateSysmptomRequest $request
     * @param $uuid
     * @return JsonResponse
     */
    public function updateSymptom(UpdateSymptomRequest $request, $uuid): JsonResponse
    {
        /**
         * @var Symptom $symptom
         */
        $symptom = Symptom::findUuid($uuid);

        $symptom->update([
            'name' => $request->name
        ]);
        return response()
        ->json(["Symptom update successful"]);
    }

    /**
     * view resource
     * @param $uuid
     * @return JsonResponse
     */
    public function showSymptom($uuid): SymptomResource
    {
        /**
         * @var Symptom $symptom
         */
       $symptom = Symptom::findUuid($uuid);
        
        return new SymptomResource($symptom);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateSymptomRequest $request
     * @return JsonResponse
     */
    public function storeSymptom(CreateSymptomRequest $request): JsonResponse
    {
        //
        $symptom = Symptom::create([
            'name' => $request->input('name')
        ]);
        return response()->json(['Symptom creation successful']);
    }

    /**
     * Delete resource
     * @param $uuid
     * @return JsonResponse
     */
    public function deleteSymptom($uuid)
    {
        /**
         * @var Symptom $symptom
         */
        $symptom = Symptom::findUuid($uuid);

        $symptom->delete();
        
        return response()->json(['Symptom deleted']);
    }


}
