<?php

namespace Modules\Disease\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Doctor\Entities\Doctor;
use Modules\Symptom\Entities\Symptom;
use Modules\DiseaseClassification\Entities\DiseaseClassification;
use Modules\diseaseCategory\Entities\DiseaseCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Common\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory, UsesUuid;

    /**
     * Attributes that should be hidden
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'doctor_id',
        'content',
        'prevelance_rate'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Disease\Database\factories\DiseaseFactory::new();
    }

    /**
     * Disease post belongs to only a particular doctor
     * @return BelongsTo
     */

     public function doctor(): BelongsTo
     {
        return $this->belongsTo(Doctor::class);
     }

     /**
      * @return BelongsToMany
      */
      public function symptoms(): BelongsToMany
      {
         return $this->belongsToMany(Symptom::class, 'disease_symptom', 'disease_id', 'symptom_id');
      }

      /**
       * @return BelongsToMany
       */
      public function diseaseClassification(): BelongsToMany
      {
          return $this->belongsToMany(DiseaseClassification::class, 'disease_malady_classification', 'disease_id', 'malady_classification_id');
      }

      /**
       * @return BelongsToMany
       */
      public function diseaseCategory():BelongsToMany
      {
          return $this->belongsToMany(DiseaseCategory::class, 'disease_malady_category', 'disease_id', 'malady_category_id');
      }
}
