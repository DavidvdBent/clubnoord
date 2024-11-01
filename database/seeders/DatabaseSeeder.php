<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Adress;
use App\Models\Family;
use App\Models\Member;
use App\Models\Boekjaar;
use App\Models\BookYear;
use App\Models\TypeMember;
use App\Models\Contributie;
use App\Models\Contribution;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Aanmaken van 3 basis type leden

        TypeMember::create([
            'id' => 1,
            'soort_lid' => 'geel',
            'korting' => '0',
            'omschrijving' => 'Heeft nog geen leden aangedragen'
        ]);   
        TypeMember::create([
            'id' => 2,
            'soort_lid' => 'Blauw',
            'korting' => '5',
            'omschrijving' => 'Heeft 1/3 leden aangedragen'
        ]);    
        TypeMember::create([
            'id' => 3,
            'soort_lid' => 'Groen',
            'korting' => '10',
            'omschrijving' => 'Heeft meer dan 3 leden aangedragen'
        ]);  

        // Aanmaken van een Adressen (via faker), koppelen aan nieuwe families en leden hier aan toe voegen

        Adress::factory(1)->create([
            'id' => 2
        ]);
        $family = Family::factory()->create([
            'fam_naam' => 'van muren',
            'adress_id' => '2'
        ]);

        Member::factory(5)->create([
            'family_id' => $family->id,

        ]);

        Adress::factory(1)->create([
            'id' => '1'
        ]);
        $family2 = Family::factory()->create([
            'fam_naam' => 'vander',
            'adress_id' => '1'
        ]);

        Member::factory(4)->create([
            'family_id' => $family2->id,
            'type_member_id' => '2'
        ]);

        Adress::factory(1)->create([
            'id' => 3
        ]);
        $family3 = Family::factory()->create([
            'fam_naam' => 'koper',
            'adress_id' => '3'
        ]);

        Member::factory(6)->create([
            'family_id' => $family3->id,

        ]);

        Adress::factory(1)->create([
            'id' => '4'
        ]);
        $family5 = Family::factory()->create([
            'fam_naam' => 'Grootte',
            'adress_id' => '4'
        ]);

        Member::factory(3)->create([
            'family_id' => $family5->id,
            'type_member_id' => '3'
        ]);

        // Aanmaken van de basiswaarden voor de boekjaren

        BookYear::create([
            'id' => 1,
            'boekjaar' => 2020,
            'basis_contributie' => 80
        ]);

        BookYear::create([
            'id' => 2,
            'boekjaar' => 2021,
            'basis_contributie' => 90
        ]);
        BookYear::create([
            'id' => 3,
            'boekjaar' => 2022,
            'basis_contributie' => 100
        ]);

        // Aanmaken van de basiswaarden voor de contributies gekoppeld aan laatste boekjaar

        Contribution::create([

            'leeftijd' => 'jeugd',
            'leeftijd_korting' => 50,
            'boekjaar_id' => 3
        ]);
        Contribution::create([
            'leeftijd' => 'aspirant',
            'leeftijd_korting' => 40,
            'boekjaar_id' => 3
        ]);


        Contribution::create([
            'leeftijd' => 'junior',
            'leeftijd_korting' => 25,
            'boekjaar_id' => 3
        ]);

        
        Contribution::create([
            'leeftijd' => 'senior',
            'leeftijd_korting' => 0,
            'boekjaar_id' => 3
        ]);

        Contribution::create([
            'leeftijd' => 'oudere',
            'leeftijd_korting' => 45,
            'boekjaar_id' => 3
        ]);

        // Aanmaken van de user (waarmee je inlogt)

        User::create([
            'name' => 'admin',
            'email' => 'info@admin.nl',
            'password' => 'admin01'
        ]);
    }
}
