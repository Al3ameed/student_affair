<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $delete_check = ',deleted_at,NULL';
        switch ($this->getMethod()) {
            case 'GET':
            case 'DELETE':
                $default = [
                    'student' => 'required|integer|exists:students,id'.$delete_check,
                ];
                break;
            case 'POST':
                $default = [
                    'name' => 'required|string',
                    'student_id' => 'required|numeric|unique:students,student_id',
                    'dob' => 'required|date',

                    'qualification' => 'required|numeric|between:0,5',
                    'qualification_year' => 'required|digits:4|integer|min:2000|max:'.(date('Y')+1),
                    'secondry_grade' => 'required|numeric',

                    'gender' => 'required|boolean',
                    'status' => 'required|boolean',
                    'nationality' => 'required|boolean',
                    'national_id' => 'required|numeric|unique:students,national_id',
                    'student_number' => 'required|numeric|unique:students,student_number',
                    'university_email' => 'required|email:rfc,dns|unique:students,university_email',
                    'img' => 'image|mimes:jpeg,jpg,png,gif|required|max:1000',

                    'father_name' => 'required|string',
                    'mother_name' => 'required|string',
                    'father_job' => 'required|string',
                    'mother_job' => 'required|string',
                    'Address' => 'required|string',
                    'governorate' => 'required|between:1,27',

                    'level' => "required|integer|between:1,4",

                    'military_status' => 'required|integer|between:1,3',
                    'military_reason' => 'string|nullable',
                    'military_date' => 'date|nullable',
                    'military_number' => 'numeric|nullable',
                    'military_education' => 'required|boolean',
                ];
                break;
            case 'PUT':
                $default = [
                    'student' => 'required|integer|exists:students,id'.$delete_check,

                    'name' => 'string',
                    'student_id' => 'numeric|unique:students,student_id,' . $this->student,
                    'dob' => 'date',
                    'qualification' => 'numeric|between:0,5',
                    'level' => "integer|between:1,4",
                    'qualification_year' => 'digits:4|integer|min:2000|max:'.(date('Y')+1),
                    'secondry_grade' => 'numeric',

                    'gender' => 'boolean',
                    'status' => 'boolean',
                    'nationality' => 'boolean',
                    'national_id' => 'numeric|unique:students,national_id,' . $this->student,
                    'student_number' => 'numeric|unique:students,student_number,' . $this->student,
                    'university_email' => 'email:rfc,dns|unique:students,university_email,' . $this->student,
                    'img' => 'image|mimes:jpeg,jpg,png,gif|max:10000',

                    'father_name' => 'string',
                    'mother_name' => 'string',
                    'father_job' => 'string',
                    'mother_job' => 'string',
                    'Address' => 'string',
                    'governorate' => 'between:1,27',

                    'military_status' => 'integer|between:1,3',
                    'military_reason' => 'string|nullable',
                    'military_date' => 'date|nullable',
                    'military_number' => 'numeric|nullable',
                    'military_education' => 'boolean',
                ];
                break;
            default:
                $default = [];
                break;
        }

        return $default;
    }

    protected function prepareForValidation() {
        $this->checkValidation($this, [], 'student');
    }

    // prepare before validation
    function checkValidation($request, $data = ['data'], $key = null) {
        $input = $request->all();
        $request_methods = collect([
            'GET','DELETE','PUT','PATCH'
        ]); // set request id in the request body
        if ($request_methods->contains($request->getMethod()) && $key) {
            $input[$key] = request($key);
        }// check  for json fields to transfer it's format to array format
        foreach ($data as $json_data) {
            if (isset($input[$json_data]) && is_string($input[$json_data])) {
                $input[$json_data] = json_decode($input[$json_data], true); }
        }
        $request->replace($input);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
