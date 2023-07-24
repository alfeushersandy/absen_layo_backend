<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if(request()->isMethod('POST')){
            $data = [
                'nik_karyawan' => 'required|unique:karyawans',
                'nama' => 'required',
                'departemen_id' => 'required',
                'user_approve' => 'required',
            ];
        }elseif(request()->isMethod('PUT')){
            $data = [
                'nik_karyawan' => 'required',
                'nama' => 'required',
                'departemen_id' => 'required',
                'user_approve' => 'required',
            ];
        }

        return $data;
    }
}
