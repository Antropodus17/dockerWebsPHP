<?php

declare(strict_types=1);


/**
 * Class Mentions to print the mentions of the icons.
 */
class Mentions {

    /**
     * A inicilizate the print of the mentions
     * 
     */
    public function start(): void {
        $MentionsList = ["Entrada iconos creados por Ch.designer - Flaticon" => "https://www.flaticon.es/iconos-gratis/entrada"];
        $this->printMentions($MentionsList);
    }

    /**
     * Print the mentions in the footer of the icons.
     * @param array $array of mentions.
     */
    private function printMentions(array $array) {
        foreach ($array as $key => $value) {
            echo '<a href="' . $value . '" title="iniciar sesión iconos">' . $key . '</a>';
        }
    }
}
