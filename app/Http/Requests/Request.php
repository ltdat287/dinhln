<?php

namespace VirtualProject\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * (non-PHPdoc)
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     */
    public function messages()
    {
        $results = null;
        $refs = ['required', 'max', 'vpdate', 'vptelephone', 'vpemail', 'confirmed', 'date_format', 'between', 'password'];
        foreach ($refs as $ref)
        {
            $results[$ref] = trans('valids.' . $ref);
        }
        
        return $results;
    }
}
