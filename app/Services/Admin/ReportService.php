<?php

namespace App\Services\Admin;

use App\Enums\StatusReportType;
use App\Models\Report;
use App\Services\PostService;
use Illuminate\Support\Facades\DB;
use Exception;

class ReportService
{
    public function update(array $arr): array
    {
        DB::beginTransaction();

        try {
            /** @var Report $report */
            $report = Report::find($arr['report_id']);

            if (!$report) {
                return ['success' => false, 'message' => __('Report is not found')];
            }

            $report->update([
                'status' => $arr['status'],
            ]);

            if ((int)data_get($arr, 'status', -99) === StatusReportType::ACCEPT) {
                $resultPost = (new PostService())->remove($report->post_id);

                if (!$resultPost) {
                    return ['success' => false, 'message' => __('Post is not found')];
                }
            }

            DB::commit();
            return ['success' => true, 'message' => __('Report has been created')];
        } catch (Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => __('Failed to create Report')];
        }
    }
}
