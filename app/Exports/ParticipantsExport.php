<?php

namespace App\Exports;

use App\Participant;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromQuery, WithMapping, WithColumnFormatting, WithHeadings, ShouldAutoSize
{
    use Exportable;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return Participant::query()->where('created_at', '>=', $this->from)->where('created_at', '<=', $this->to);
    }

    /**
     * @param mixed $participant
     * @return array
     */
    public function map($participant): array
    {
        return [
            $participant->name,
            $participant->code,
            $participant->phone,
            $participant->email,
            $participant->address,
            $participant->game_code,
            Carbon::createFromFormat('Y-m-d H:i:s', $participant->created_at)->format('d/m/Y')
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => '+###(##)###-##-##'
        ];
    }

    public function headings(): array
    {
        return [
          'ФИО',
          'Код скретч-карты',
          'Номер телефона',
          'Адрес электронной почты',
          'Адрес проживания',
          'Игровой код',
          'Дата регистрации и получения кода',
        ];
    }
}
