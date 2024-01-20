<div class="loader--hidden"></div>
<h1 class="searchTitle">Recherche de taxon</h1>
<div>
    <div id="filtre">
        <span>Filtre</span>
        <ul>
            <li>
                <input type="checkbox" id="marine_checkbox" name="marine_checkbox" value="marine_checkbox">
                <label for="marine">Marine</label>
            </li>
            <li>
                <input type="checkbox" id="animal_checkbox" name="animal_checkbox" value="animal_checkbox">
                <label for="animal">Animal</label>
            </li>
            <li>
                <input type="checkbox" id="bacterie_checkbox" name="bacterie_checkbox" value="bacterie_checkbox">
                <label for="bacterie">Bacterie</label>
            </li>
        </ul>
    </div>


    <div id="recherche_barre">
        <input type="text" name="taxaName" placeholder="Nom de taxon" id="taxaName" required>
        <input type="submit" value="Search" onclick="searchApi()">
    </div>
    <div id="resultats">
        <ul id="liste">
        </ul>
    </div>


<!--    --><?php
//        if (isset($taxaArrays)) {
//            echo '<div id="resultats">
//                        <ul id="liste">';
//            foreach ($taxaArrays as $taxa) {
//                $taxaId = $taxa->getId();
//                $taxaName = $taxa->getVernacularName();
//
//                // Get the image
//                $taxaMedia = $taxa->getLinks()['media']['href'];
//                $mediaContent = file_get_contents($taxaMedia);
//                $mediaData = json_decode($mediaContent, true);
//
//                // Check if the image is valid
//                if (!empty($mediaData['_embedded']['media'][0]['_links']['file']['href'])) {
//                    $taxonThumbnailUrl = $mediaData['_embedded']['media'][0]['_links']['file']['href'];
//                    $resultat['taxonMedia'] = $taxonThumbnailUrl;
//                    $image = $resultat['taxonMedia'];
//
//                    if(!@is_array(getimagesize($image))){
//                        $image = 'Orissa/../assets/img/taxaUnavailable.png';
//                    }
//                } else $image = 'Orissa/../assets/img/taxaUnavailable.png';
//                echo '
//                        <li>
//                            <div class="image">
//                                <a href="/Orissa/Taxa/' . $taxaId . '" class="imageLink">
//                                    <img src="' . $image . '" alt="image">
//                                </a>
//                            </div>
//
//                            <div class="caption">
//                                <p>' . $taxaName . '</p>
//                            </div>
//                        </li>';
//            }
//            echo '    </ul>
//                </div>';
//        }
//    ?>
</div>