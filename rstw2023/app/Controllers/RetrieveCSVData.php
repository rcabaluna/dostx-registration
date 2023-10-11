<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\ParticipantsModel;

class RetrieveCSVData extends Controller
{

    public $participantsModel;

	public function __construct()
	{
		$this->participantsModel = new ParticipantsModel();
	}

    public function index()
    {
        
        $event = $this->request->getPost('event');
        switch ($event) {
            case 'opening-ceremony':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vREZuVelcydeCqglHohbS5Ru90xPoBM9_22b_hcPzX8U5uoVqNMY_5eJKa7c2oQJ_jlfowSzn8DNamu/pub?gid=1747048089&single=true&output=csv';
                break;
            case 'rstw-exhibits':
                break;
            case 'press-conference':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vQB1ve-AE89RTW8EqZjfk4dOpt2JXUyYAFnmRee3J2uqXzdsFYx5O76b4Z3Og6Zi9bKy0eGAHGiDJ3D/pub?gid=883616425&single=true&output=csv';
                break;
            case 'forum1':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSRfEnYrq9trkioRF62ycdLKVDza5iVCgjvlmt0XnpIpOcxjMIsaccz0yVRiw8ITOBWlNkXXCXQjgqo/pub?gid=979639657&single=true&output=csv';
                break;
            case 'forum2':
                break;
            case 'forum3':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSVICNwxp4xbLwFIgmroB28oaKlyKk58cenTw7al4e-oxXH0GKZcWW2fLq8Gcl-ePdcX6wux8qdUx2c/pub?gid=1279888415&single=true&output=csv';
                break;
            case 'forum4':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSi-ts14tw9_hXrX6D3eQClj8bdarDQ0Nz9WoV3wBXzx_FNi4NHMoSGyCR1vH3GgVn542t5AtKiIotW/pub?gid=403202641&single=true&output=csv';
                break;
            case 'forum5':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vR1EtkQcd5XcN-PJrnH1Z5tpRTzVa8HGczeuQ6ebKchXpJPZyIjko9uI_AJYG3nMBHaXQeAAQlJ5mV4/pub?gid=1527448287&single=true&output=csv';
                break;
            case 'forum6':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vQEgXL18uoGtDLG7-1OIRzPoJqWHaVKknlyRcaEMPV4X4ktlnOxpXBiVhd40tledae9x1xG5Druo_d6/pub?gid=2082189274&single=true&output=csv';
                break;
            case 'forum7':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vS53bVCyPuaEt7KALEN5zPazFn25MnTv5m7YTyAx6D3K5R3iGja9gnWHVhK3wKnhFN3MUt-JWPzfRLh/pub?gid=1933459944&single=true&output=csv';
                break;
            case 'forum8':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTERw2Hm2e2WWveP9zqoH4G09F9OvNFIGe-7G3k5y8MVmvn-vMtVGb1-tpbV0sLibJ5Nc9zsIcRGPgh/pub?gid=1030945315&single=true&output=csv';
                break;
            case 'forum9':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTEJnvcBPefMcsjBQwdT2Ukvutv8nUOU0zf928CFA2fkM_GiW9nB7c11P4Ije_w39hqgYDtDzsuVeNQ/pub?gid=753244036&single=true&output=csv';
                break;
            case 'closing-ceremony':
                $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vQ_f9dKD3bjB2WCnw42n8RX8QPgA7fvE9aX0rASHk_4WWvBlAIRqnXvi_7xmh8_pVAwjhWlzRvEaGzU/pub?gid=1881382401&single=true&output=csv';
                break;
            default:
                # code...
                break;
        }
        // Replace the URL below with the actual URL of the online CSV file.
        // $csvUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSRfEnYrq9trkioRF62ycdLKVDza5iVCgjvlmt0XnpIpOcxjMIsaccz0yVRiw8ITOBWlNkXXCXQjgqo/pub?gid=979639657&single=true&output=csv';

        
        $counter = 1;
        // // Fetch the CSV data from the URL.
        $csvData = file_get_contents($csvUrl);

        if ($csvData !== false) {
            // Split the CSV data into an array of rows.
            $rows = explode("\n", $csvData);

            // Initialize an empty array to store the parsed CSV data.
            // $parsedCsvData = [];
            
            foreach ($rows as $row) {
                // Parse each row into an array.
                if ($counter == 1) {
                    $counter+=1;
                }else{
                    $parsedCsvData = str_getcsv($row);

                    $param = array(
                        'lastname' => $parsedCsvData[2],
                        'firstname' => $parsedCsvData[3],
                        'middle_initial' => $parsedCsvData[4],
                        'suffix' => $parsedCsvData[5],
                        'event' => $event
                    );
                    
                    $check = $this->participantsModel->check_participant_data('tblparticipants',$param);
                    
                    if (!$check) {
                        $data = array(
                            'regnumber' => $this->participantsModel->get_doc_number('registration'),
                            'title' => $parsedCsvData[1],
                            'lastname' => $parsedCsvData[2],
                            'firstname' => $parsedCsvData[3],
                            'middle_initial' => $parsedCsvData[4],
                            'suffix' => $parsedCsvData[5],
                            'contactno' => $parsedCsvData[9],
                            'email' => $parsedCsvData[12],
                            'sex' => $parsedCsvData[10],
                            'agency_address' => $parsedCsvData[8],
                            'agency_name' => $parsedCsvData[7],
                            'privileges' => $parsedCsvData[11],
                            'position' => $parsedCsvData[6],
                            'event' => $event
                        );
                        $this->participantsModel->insert_data('tblparticipants',$data);
                    }
                }
                
            }

            echo "SYNCED";

        } else {
            echo 'Failed to fetch CSV data from the online source.';
        }
    }
}
