<?php

namespace App\Services;

use App\Models\User;

class UserService extends GeneralService
{

    public function find(int $id)
    {
        return User::find($id);
    }

    public function updateImg(array $data): array
    {
        try {
            $file = data_get($data, 'avatar');
            $filename = '';

            if ($file) {
                $filename = $file->getClientOriginalName();

                if (!file_exists(public_path(USER_DIR) . $filename)) {
                    $file->move(public_path(USER_DIR), $filename);
                }
            }

            data_set($data, 'avatar', $filename);

            $result = User::where('id', authUserId())->update($data);

            if (!$result) {
                return ['success' => false, 'message' => __('User not found')];
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }

    public function updateInfo(array $data): array
    {
        try {
            $result = User::where('id', authUserId())->update($data);

            if (!$result) {
                return ['success' => false, 'message' => __('User not found')];
            }

            return ['success' => true, 'message' => __('User has been updated')];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => __('Something went wrong')];
        }
    }
}
