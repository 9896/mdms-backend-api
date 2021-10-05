<?php

namespace Modules\Disease\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Entities\Admin;
use Modules\Doctor\Entities\Doctor;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Modules\Symptom\Entities\Symptom;
use Modules\Disease\Entities\Disease;
use Modules\DiseaseClassification\Entities\DiseaseClassification;
use Modules\DiseaseCategory\Entities\DiseaseCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Disease\Transformers\DiseaseResource;
use Modules\Disease\Http\Requests\CreateDiseaseRequest;
use Modules\Disease\Http\Requests\SearchDiseaseRequest;
use Modules\Disease\Http\Requests\UpdateDiseaseRequest;
use Illuminate\Support\Str;

use Illuminate\Routing\Controller;

class DiseaseController extends Controller
{
  
    /**
     * Fetch all diseases from the database
     * @param null
     * @return ResourceCollection
     */
    public function getAllDiseases(): ResourceCollection
    {
        /**
         * @var Disease $diseases
         */
        $diseases = Disease::paginate(10);
        
        return DiseaseResource::collection($diseases);
    }

    /**
     * Get diseases based on search query
     * @param SearchDiseaseRequest $request
     * @return JsonResponse
     * @return ResourceCollection
     */
    public function getDiseases(SearchDiseaseRequest $request)
    {
        /**
         * @var Disease $diseases
         */

        $diseases = Disease::where('name', 'regexp', "$request->disease")->paginate(10);

        if(count($diseases) == 0){
            return response()
            ->json(['Sorry, disease not found']);
        }else{
            return DiseaseResource::collection($diseases);
        }

    }

    /**
     * Update resource
     * @param UpdateDiseaseRequest $request
     * @param $uuid
     * @return JsonResponse
     */
    public function updateDisease(UpdateDiseaseRequest $request, $uuid): JsonResponse
    {
        /**
         * @var Disease $disease
         */
        $disease = Disease::findUuid($uuid);

        // $disease->update([
        //     'name' => $request->name,
        //     'content' => $request->content,
        //     'prevelance_rate' => $request->prevelance_rate,
        //     'age_start' => $request->age_start,
        //     'age_end' => $request->age_end,

        // ]);
        // return response()
        // ->json(["Disease update successful"]);
        DB::beginTransaction();

        try{
        
        $disease->update([
            'name' => $request->name,
            'content' => $request->content,
            'prevelance_rate' => $request->prevelance_rate,
            'age_start' => $request->age_start,
            'age_end' => $request->age_end,
        ]);


        if(count($request->symptom) != 0){
            $symptomIds = [];
            for($i = 0; $i < count($request->symptom); $i++){
                $symptomIds[$i] = Symptom::findUuid($request->symptom[$i])->id;
            }
            $disease->symptoms()->sync($symptomIds);
        }
        
        if(count($request->disease_category) != 0){
            $diseaseCategoryIds = [];
            for($i = 0; $i < count($request->disease_category); $i++){
                $diseaseCategoryIds[$i] = DiseaseCategory::findUuid($request->disease_category[$i])->id;
            }
            $disease->diseaseCategory()->sync($diseaseCategoryIds);
        }

        if(count($request->disease_classification) != 0){
            $diseaseClassificationIds = [];
            for($i = 0; $i < count($request->disease_classification); $i++){
                $diseaseClassificationIds[$i] = DiseaseClassification::findUuid($request->disease_classification[$i])->id;
            }
            $disease->diseaseClassification()->sync($diseaseClassificationIds);
        }
        DB::commit();

        return response()->json(['Disease Update successful']);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['Oops! '.$e]);
        }

    }

    /**
     * view resource
     * @param $uuid
     * @return JsonResponse
     */
    public function showDisease($uuid): DiseaseResource
    {
        /**
         * @var Disease $disease
         */
       $disease = Disease::findUuid($uuid);
        
        return new DiseaseResource($disease);
    }

    /**
     * Store a newly created resource in storage.
     * @param CreateDiseaseRequest $request
     * @return JsonResponse
     */
    public function storeDisease(CreateDiseaseRequest $request): JsonResponse
    {

        $id = Auth::user()->id;

        DB::beginTransaction();
        try{
        
        $disease = Disease::create([
            'name' => $request->input('name'),
            'content' => $request->content,
            'prevelance_rate' => $request->prevelance_rate,
            'doctor_id' => $id
        ]);


        $symptomIds = [];
        for($i = 0; $i < count($request->symptom); $i++){
            $symptomIds[$i] = Symptom::findUuid($request->symptom[$i])->id;
        }
        $disease->symptoms()->attach($symptomIds);;
        
        if(count($request->disease_category) != 0){
            $diseaseCategoryIds = [];
            for($i = 0; $i < count($request->disease_category); $i++){
                $diseaseCategoryIds[$i] = DiseaseCategory::findUuid($request->disease_category[$i])->id;
            }
            $disease->diseaseCategory()->attach($diseaseCategoryIds);
            //return response()->json(['symtpms Array'=> $symptomsIds, 'categories Array' => $diseaseCategoryIds]); 
        }

        if(count($request->disease_classification) != 0){
            $diseaseClassificationIds = [];
            for($i = 0; $i < count($request->disease_classification); $i++){
                $diseaseClassificationIds[$i] = DiseaseClassification::findUuid($request->disease_classification[$i])->id;
            }
            $disease->diseaseClassification()->attach($diseaseClassificationIds);
        }
        DB::commit();

        return response()->json(['Disease creation successful']);

        }catch(Exception $e){
            DB::rollBack();
            return response()->json(['Oops! '.$e]);
        }
    }

    /**
     * Delete resource
     * @param $uuid
     * @return JsonResponse
     */
    public function deleteDisease($uuid)
    {
        /**
         * @var Disease $disease
         */
        $disease = Disease::findUuid($uuid);

        $disease->delete();
        
        return response()->json(['Disease deleted']);
    }

    /**
     * Fill pivot table with data
     * @param string $param
     * @return void
     */
    private function addToPivot($requestParam)
    {
        // $collection = Str::of($requestParam, '_');
        // $classname;
        // $relationshipName;

        // $requestParam."Ids" = [];
        // for($i = 0; $i < count($request->$requestParam); $i++){
        //     $symptomsIds[$i] = Symptom::findUuid($request->$requestParam[$i])->id;
        // }
        // $disease->symptom()->attach($symptomsIds);
    }

}
