<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use App\Models\Document;

class DocumentImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Document::updateOrCreate(
                ['nomD' => $row['nomD']], // Assurez-vous que le nom du champ correspond au nom de la colonne dans le fichier Excel
                [
                    'typeD' => $row['typeD'],
                    'idP' => $row['idP'],
                    'file_path' => $row['file_path'], // Cela peut être adapté selon vos besoins
                ]
            );
        }
    }
}
