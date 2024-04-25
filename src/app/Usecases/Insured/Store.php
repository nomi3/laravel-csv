<?php

namespace App\Usecases\Insured;

use App\Models\Insured;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class Store
{
    private const NAME_HEADER = '漢字氏名';

    private const LAST_NAME_KANA_HEADER = 'カナ（姓）';

    private const FIRST_NAME_KANA_HEADER = 'カナ（名）';

    private const EMAIL_HEADER = 'メールアドレス';

    private const NUMBER_HEADER = '保険証番号';

    private const SYMBOL_HEADER = '保険証記号';

    public function __invoke($csvFile)
    {
        try {
            $spreadsheet = $this->loadSpreadsheet($csvFile);
        } catch (\Exception $e) {
            Log::error('Failed to load spreadsheet: '.$e->getMessage());

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
        $lastNameKanaColumn = $headers[self::LAST_NAME_KANA_HEADER] ?? null;
        $firstNameKanaColumn = $headers[self::FIRST_NAME_KANA_HEADER] ?? null;
        $emailColumn = $headers[self::EMAIL_HEADER] ?? null;
        $numberColumn = $headers[self::NUMBER_HEADER] ?? null;
        $symbolColumn = $headers[self::SYMBOL_HEADER] ?? null;

        foreach ($worksheet->getRowIterator(2) as $row) {
            $rowIndex = $row->getRowIndex();
            $name = $email = $number = $lastNameKana = $firstNameKana = $symbol = null;

            if ($nameColumn) {
                $name = $worksheet->getCell($nameColumn.$rowIndex)->getValue();
            }
            if ($lastNameKanaColumn) {
                $lastNameKana = $worksheet->getCell($lastNameKanaColumn.$rowIndex)->getValue();
            }
            if ($firstNameKanaColumn) {
                $firstNameKana = $worksheet->getCell($firstNameKanaColumn.$rowIndex)->getValue();
            }
            if ($symbolColumn) {
                $symbol = $worksheet->getCell($symbolColumn.$rowIndex)->getValue();
            }
            if ($emailColumn) {
                $email = $worksheet->getCell($emailColumn.$rowIndex)->getValue();
            }
            if ($numberColumn) {
                $number = $worksheet->getCell($numberColumn.$rowIndex)->getValue();
            }

            Log::info("Extracted data - Name: $name, Email: $email, Number: $number");

            $insured = new Insured([
                'name' => $name,
                'first_name_kana' => $firstNameKana,
                'last_name_kana' => $lastNameKana,
                'email' => $email,
                'insurance_card_number' => $number,
                'insurance_card_symbol' => $symbol,
            ]);
            $insured->save();
        }
    }
}
