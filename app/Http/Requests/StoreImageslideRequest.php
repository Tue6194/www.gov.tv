<?php

namespace App\Http\Requests;

use App\Imageslide;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreImageslideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('imageslide_create');
    }

    public function rules()
    {
        return [
            'title'             => [
                'string',
                'nullable',
            ],
            'description'       => [
                'string',
                'nullable',
            ],
            'firstbutton'       => [
                'string',
                'nullable',
            ],
            'firstbutton_link'  => [
                'string',
                'nullable',
            ],
            'secondbutton'      => [
                'string',
                'nullable',
            ],
            'secondbutton_link' => [
                'string',
                'nullable',
            ],
        ];
    }
}
