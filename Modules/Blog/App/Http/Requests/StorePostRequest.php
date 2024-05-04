<?php

namespace Modules\Blog\App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|min:10",
            "content" => "required|min:20",
            "category_id" => "required|exists:post_categories,id",
            "stream_url" => "nullable|url",
            "related_post_id" => "nullable|exists:posts,id",
            "published_at" => "nullable",
            "time_to_read" => "nullable",
            "disable_comment" => "sometimes|in:on",
            "image_url" => "required",
            "video_url" => "nullable"
        ];
    }
}





