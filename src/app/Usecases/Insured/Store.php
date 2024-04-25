<?php

namespace App\Usecases\Insured;

use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Insured;

class Store
{
    public function __invoke($csvFile)
    {
        $reader = new Csv();
        $reader->setEnclosure('"');
        $reader->setDelimiter(',');
        $reader->setSheetIndex(0);

        $spreadsheet = $reader->load($csvFile);
        $worksheet = $spreadsheet->getActiveSheet();

        $headerRow = $worksheet->getRowIterator(1)->current();
        $cellIterator = $headerRow->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);

        $headers = [];
        foreach ($cellIterator as $cell) {
            $headers[$cell->getValue()] = $cell->getColumn();
        }

        $nameColumn = isset($headers['名前']) ? $headers['名前'] : null;
        $emailColumn = isset($headers['メールアドレス']) ? $headers['メールアドレス'] : null;
        $numberColumn = isset($headers['番号']) ? $headers['番号'] : null;

        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();

            $name = $email = $number = null;
            if ($nameColumn) $name = $worksheet->getCell($nameColumn . $rowIndex)->getValue();
            if ($emailColumn) $email = $worksheet->getCell($emailColumn . $rowIndex)->getValue();
            if ($numberColumn) $number = $worksheet->getCell($numberColumn . $rowIndex)->getValue();

            Log::info("Extracted data - Name: $name, Email: $email, Number: $number");
            $insured = new Insured();
            $insured->name = $name;
            $insured->email = $email;
            $insured->insurance_card_number = $number;
            $insured->save();
        }

        return true;
    }
}
