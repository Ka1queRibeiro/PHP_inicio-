<?php
// Não há necessidade de código PHP específico para o jogo Snake, pois o PHP é apenas para estruturar a página.
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo Snake</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        canvas {
            border: 1px solid black;
            background-color: #000;
        }
    </style>
</head>

<body>
    <canvas id="gameCanvas" width="400" height="400"></canvas>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const box = 20;
        let snake = [{
            x: 9 * box,
            y: 10 * box
        }];
        let direction = "RIGHT";
        let food = spawnFood();
        let score = 0;

        // Evento para capturar as teclas pressionadas
        document.addEventListener('keydown', changeDirection);

        // Função que muda a direção da cobra com base na tecla pressionada
        function changeDirection(event) {
            if (event.keyCode == 37 && direction != "RIGHT") {
                direction = "LEFT";
            } else if (event.keyCode == 38 && direction != "DOWN") {
                direction = "UP";
            } else if (event.keyCode == 39 && direction != "LEFT") {
                direction = "RIGHT";
            } else if (event.keyCode == 40 && direction != "UP") {
                direction = "DOWN";
            }
        }

        // Função que gera a comida em uma posição aleatória
        function spawnFood() {
            let x = Math.floor(Math.random() * 20) * box;
            let y = Math.floor(Math.random() * 20) * box;
            return {
                x,
                y
            };
        }

        // Função para desenhar o jogo (cobra, comida e pontuação)
        function drawGame() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Desenha a cobra
            for (let i = 0; i < snake.length; i++) {
                ctx.fillStyle = (i === 0) ? "green" : "white";
                ctx.fillRect(snake[i].x, snake[i].y, box, box);
            }

            // Desenha a comida
            ctx.fillStyle = "red";
            ctx.fillRect(food.x, food.y, box, box);

            // Atualiza a posição da cobra
            let snakeX = snake[0].x;
            let snakeY = snake[0].y;

            if (direction == "LEFT") snakeX -= box;
            if (direction == "UP") snakeY -= box;
            if (direction == "RIGHT") snakeX += box;
            if (direction == "DOWN") snakeY += box;

            // Verifica se a cobra comeu a comida
            if (snakeX == food.x && snakeY == food.y) {
                food = spawnFood();
                score++;
            } else {
                snake.pop(); // Remove a cauda da cobra
            }

            // Cria a nova cabeça da cobra
            let newHead = {
                x: snakeX,
                y: snakeY
            };
            snake.unshift(newHead); // Adiciona a nova cabeça no início do array

            // Verifica se a cobra colidiu com as bordas ou com ela mesma
            if (snakeX < 0 || snakeX >= canvas.width || snakeY < 0 || snakeY >= canvas.height || collision(newHead, snake)) {
                clearInterval(game);
                alert("Game Over! Sua pontuação foi: " + score);
            }

            // Exibe a pontuação
            ctx.fillStyle = "white";
            ctx.font = "20px Arial";
            ctx.fillText("Score: " + score, 10, 20);
        }

        // Função que verifica se a cabeça da cobra colidiu com o corpo
        function collision(head, array) {
            for (let i = 0; i < array.length; i++) {
                if (head.x == array[i].x && head.y == array[i].y) {
                    return true;
                }
            }
            return false;
        }

        // Função para iniciar o jogo
        const game = setInterval(drawGame, 100); // Atualiza o jogo a cada 100ms
    </script>
</body>

</html>