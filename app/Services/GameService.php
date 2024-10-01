<?php

namespace App\Services;

use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Exception;

class GameService extends GeneralService
{
    public function create(array $data): array
    {
        data_set($data, 'image', $this->hanldeFileAndGetFileName(data_get($data, 'image'), GAME_DIR));
        data_set($data, 'admin_id', authAdminId());

        try {
            Game::create($data);

            return ['success' => true, 'message' => __('Game has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Game')];
        }
    }

    public function games()
    {
        return Game::all();
    }

    public function find(int $id)
    {
        return Game::find($id);
    }

    public function update(array $data, int $gameId)
    {
        try {
            data_set($data, 'admin_id', authAdminId());

            data_get($data, 'image') &&
            data_set($data, 'image', $this->hanldeFileAndGetFileName(data_get($data, 'image'), GAME_DIR));

            $game = Game::where('id', $gameId)->update($data);

            if (!$game) {
                return ['success' => false, 'message' => __('Game not found')];
            }

            return ['success' => true, 'message' => __('Game has been updated')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function delete(int $gameId): array
    {
        DB::beginTransaction();
        try {
            /** @var Game $game */
            $game = Game::find($gameId);

            if (!$game) {
                return ['success' => false, 'message' => __('Game not found')];
            }

            $game->posts()->delete();
            $game->favorite_games()->delete();
            $game->delete();
            DB::commit();
            return ['success' => true, 'message' => __('Game has been deleted')];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

}
