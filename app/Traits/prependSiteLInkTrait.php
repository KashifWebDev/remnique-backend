<?php

namespace App\Traits;

trait prependSiteLInkTrait
{
    /**
     * Prepend website link to each string in the JSON data.
     *
     * @param string $item
     * @return string
     */
    private function prependSiteLink(string $item): array
    {
        // Assuming your website link is stored in a variable
        $websiteLink = env('APP_URL');

        // Decode the JSON string into an array
        $jsonArray = json_decode($item, true);

        if ($jsonArray === null && json_last_error() !== JSON_ERROR_NONE) {
            // If decoding fails, force transform the data into JSON
            $jsonArray = [$item];
        }

        // Prepend the website link to each string in the array
        $transformedArray = array_map(function ($string) use ($websiteLink) {
            return $websiteLink . $string;
        }, $jsonArray);

        // Encode the transformed array back to JSON
        return $transformedArray;
    }
}
