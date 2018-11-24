<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use SimplePie;

class Feed extends Model
{
    public function feed($feedUrl)
    {
        $feeds = new SimplePie();
        $feeds->set_feed_url($feedUrl);    
        $feeds->enable_order_by_date(true);
       
        $feeds->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/cache');
        $feeds->init();

        return $feeds;
    }

    public function trataCaracteres($str) {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
        $str = preg_replace('/_+/', ' ', $str); // ideia do Bacco :)
        return $str;
    }

    public function removeArtigosEPreposicoes($string = "Testando remoção de artigos e preposições"){
        $expressao = strip_tags ($string);
         
        $palavrasSemPreposicao = str_ireplace ( array (
            " o ", " a ", " os ", " as ", " um ", " uma ", " uns ", " umas ", " ao ", " à ", " aos ", " às ",
            " de ", " do ", " da ", " dos ", " das ", " dum  ", " duma ", " duns ", " dumas ",
            " em ", " no ", " na ", " nos ", " nas ", " num  ", " numa ", " nuns ", " numas ", " por ", " pelo ", " pela ", " pelos ", " pelas "
        ), " ", $expressao ); 
         
        return $palavrasSemPreposicao; //Retorna array com palavras sem preposições ou artigos
    }
}
