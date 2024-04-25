<?php

namespace App\Usecases\Insured;

use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use App\Models\Insured;

class Store
{
    private const NAME_HEADER = '名前';
    private const EMAIL_HEADER = 'メールアドレス';
    private const NUMBER_HEADER = '番号';

    public function __invoke($csvFile)
    {
        try {
            $spreadsheet = $this->loadSpreadsheet($csvFile);
        } catch (\Exception $e) {
            Log::error("Failed to load spreadsheet: " . $e->getMessage());
            return false;
        }

        $worksheet = $spreadsheet->getActiveSheet();
        $headers = $this->extractHeaders($worksheet);

        $this->processRows($worksheet, $headers);

        return true;
    }

    private function loadSpreadsheet($csvFile)
    {
        $reader = new Csv();
        $reader->setEnclosure('"');
        $reader->setDelimiter(',');
        $reader->setSheetIndex(0);
        return $reader->load($csvFile);
    }

    private function extractHeaders($worksheet)
    {
        $headerRow = $worksheet->getRowIterator(1)->current();
        $cellIterator = $headerRow->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);

        $headers = [];
        foreach ($cellIterator as $cell) {
            $headers[$cell->getValue()] = $cell->getColumn();
        }
        return $headers;
    }

    private function processRows($worksheet, $headers)
    {
        $nameColumn = $headers[self::NAME_HEADER] ?? null;
        $emailColumn = $headers[self::EMAIL_HEADER] ?? null;
        $numberColumn = $headers[self::NUMBER_HEADER] ?? null;

        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();
            $name = $email = $number = null;

            if ($nameColumn) $name = $worksheet->getCell($nameColumn . $rowIndex)->getValue();
            if ($emailColumn) $email = $worksheet->getCell($emailColumn . $rowIndex)->getValue();
            if ($numberColumn) $number = $worksheet->getCell($numberColumn . $rowIndex)->getValue();

            Log::info("Extracted data - Name: $name, Email: $email, Number: $number");

            $insured = new Insured([
                'name' => $name,
                'email' => $email,
                'insurance_card_number' => $number,
            ]);
            $insured->save();
        }
    }
}
