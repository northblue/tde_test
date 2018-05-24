<?php

///Search top artists by country
function getTopArtistsByCountry($country=null,$limit = null, $page = null) {
    if($country!=null){
        $paramsString = "?method=geo.gettopartists&country=".$country;
        return processApiCall($paramsString, $limit, $page);
    } else{
        return false;
    }
}

/// Process API call and return result as json format
function processApiCall($paramsString, $limit = null, $page = null) {

    $apiUrl = "http://".API_BASE_URL.$paramsString."&api_key=".API_KEY."&format=".RESULT_FORMAT;
    if($limit){
        $apiUrl .= "&limit=".$limit;
    } else {
        $apiUrl .= "&limit=".LIMIT_PER_PAGE;
    }
    if($page){
        $apiUrl .= "&page=".$page;
    } else{
        $apiUrl .= "&page="."1";
    }
    //echo $apiUrl;
    //
    //  Initiate curl
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$apiUrl);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    
    return $result;
    // Will dump a beauty json :3
    //var_dump(json_decode($result, true));
}


function getImageByType($images,$type = SHOW_IMAGE_TYPE){
    foreach($images as $image){
        if($image["size"]==$type){
            return $image["#text"];
        }
    }
}

function getArtistPageUrl($name){

    $path = getServerPathinfo();
    return $path['dirname'].ARTIST_PAGE_URL."?name=".$name;
}

function getToptracksbyArtist($name){
    if($name!=null){
        $paramsString = "?method=artist.gettoptracks&artist=".$name;
        return processApiCall($paramsString);
    } else{
        return false;
    }
}

function getCountrySearchPageUrl($country,$limit,$page){
    $path = getServerPathinfo();
    return $path['dirname']."/index.php?"."country=".$country."&limit=".$limit."&page=".$page;
}
function getServerPathinfo(){
    $query = $_SERVER['PHP_SELF'];
    return pathinfo( $query );
}

function getRetSearchUrl(){
    $path = getServerPathinfo();
    return $path['dirname']."/index.php";
}