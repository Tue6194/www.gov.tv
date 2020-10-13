<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Imageslide extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    public $table = 'imageslides';

    protected $appends = [
        'image',
    ];

    const STATUS_SELECT = [
        'Publish' => 'Publish',
        'Hide'    => 'Hide',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'page_id',
        'description',
        'firstbutton',
        'firstbutton_link',
        'secondbutton',
        'secondbutton_link',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getImageAttribute()
    {
        return $this->getMedia('image')->last();
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
