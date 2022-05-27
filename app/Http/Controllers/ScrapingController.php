<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ScrapingController extends Controller
{
    public function example(Client $client){

        $crawler = $client->request('GET', 'https://www.computrabajo.com.pe/empleos-en-arequipa');
        //dd($crawler);
        
        $crawler->filter('#offersGridOfferContainer article.box_offer')->each(function (Crawler $offer) {
            $h2 = $offer->filter('h1 a');
            //$h2 = $offer->first('a.js-o-link fc_base');
            $title = $h2->text()."<br><br>";
            $url = $h2->filter('a')->first()->attr('href');
            //dd($h2);
            $companyFilter = $offer->filter('p a');
            
            if ($companyFilter->count()>0){
                $company = $companyFilter->text();
            }else{
                $company ='Sin Empresa';
            }
            
            $valoration = $h2->children('span')->eq("position:1");
           /*
            if ($valoration->count()>0){
                $valor = $valoration->text();
            }else{
                $valor ='Sin sss';
            }

            //print $valoration.'<br><br>';
            print $valoration->filter('')->text();
            */
            print $valoration."<br><br>";
        });
    }
}
