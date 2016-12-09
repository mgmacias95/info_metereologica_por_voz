<?php
    function find_index($days_array, $element) {
        $my_index = 0;
        for ($i=0; $i < 7; $i++) { 
            if ($element == $days_array[$i]) {
                break;
            }
            $my_index++;
        }
        return my_index;
    }
    function get_day($today, $when) {
        // El usuario ha dicho un día relativo a hoy (hoy,mañana,pasado,al otro....)
        // también puede decir el lunes, el martes...
        $days_en = array("Mon","Tue","Wed","Thu","Fri","Sat","Sun");
        $days_sp = array("lunes","martes","miercoles","jueves","viernes","sabado","domingo");
        $today_index = find_index($days_en, $today);

        $code = 0;
        if ($when == "hoy") {
            $code = 0;
        } elseif ($when == "manana") {
            $code = 1;
        } elseif ($when == "pasado" || $when == "pasado manana") {
            $code = 2;
        } elseif ($when == "otro") {
            $code = 3;
        } else {
            $hoy_index = find_index($days_sp, $when);
            $aux_index = $today_index;
            while ($aux_index != $hoy_index) {
                $aux_index = ($aux_index)+1%7;
                $code++;
            }
        }

        return $code;
    }

    $cond_met = array("tornado","tropical tormenta","huracan","fuertes tormentas ","tormentas","nieve y lluvia","lluvia y granizo","nieve y granizo","llovizna","llovizna helada","lluvia helada","chubascos","chuvascos","copos de nieve","llovizna de nieve","viento y nieve","nieve","granizo","aguanieve","polvo","niebla","neblina","ahumado","borrascoso","viento","frio","nublado","mayormente nublado","mayormente nublado","parcialmente nublado","parcialmente nublado","despejado","soleado","despejado","despejado","lluvia y granizo","calor","tormentas aisladas","tormentas dispersas","tormentas dispersas","chubascos dispersos","fuertes nevadas","chubascos de nieve dispersos","fuertes nevadas","parcialmente nublado","tormentas","chubascos de nieve","tormentas aisladas","no disponible");

    $Ciudad = $_REQUEST["Ciudad"];
    $Cuando = $_REQUEST["Cuando"];
    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
    $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="('.$Ciudad.', spain)") and u="c"';
    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
    // Make call with cURL
    $session = curl_init($yql_query_url);
    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
    $yahooapi = curl_exec($session);
    // curl_close($session);
    // Convert JSON to PHP object
    $weather =  json_decode($yahooapi,true);
    // previsión metereológica para los próximos días
    $weather_resumen = $weather['query']['results']['channel']['item']['forecast'];
    // dependiendo del día elegido por el usuario, nos quedamos con uno u otro
    $weather_today = $weather_resumen[0]['day'];
    $index_weather = get_day($weather_today, $Cuando);
    $condition_index = $weather_resumen[$index_weather]['code'];
    $weather_condition = $cond_met[intval($condition_index)];

   
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<vxml version="2.1" xml:lang="es-ES">
    <form id="form_main">
        <block>
            <prompt>
                La prevision para <?php echo $Cuando ?> en <?php echo $Ciudad ?> es <?php echo $weather_condition ?>
                <break/>
            </prompt>
        </block>
    </form>
</vxml>
