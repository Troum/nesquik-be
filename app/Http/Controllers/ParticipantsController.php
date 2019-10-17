<?php

namespace App\Http\Controllers;

use App\Exports\ParticipantsExport;
use App\Participant;
use App\Traits\System;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ParticipantsController extends Controller
{
    use System;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function participate(Request $request)
    {
        if($this->check($request->code)) {
            $participant = new Participant();
            $participant->store($request);
            $participant->update([
                'game_code' => $this->generate($participant->id)
            ]);
            if($this->send($participant->name, $participant->game_code, $participant->email)) {
                return response()->json(['code' => $participant->game_code], Response::HTTP_OK);
            } else {
                return response()->json(
                    ['error' => 'Извините, произошла ошибка с отправкой Вам письма. Пожалуйста, запомните Ваш игровой код: ' . $participant->game_code], Response::HTTP_BAD_GATEWAY);
            }

        } else {
            return response()->json(['error' => 'Увы, но код уже используется'], Response::HTTP_CONFLICT);
        }

    }

    /**
     * @return JsonResponse
     */
    public function participants()
    {
        $participants = Participant::all();
        return response()->json(['participants' => $participants], Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function export(Request $request)
    {
         $from = Carbon::createFromTimeString($request->from)->subHours(3)->format('Y-m-d H:i:s');
         $to = Carbon::createFromTimeString($request->to)->subHours(3)->format('Y-m-d H:i:s');
         Excel::store(new ParticipantsExport($from, $to), 'export.xlsx');
         return response()->json(['export' => true], Response::HTTP_OK);
    }

    /**
     * @return mixed
     */
    public function getExported()
    {
        return Storage::download('export.xlsx');
    }
}
