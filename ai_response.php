
<?php

$question = strtolower($_POST['question']);

if(strpos($question,"foundation") !== false){
echo "Foundation construction usually takes 1–3 weeks depending on soil and building size.";
}

elseif(strpos($question,"roof") !== false){
echo "Common roofing materials include metal sheets, clay tiles, and concrete tiles.";
}

elseif(strpos($question,"cost") !== false){
echo "Construction cost depends on size, materials, and location. Use the AI Cost Estimator for accurate estimates.";
}

else{
echo "Please provide more details about your construction question.";
}

?>