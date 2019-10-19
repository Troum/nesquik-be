<?php

namespace App\Http\Controllers;

use App\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class ResultController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function result(Request $request)
    {
        if (isset(json_decode($request->get('array')[0])->prize)) {
            $result = Result::create([
                'title' => $request->resultDate
            ]);

            foreach ($request->get('array') as $item) {
                $result->winners()->create([
                    'name' => json_decode($item)->name,
                    'code' => json_decode($item)->code,
                    'game_code' => json_decode($item)->game_code,
                    'prize' => json_decode($item)->prize
                ]);
            }

            return response()->json(['success' => 'Розыгрыш успешно добавлен'], Response::HTTP_OK);
        }

        return response()->json(['error' => 'Проверьте, добавлен ли приз каждому победителю'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @return JsonResponse
     */
    public function results()
    {
        $results = Result::with('winners')->get();
        return response()->json(['results' => $results], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteResult(Request $request)
    {
        $result = Result::whereId($request->id)->firstOrFail();
        $result->delete();
        return $this->results();
    }
}
