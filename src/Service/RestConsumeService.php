<?php
/**
 * This file is part of the SalesTool project.
 *
 * @copyright Copyright (c) 2019, BRAC IT SERVICES LIMITED <http://www.bracits.com>
 * @author Roni Kumar Saha <ronikumar.saha@bracits.com>
 */


namespace App\Service;


use Symfony\Component\HttpFoundation\Request;


class RestConsumeService
{

    const API_URL = 'https://rxnav.nlm.nih.gov/REST/interaction/interaction.json?rxcui=341248';
    /**
     * @param Request $request
     * @param array $options
     * @return array
     *
     */
    public function getInteractioResponseData(Request $request,  $options = [])
    {
        $response = file_get_contents(self::API_URL);
        $result = json_decode($response);
        return $result;
    }

}
