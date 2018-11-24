<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model\Feed;

class FeedController extends Controller
{
    public function feed()
    {
        $urlFeed = "http://www.minutoseguros.com.br/blog/feed/";
        $objFeed = new \App\Model\Feed();
        $feeds = $objFeed->feed($urlFeed);

        for ($i=0; $i < count($feeds->get_items()); $i++) {
            $texto = $feeds->get_items()[$i]->get_description();
            $texto = strip_tags($texto); 
            
            $titulos[$i] = $feeds->get_items()[$i]->get_title();

            $conteudo2[$i] = $texto;
            $texto = $objFeed->removeArtigosEPreposicoes($texto);
             
            $texto = $objFeed->trataCaracteres($texto);
            
            $conteudo[$i] =  $paravrasPorTopico[$i] = array_count_values(str_word_count($texto, 1));  

            $word = array_where(array_count_values(str_word_count($texto, 1)), function($value, $key) use ($texto)
            {
                return $value === max(array_count_values(str_word_count($texto, 1))); 
            });

            $palavras[$i] = "";
            $quantidade[$i] = 0;
            foreach ($word as  $key => $item ) {                
                $palavras[$i] = $key;
                $quantidade[$i] = $item;
                back();
            }           
        }
        

        // dd(count($paravrasPorTopico[0]));
        // dd($palavra[0]);

        // dd(count($paravrasPorTopico[0]));
        return view('feeds', compact('palavras', 'quantidade', 'paravrasPorTopico', 'titulos'));
        
    }

    
}
 