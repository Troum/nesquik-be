<?php

namespace App\Http\Controllers;

use App\Imports\CodesImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\JsonResponse;

class CodesController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request)
    {
        $path = Storage::putFileAs('codes',
            $request->file('file'),
            'codes.' . $request->file('file')->getClientOriginalExtension());
        Excel::import( new CodesImport, $path);
        return response()->json(['success' => 'Коды успешно добавлены'], Response::HTTP_OK);
    }
}
