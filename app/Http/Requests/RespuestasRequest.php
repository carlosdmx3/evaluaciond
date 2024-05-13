<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RespuestasRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'p1'   => 'required|in:1,2,3,4,5',
            'p2'   => 'required|in:1,2,3,4,5',
            'p2'   => 'required|in:1,2,3,4,5',
            'p3'   => 'required|in:1,2,3,4,5',
            'p4'   => 'required|in:1,2,3,4,5',
            'p5'   => 'required|in:1,2,3,4,5',
            'p6'   => 'required|in:1,2,3,4,5',
            'p7'   => 'required|in:1,2,3,4,5',
            'p8'   => 'required|in:1,2,3,4,5',
            'p9'   => 'required|in:1,2,3,4,5',
            'p10'  => 'required|in:1,2,3,4,5',
            'p11'  => 'required|in:1,2,3,4,5',
            'p12'  => 'required|in:1,2,3,4,5',
            'p13'  => 'required|in:1,2,3,4,5',
            'p14'  => 'required|in:1,2,3,4,5',
            'p15'  => 'required|in:1,2,3,4,5',
            'p16'  => 'required|in:1,2,3,4,5',
            'p17'  => 'required|in:1,2,3,4,5',
            'p18'  => 'required|in:1,2,3,4,5',
            'p19'  => 'required|in:1,2,3,4,5',
            'p20'  => 'required|in:1,2,3,4,5',
            'p21'  => 'required|in:1,2,3,4,5',
            'p22'  => 'required|in:1,2,3,4,5',
            'p23'  => 'required|in:1,2,3,4,5',
            'p24'  => 'required|in:1,2,3,4,5',
            'p25'  => 'required|in:1,2,3,4,5',
            'p26'  => 'required|in:1,2,3,4,5',
            'p27'  => 'required|in:1,2,3,4,5',
            'p28'  => 'required|in:1,2,3,4,5',
            'p29'  => 'required|in:1,2,3,4,5',
            'p30'  => 'required|in:1,2,3,4,5',
            'p31'  => 'required|in:1,2,3,4,5',
            'p32'  => 'required|in:1,2,3,4,5',
            'p33'  => 'required|in:1,2,3,4,5',
            'p34'  => 'required|in:1,2,3,4,5',
            'p35'  => 'required|in:1,2,3,4,5',
        ];
    }


    public function messages(){
        return [
            'p1.required'   => 'Elije una respuesta a la pregunta 1',
            'p2.required'   => 'Elije una respuesta a la pregunta 2',
            'p3.required'   => 'Elije una respuesta a la pregunta 3',
            'p4.required'   => 'Elije una respuesta a la pregunta 4',
            'p5.required'   => 'Elije una respuesta a la pregunta 5',
            'p6.required'   => 'Elije una respuesta a la pregunta 6',
            'p7.required'   => 'Elije una respuesta a la pregunta 7',
            'p8.required'   => 'Elije una respuesta a la pregunta 8',
            'p9.required'   => 'Elije una respuesta a la pregunta 9',
            'p10.required'  => 'Elije una respuesta a la pregunta 10',
            'p11.required'  => 'Elije una respuesta a la pregunta 11',
            'p12.required'  => 'Elije una respuesta a la pregunta 12',
            'p13.required'  => 'Elije una respuesta a la pregunta 13',
            'p14.required'  => 'Elije una respuesta a la pregunta 14',
            'p15.required'  => 'Elije una respuesta a la pregunta 15',
            'p16.required'  => 'Elije una respuesta a la pregunta 16',
            'p17.required'  => 'Elije una respuesta a la pregunta 17',
            'p18.required'  => 'Elije una respuesta a la pregunta 18',
            'p19.required'  => 'Elije una respuesta a la pregunta 19',
            'p20.required'  => 'Elije una respuesta a la pregunta 20',
            'p21.required'  => 'Elije una respuesta a la pregunta 21',
            'p22.required'  => 'Elije una respuesta a la pregunta 22',
            'p23.required'  => 'Elije una respuesta a la pregunta 23',
            'p24.required'  => 'Elije una respuesta a la pregunta 24',
            'p25.required'  => 'Elije una respuesta a la pregunta 25',
            'p26.required'  => 'Elije una respuesta a la pregunta 26',
            'p27.required'  => 'Elije una respuesta a la pregunta 27',
            'p28.required'  => 'Elije una respuesta a la pregunta 28',
            'p29.required'  => 'Elije una respuesta a la pregunta 29',
            'p30.required'  => 'Elije una respuesta a la pregunta 30',
            'p31.required'  => 'Elije una respuesta a la pregunta 31',
            'p32.required'  => 'Elije una respuesta a la pregunta 32',
            'p33.required'  => 'Elije una respuesta a la pregunta 33',
            'p34.required'  => 'Elije una respuesta a la pregunta 34',
            'p35.required'  => 'Elije una respuesta a la pregunta 35',
        ];
        

    }






}
