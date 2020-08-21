<?php

namespace Pkboom\GoogleSheets;

use Google_Service_Sheets;
use BadMethodCallException;
use Google_Service_Sheets_Spreadsheet;

class GoogleSheets
{
    public $service;

    public $spreadsheetId;

    public $range;

    public function __construct(Google_Service_Sheets $service)
    {
        $this->service = $service;
    }

    public function spreadsheetId($spreadsheetId)
    {
        $this->spreadsheetId = $spreadsheetId;

        return $this;
    }

    public function range($range)
    {
        $this->range = $range;

        return $this;
    }

    public function get()
    {
        return $this->service->spreadsheets_values->get(
            $this->spreadsheetId,
            $this->range
        )->getValues();
    }

    public function create($title)
    {
        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => $title,
            ],
        ]);

        return $this->service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId',
        ]);
    }

    public function __call($method, $parameters)
    {
        if (method_exists($this->service, $method)) {
            return call_user_func_array([$this->getService, $method], $parameters);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s()', $method));
    }
}
