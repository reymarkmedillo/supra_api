<?php

use Illuminate\Database\Seeder;

class CaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cases')->insert([
            'id' => 'G.R. No. 177499',
            'title'              => "LEAGUE OF CITIES OF THE PHILIPPINES (LCP), represented by LCP National President Jerry P. Treñas; City of Calbayog, represented by Mayor Mel Senen S. Sarmiento; and Jerry P. Treñas, in his personal capacity as Taxpayer, Petitioners, 
vs.
COMMISSION ON ELECTIONS; Municipality of Lamitan, Province of Basilan; Municipality of Tabuk, Province of Kalinga; Municipality of Bayugan, Province of Agusan del Sur; Municipality of Batac, Province of Ilocos Norte; Municipality of Mati, Province of Davao Oriental; and Municipality of Guihulngan, Province of Negros Oriental, Respondents.",
            'scra'             => "",
            'date' => '2011-04-11',
            'topic' => '',
            'syllabus' =>  "We consider and resolve the Ad Cautelam Motion for Reconsideration filed by the petitioners vis-à-vis the Resolution promulgated on February 15, 2011.

To recall, the Resolution promulgated on February 15, 2011 granted the Motion for Reconsideration of the respondents presented against the Resolution dated August 24, 2010, reversed the Resolution dated August 24, 2010, and declared the 16 Cityhood Laws — Republic Acts Nos. 9389, 9390, 9391, 9392, 9393, 9394, 9398, 9404, 9405, 9407, 9408, 9409, 9434, 9435, 9436, and 9491 — constitutional.

Now, the petitioners anchor their Ad Cautelam Motion for Reconsideration upon the primordial ground that the Court could no longer modify, alter, or amend its judgment declaring the Cityhood Laws unconstitutional due to such judgment having long become final and executory. They submit that the Cityhood Laws violated Section 6 and Section 10 of Article X of the Constitution, as well as the Equal Protection Clause.",
            "body" => "Upon thorough consideration, we deny the Ad Cautelam Motion for Reconsideration for its lack of merit.",
            "status" => "reinstated",
            "created_at" => \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now()
        ]);
    }
}
