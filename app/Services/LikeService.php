<?php


namespace App\Services;


use App\Models\Like;
use Exception;

class LikeService
{
    public function create(array $data): array
    {
        try {
            Like::create([
                'user_id' => authUserId(),
                'post_id' => $data['post_id'],
            ]);
            return ['success' => true, 'message' => __('Like has been created')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to create Like')];
        }
    }

    public function remove(int $post_id): array
    {
        try {
            $result = Like::where([['user_id', authUserId()], ['post_id', $post_id]])->delete();

            if (!$result) {
                return ['success' => false, 'message' => __('Like is not found')];
            }

            return ['success' => true, 'message' => __('Like has been removed')];
        } catch (Exception $e) {
            return ['success' => false, 'message' => __('Failed to remove Like')];
        }
    }
}
