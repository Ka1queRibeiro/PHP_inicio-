<?php

//Existe a possibilidade de alterar o escopo global em um escopo local  

$global = "kaique";
echo "$global";
echo "<br>";

function funcao()
{

    $local = "aqui";
    echo "<br>";
    echo "$local";
};

funcao();
echo "<br>";

$local = "Basfe";

function globalfuncao()
{

    global $local;
    echo "Testando o $local";
};

globalfuncao();

echo "<br>";

funcao();
