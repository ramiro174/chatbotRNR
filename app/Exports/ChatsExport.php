<?php

namespace App\Exports;

use App\Models\Chat;
use Illuminate\Support\Collection as SupportCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChatsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Return all chat rows.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Chat::all();
    }

    /**
     * Build the headings row based on the Chat model's fillable + id/timestamps.
     * @return array
     */
    public function headings(): array
    {
        // Get model columns we want to export: id, fillable fields, timestamps
        /** @var Chat $model */
        $model = new Chat();
        $fillable = $model->getFillable();

        // Ensure stable order: id first, then fillable fields, then timestamps
        return array_values(array_merge(['id'], $fillable, ['created_at', 'updated_at']));
    }

    /**
     * Map each Chat instance to an array that matches headings order.
     * @param Chat $chat
     * @return array
     */
    public function map($chat): array
    {
        $model = new Chat();
        $fillable = $model->getFillable();

        $row = [];
        $row[] = $chat->id;
        foreach ($fillable as $key) {
            $row[] = $chat->{$key};
        }
        $row[] = $chat->created_at;
        $row[] = $chat->updated_at;

        return $row;
    }
}
