<?php 
    include '../elements/header.php'; 
    include '../helpers/general_functions.php'; 
    include '../config/config.php'; 

    
    $result = null;
    $formCountry = "";
    $limit = null;
    $page = null;
    
    if (!empty($_REQUEST['country'])){
        if (!empty($_REQUEST['limit'])){
            $limit =$_REQUEST['limit'];
        }
        if (!empty($_REQUEST['page'])){
            $page =$_REQUEST['page'];
        }    
        
        $result = json_decode(getTopArtistsByCountry($_REQUEST['country'],$limit,$page), true);
        $formCountry =$_REQUEST['country'];
    } 
    
?>
<a href="<?php echo getRetSearchUrl() ?>" class="reset-search-link">Reset Search</a>
<form action="" method="post" id="search-form">
    <table>
        <tr>
            <td>
                <label>Country</label><input type="text" name="country" value="<?php echo $formCountry ?>"/>
            </td>
            <td>
                <input type="submit" value="search" name="submit" />
            </td>
            
        </tr>
    </table>
    
</form>
<div class="result-container">
    <?php
    if($result){
        if(empty($result['error'])){
            $artists = $result['topartists']['artist'];
            
            ///This is a temporary fix for the wrong return search result from last.fm
            if(count($artists)>LIMIT_PER_PAGE){
                $artists = array_slice($artists, - LIMIT_PER_PAGE);
            }
            
            
            if(count($result)>0){
                foreach($artists as $artist){
            ?>
            <div class="artist-container">
                <div class="artist-thumbnail">
                    <a href="<?php  echo getArtistPageUrl($artist['name']) ?>" target="new"><img src="<?php echo getImageByType($artist['image']); ?>"/></a>
                </div>
                <div class="artist-name">
                <?php echo  $artist['name']?>
                </div>

            </div>
            <?php
                }
            } else {
                echo 'no search result';
            }
        } else{
            echo $result['message'];
        }

    }
    ?>
</div>
<div class="paging-container">
<?php
    if($result&&empty($result['error'])){
?>
    <a href="<?php echo getCountrySearchPageUrl($_REQUEST['country'], LIMIT_PER_PAGE, 1)  ?>"><< </a>
    <?php

    $courtPage = (int)$result['topartists']['@attr']['page'];
    $counterMin = $courtPage - PAGING_RANGE;
    $counterMax = $courtPage + PAGING_RANGE;
    
    for($i = $counterMin; $i<= $counterMax; $i++){
        $styleClass = "";
        if($i>0&&$i<=$counterMax){
            if($i==$courtPage){
                $styleClass = "active";
            }
    ?>
        <a href="<?php echo getCountrySearchPageUrl($_REQUEST['country'], LIMIT_PER_PAGE, $i)  ?>" class="<?php echo $styleClass; ?>"><?php echo $i ?> </a>
    <?php
        }
    }
    ?>
        <!-- Commented out the link for the last page because the bug from returning number of result
    <a href="<?php echo getCountrySearchPageUrl($_REQUEST['country'], LIMIT_PER_PAGE, (int)$result['topartists']['@attr']['totalPages']) ?>"> >></a>
        -->
    <?php
    }
    ?>
</div>

<?php 
    include '../elements/footer.php'; 
?>
