<?php

//Testando escopo local

$teste1 = "Kaique";

function funcao()
{

    $teste2 = "Ribeiro";
    echo "$teste2 <br>";
};

echo "<br>";
echo "$teste1";
echo "<br>";
funcao();

echo "------------------------";
echo "<br>";

$teste2 = "marques";

echo $teste2;
echo "<br>";
funcao();
