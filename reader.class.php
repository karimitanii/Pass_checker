<?php

class LatestInputReader {
    private $storage = "C:\\wamp64\\www\\las205proj\\pass.json";

    public function getLatestInput() {
        $storedData = $this->readJsonFile();

        if ($storedData !== null && !empty($storedData)) {
            // Get the latest input from the array
            $latestInput = end($storedData);

            return $latestInput;
        } else {
            return null; // No data or error reading the file
        }
    }

    private function readJsonFile() {
        if (file_exists($this->storage)) {
            $jsonContent = file_get_contents($this->storage);
            return json_decode($jsonContent, true);
        } else {
            return null; // File doesn't exist
        }
    }
}