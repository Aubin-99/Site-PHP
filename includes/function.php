<?php

function formatDate(string $data){
    return strftime('%d %b %Y à %R', strtotime($data));
}

function varDumping(...$args){
    echo '<div class="py-70">';
    foreach ($args as $arg){
        echo '<div class="bg-dark px-3 text-warning small"><pre>';
        var_dump($arg);
        echo '</div></pre>';
    }
    echo '</div>';
}
// Message d'erreur formulaire non valide
function display_errors($errorsArray, $filed){
    if(!isset($errorsArray[$filed])){
        return '';
    }

    $error = $errorsArray[$filed];

    return <<<HTML
    <div class="w-100"><small class="text-danger">$error</small> </div>
HTML;
}
// Sécurisation de données
function sanitize($data) {
    if(is_array($data)){
        foreach ($data as $k => $datun){
            if(is_array($datun)){
                sanitize($datun);
            }else{
                $data[$k] = htmlentities($datun);
            }

        }
        return $data;
     }
    return htmlentities($data);
}
//champ non vide tableau ou chaine
function not_empty($data){
    if(is_string($data) && (trim($data) == "" || empty($data))) return false;
    if(is_array($data)){
        foreach($data as $datun){
            if(is_array($datun)){
                not_empty($datun);
            }elseif (trim($datun) == "" || empty($datun)){
                return  false;
            }

        }
    }
    return true;
}
// Champ rempli lors de l'envoi

/**
 * @param array $tableData
 * @param string $field
 * @param string|null $databaseValue
 * @return string
 */
function get_data(array $tableData, string $field, ?string $databaseValue = null){

    if($databaseValue == null) return '';

    if(!isset($databaseValue) && !isset($field[$field])) return '';

    if(isset($databaseValue) && !isset($tableData[$field])) return htmlentities($databaseValue);


    return htmlentities($tableData[$field]);


}

/**
 * @param string $field
 * @param string $value
 * @return string|null
 */
function get_selected_value(string $field, string $value){
    if(!isset($_POST[$field])) return  null;
    if(is_array($_POST[$field])){
        foreach ($_POST[$field] as $item){
            if($item == $value){
                return 'selected';
            }
        }
    }elseif (is_string($_POST[$field]) && $_POST[$field]==$value){

        return 'selected';
    }


    return null;
}

/**
 * @param string $path
 */
function redirect_to(string $path){
    header('Location:'.$path);
    exit();
}

/**
 * @param string $field
 * @param int $min
 * @param int $max
 * @return bool
 */
function length_validation(string $field, int $min, int $max): bool{
    if(mb_strlen($field)<$min) return false;
    if(mb_strlen($field)>$max) return false;

    return true;
}