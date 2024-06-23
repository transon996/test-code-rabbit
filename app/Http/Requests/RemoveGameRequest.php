<?php

namespace App\Http\Requests;

use App\Models\Game;
use Illuminate\Foundation\Http\FormRequest;

class RemoveGameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $game = Game::find($this->route('game'));
        return $game && $game->admin_id === authAdminId();
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
