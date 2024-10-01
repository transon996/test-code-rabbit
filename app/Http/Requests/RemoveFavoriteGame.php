<?php

namespace App\Http\Requests;

use App\Models\FavoriteGame;
use Illuminate\Foundation\Http\FormRequest;

class RemoveFavoriteGame extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $favoriteGame = FavoriteGame::find($this->route('id'));
        return $favoriteGame && authUserId() === $favoriteGame->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
