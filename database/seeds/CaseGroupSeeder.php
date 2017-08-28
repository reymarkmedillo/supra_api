<?php

use Illuminate\Database\Seeder;

class CaseGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('case_group')->insert([
        'case_id' => 1,
        'refno' => 'G.R. No. 176951',
        'title' => "LEAGUE OF CITIES OF THE PHILIPPINES (LCP), represented by LCP National President Jerry P. Treñas; City of Calbayog, represented by Mayor Mel Senen S. Sarmiento; and Jerry P. Treñas, in his personal capacity as Taxpayer, Petitioners, 
vs.
COMMISSION ON ELECTIONS; Municipality of Baybay, Province of Leyte; Municipality of Bogo, Province of Cebu; Municipality of Catbalogan, Province of Western Samar; Municipality of Tandag, Province of Surigao del Sur; Municipality of Borongan, Province of Eastern Samar; and Municipality of Tayabas, Province of Quezon, Respondents.",
        "created_at" => \Carbon\Carbon::now(),
        "updated_at" => \Carbon\Carbon::now()
      ]);
      DB::table('case_group')->insert([
        'case_id' => 1,
        'refno' => 'G.R. No. 178056',
        'title' => "LEAGUE OF CITIES OF THE PHILIPPINES (LCP), represented by LCP National President Jerry P. Treñas; City of Calbayog, represented by Mayor Mel Senen S. Sarmiento; and Jerry P. Treñas, in his personal capacity as Taxpayer, Petitioners, 
vs.
COMMISSION ON ELECTIONS; Municipality of Cabadbaran, Province of Agusan del Norte; Municipality of Carcar, Province of Cebu; Municipality of El Salvador, Province of Misamis Oriental; Municipality of Naga, Cebu; and Department of Budget and Management, Respondents.",
        "created_at" => \Carbon\Carbon::now(),
        "updated_at" => \Carbon\Carbon::now()
      ]);
    }
}
