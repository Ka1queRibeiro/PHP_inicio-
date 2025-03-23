<?php

if (12 < 5 || "João" === "João") {
    echo "Entrou na or 1";
} else {
    echo "não entrou na or 1 <br>";
}

echo "<br>";

if (1 > 5 || 1) {
    echo "Entrou na or 2";
} else {
    echo "não entrou na or 2 <br>";
}

echo "<br>";

if (20 === "20" && 51 >= 31) {
    echo "Entrou na or 3";
} else {
    echo "não entrou na or 3 ";
}
