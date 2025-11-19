<?php

namespace App\Http\Controllers;

use App\Models\ReadMore;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ReadMoreController extends BaseController
{
    /**
     * Fetch ReadMore content data by ID
     *
     * @param int $id Content ID
     * @return JsonResponse
     */
    public function getContentById($id): JsonResponse
    {
        try {
            $contentData = ReadMore::getContentData($id);

            if (!$contentData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Content not found or not published'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $contentData
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch multiple ReadMore contents by IDs (batch request)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContentBatch(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'integer|min:1'
            ]);

            $contentIds = $validated['ids'];

            if (empty($contentIds)) {
                return response()->json([
                    'success' => true,
                    'data' => []
                ]);
            }

            // Get multiple content data
            $contentData = ReadMore::getMultipleContentData($contentIds);

            // Convert to array format
            $results = array_values($contentData->toArray());

            return response()->json([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request data',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get ReadMore content list by section (for TinyMCE modal)
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getContentBySection(Request $request): JsonResponse
    {
        try {
            $sectionId = $request->get('section_id');
            $search = $request->get('search', '');

            $query = ReadMore::with([
                    'content' => function ($q) {
                        $q->select(['id', 'title', 'summary', 'created_at', 'category_id'])
                            ->with([
                                'media' => function ($q) {
                                    $q->wherePivot('type', 'main');
                                },
                                'category'
                            ]);
                    }
                ])
                ->active()
                ->ordered();

            // Filter by section if provided
            if ($sectionId) {
                $query->bySection($sectionId);
            }

            // Apply search filter
            if (!empty($search)) {
                $query->whereHas('content', function ($q) use ($search) {
                    $q->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('summary', 'LIKE', '%' . $search . '%');
                });
            }

            $readMores = $query->limit(50)->get();

            $results = $readMores->map(function ($readMore) {
                if (!$readMore->content) {
                    return null;
                }

                $content = $readMore->content;
                $contentData = ReadMore::getContentData($content->id);

                return $contentData;
            })->filter()->values();

            return response()->json([
                'success' => true,
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching content: ' . $e->getMessage()
            ], 500);
        }
    }
}
