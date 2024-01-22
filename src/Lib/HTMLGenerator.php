<?php

    namespace App\Code\Lib;

    class HTMLGenerator
    {
        public static function GenerateTaxaUnitHTML(int $taxaId) : string
        {
            return '
            <li>
                <div class="image">
                    <a id="' . $taxaId .'" href="/Orissa/Taxa/' . $taxaId . '" class="taxaLink">
                        <img class="taxaHref" src="Orissa/../assets/img/taxaUnavailable.png" alt="image">
                    </a>
                </div>
                <div class="caption">
                    <p class="taxaName"></p>
                </div>
            </li>';
        }

        public static function GenerateLibraryUnitHTML(int $libraryId, string $libraryTitle): string
        {
            return '
           <div class="libraryUnit">
                <div class="imageSpace" id="imageSpace">
                    <a href="Library/' . $libraryId . '" class="libraryLink">
                    <!-- 
                    <div class="backgroundLock">
                        <div class="boutonLock">
                            <div id="img"></div>
                        </div>
                    </div>  -->
                    </a>
                </div>
                <div class="name-library">
                    <span class="innerName">' . $libraryTitle . '</span>
                </div>
            </div>';
        }

        public static function GenerateRegisteredProfileHTML(int $taxaId): string
        {
            return '
           <div class="libraryUnit">
                <div class="imageSpace" id="imageSpace">
                    <a id="' . $taxaId . '" href="Taxa/' . $taxaId . '" class="libraryLink">
                    </a>
                </div>
                <div class="name-library" id="name-library">
                    <span class="innerName"></span>
                </div>
            </div>';
        }

        public static function GenerateInteractionTableRow(int $sourceId, string $sourceName,
                                                           string $relationId, string $relationName) : string
        {
            return "
            <tr>
                <td>$sourceId</td>
                <td>$sourceName</td>
                <td>$relationId</td>
                <td>$relationName</td>
            </tr>
            ";
        }

        public static function GenerateInteractionTable(array $interactions) : string
        {
            $tableRowsHTML = '';
            foreach ($interactions as $row) {
                $sourceTaxaId = $row['taxon']['id'];
                $sourceTaxaName = $row['taxon']['fullNameHtml'];
                $relationId = $row['relationId'];
                $relationName = $row['relationName'];
                $tableRowsHTML .= self::GenerateInteractionTableRow($sourceTaxaId, $sourceTaxaName,
                    $relationId, $relationName);
            }
            return
            '
            <div class="table-section">
                <h3>Relations</h3>
                <table>
                    <thead>
                    <tr>
                        <th>ID taxon</th>
                        <th>Nom taxon</th>
                        <th>ID de la relation</th>
                        <th>Nom de la relation</th>
                    </tr>
                    </thead>
                    <tbody>'
                    .
                    $tableRowsHTML
                    .
                    '</tbody>
                </table>
            </div>';
        }

        public static function GenerateRedListHTML($world, $europe, $national, $local): string
        {
            return "
                <h3>Status listes rouges </h3>
                <p>Liste rouge international : $world</p>
                <p>Liste rouge européenne : $europe</p>
                <p>Liste rouge nationale : $national</p>
                <p>Liste rouge locale : $local</p>   
            ";
        }
    }