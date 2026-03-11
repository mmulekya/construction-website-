<?php

$question = strtolower($_POST['question']);

if(strpos($question,"foundation") !== false){

echo "A strong foundation usually uses reinforced concrete and should cure for at least 7 days.";

}

elseif(strpos($question,"roof") !== false){

echo "Roofing installation typically takes 1 to 2 weeks depending on the structure and materials.";

}

elseif(strpos($question,"cost") !== false){

echo "Construction cost depends on location, materials, and labor. Use our AI Cost Estimator for a more accurate estimate.";

}

elseif(strpos($question,"materials") !== false){

echo "Common construction materials include cement, steel reinforcement bars, bricks, sand, and aggregates.";

}

else{

echo "That is a great construction question. For detailed advice consult a professional constructor on this platform.";

}

?>