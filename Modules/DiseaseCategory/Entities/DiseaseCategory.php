<?php

namespace Modules\DiseaseCategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Common\Traits\UsesUuid;
use Modules\Disease\Entities\Disease;
use Modules\Symptom\Entities\Symptom;
use Modules\DiseaseClassification\Entities\DiseaseClassification;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiseaseCategory extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = [
        'name'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'malady_categories';
    
    protected static function newFactory()
    {
        return \Modules\DiseaseCategory\Database\factories\DiseaseCategoryFactory::new();
    }

    /**
     * @return BelongsToMany
     */
    public function disease():BelongToMany
    {
        return $this->belongsToMany(Disease::class, 'disease_malady_category', 'malady_category_id');
    }

    /**
     * @return BelongsTo
     */
    public function diseaseClassification():BelongsTo
    {
        return $this->belongsTo(DiseaseClassification::class);
    }

    /**
     * @return BelongsToMany
     */
    public function symptom():BelongsToMany
    {
        return $this->belongsToMany(Symptom::class);
    }


}
