<?php
    include '../elements/header.php'; 
    include '../helpers/general_functions.php'; 
    include '../config/config.php'; 

?>

<div class="result-container">
    <?php
    if($_REQUEST['name']){
        ?>
    <h1>Artist: <?php echo $_REQUEST['name'] ?></h1>
    <?php
        $result = json_decode(getToptracksbyArtist($_REQUEST['name']), true);
        $tracks = $result['toptracks']['track'];

        if(count($result)>0){
            foreach($tracks as $track){
        ?>
        <div class="track-container">
            <div class="track-thumbnail">
                <a href="<?php  echo $track['url'] ?>" target="new">
                    <div class="track-name">
                    <?php echo  $track['name']?>
                    </div>
                </a>
            </div>

        </div>
        <?php
            }
        } else {
            echo 'no search result';
        }
    }
    ?>
</div>

<?php 
    include '../elements/footer.php'; 
?>


