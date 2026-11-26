/**
 * Web OS Arcade Engine — Neon Snake & Cyber Brick Breaker
 * Responsive Canvas + Keyboard + Mouse/Touch Controls + LocalStorage High Scores
 */
(function () {
    'use strict';

    const switchBtns = document.querySelectorAll('.arcade-game-tab');
    const scoreEl = document.getElementById('arcade-score');
    const bestEl = document.getElementById('arcade-best');
    const livesEl = document.getElementById('arcade-lives');
    const statusEl = document.getElementById('arcade-status');
    const startBtn = document.getElementById('arcade-start-btn');
    const pauseBtn = document.getElementById('arcade-pause-btn');
    const restartBtn = document.getElementById('arcade-restart-btn');
    const canvas = document.getElementById('arcade-canvas');
    const dpadBtns = document.querySelectorAll('.arcade-dpad-btn');

    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const W = canvas.width;
    const H = canvas.height;

    let activeGame = 'snake'; // 'snake' | 'breaker'
    let running = false;
    let paused = false;
    let rafId = null;

    function getBest(key) {
        try { return parseInt(localStorage.getItem('os_arcade_best_' + key) || '0', 10) || 0; }
        catch (e) { return 0; }
    }
    function setBest(key, val) {
        try { localStorage.setItem('os_arcade_best_' + key, String(val)); } catch (e) {}
    }

    function updateHud(score, best, livesText, statusText) {
        if (scoreEl) scoreEl.textContent = String(score);
        if (bestEl) bestEl.textContent = String(best);
        if (livesEl) livesEl.textContent = livesText;
        if (statusEl && statusText !== undefined) statusEl.textContent = statusText;
    }

    // ============================================================
    // GAME 1: NEON SNAKE
    // ============================================================
    const GRID = 20;
    const COLS = Math.floor(W / GRID);
    const ROWS = Math.floor(H / GRID);

    let snake = [];
    let dir = { x: 1, y: 0 };
    let nextDir = { x: 1, y: 0 };
    let food = { x: 10, y: 8 };
    let snakeScore = 0;
    let lastSnakeTick = 0;
    let snakeSpeed = 125;

    function initSnake() {
        snake = [
            { x: 8, y: 9 },
            { x: 7, y: 9 },
            { x: 6, y: 9 }
        ];
        dir = { x: 1, y: 0 };
        nextDir = { x: 1, y: 0 };
        snakeScore = 0;
        snakeSpeed = 125;
        spawnFood();
        updateHud(0, getBest('snake'), '1', 'Ready — Press Start or Arrow Keys');
        drawSnake();
    }

    function spawnFood() {
        let fx, fy, collision;
        do {
            fx = Math.floor(Math.random() * COLS);
            fy = Math.floor(Math.random() * ROWS);
            collision = snake.some(s => s.x === fx && s.y === fy);
        } while (collision);
        food = { x: fx, y: fy };
    }

    function setSnakeDirection(nx, ny) {
        if (nx !== 0 && dir.x === -nx) return;
        if (ny !== 0 && dir.y === -ny) return;
        nextDir = { x: nx, y: ny };
    }

    function stepSnake(ts) {
        if (!running || paused) return;
        if (ts - lastSnakeTick >= snakeSpeed) {
            lastSnakeTick = ts;
            dir = nextDir;
            const head = { x: snake[0].x + dir.x, y: snake[0].y + dir.y };

            if (head.x < 0 || head.x >= COLS || head.y < 0 || head.y >= ROWS ||
                snake.some(s => s.x === head.x && s.y === head.y)) {
                running = false;
                const best = Math.max(snakeScore, getBest('snake'));
                setBest('snake', best);
                updateHud(snakeScore, best, '0', 'Game Over — Press Restart');
                drawSnake(true);
                return;
            }

            snake.unshift(head);
            if (head.x === food.x && head.y === food.y) {
                snakeScore += 10;
                snakeSpeed = Math.max(65, 125 - Math.floor(snakeScore / 30) * 8);
                const best = Math.max(snakeScore, getBest('snake'));
                setBest('snake', best);
                updateHud(snakeScore, best, '1', 'Playing');
                spawnFood();
            } else {
                snake.pop();
            }
            drawSnake();
        }
        rafId = requestAnimationFrame(stepSnake);
    }

    function drawSnake(isOver = false) {
        ctx.fillStyle = '#070a12';
        ctx.fillRect(0, 0, W, H);

        // Subtle grid
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.035)';
        ctx.lineWidth = 1;
        for (let x = 0; x <= W; x += GRID) {
            ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, H); ctx.stroke();
        }
        for (let y = 0; y <= H; y += GRID) {
            ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(W, y); ctx.stroke();
        }

        // Food
        ctx.save();
        ctx.fillStyle = '#f59e0b';
        ctx.shadowColor = '#f59e0b';
        ctx.shadowBlur = 12;
        ctx.beginPath();
        ctx.arc(food.x * GRID + GRID / 2, food.y * GRID + GRID / 2, GRID * 0.34, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();

        // Snake body
        snake.forEach((seg, idx) => {
            ctx.save();
            const isHead = idx === 0;
            ctx.fillStyle = isOver ? '#ef4444' : (isHead ? '#00f2fe' : '#0ea5e9');
            if (isHead) {
                ctx.shadowColor = isOver ? '#ef4444' : '#00f2fe';
                ctx.shadowBlur = 12;
            }
            ctx.beginPath();
            ctx.roundRect(seg.x * GRID + 2, seg.y * GRID + 2, GRID - 4, GRID - 4, 5);
            ctx.fill();
            ctx.restore();
        });
    }

    // ============================================================
    // GAME 2: CYBER BRICK BREAKER
    // ============================================================
    const PADDLE_W = 86;
    const PADDLE_H = 12;
    const BALL_R = 7;
    const BRICK_ROWS = 5;
    const BRICK_COLS = 8;
    const BRICK_PAD = 8;
    const BRICK_TOP = 38;
    const BRICK_LEFT = 18;
    const BRICK_W = Math.floor((W - BRICK_LEFT * 2 - BRICK_PAD * (BRICK_COLS - 1)) / BRICK_COLS);
    const BRICK_H = 18;
    const BRICK_COLORS = ['#00f2fe', '#38bdf8', '#818cf8', '#a855f7', '#f472b6'];

    let paddleX = (W - PADDLE_W) / 2;
    let ballX = W / 2;
    let ballY = H - 48;
    let ballDX = 3.2;
    let ballDY = -3.4;
    let bricks = [];
    let breakerScore = 0;
    let breakerLives = 3;
    let breakerLevel = 1;
    let keysDown = { left: false, right: false };

    function buildBricks() {
        bricks = [];
        for (let r = 0; r < BRICK_ROWS; r++) {
            for (let c = 0; c < BRICK_COLS; c++) {
                bricks.push({
                    x: BRICK_LEFT + c * (BRICK_W + BRICK_PAD),
                    y: BRICK_TOP + r * (BRICK_H + BRICK_PAD),
                    alive: true,
                    color: BRICK_COLORS[r % BRICK_COLORS.length]
                });
            }
        }
    }

    function resetBallAndPaddle() {
        paddleX = (W - PADDLE_W) / 2;
        ballX = W / 2;
        ballY = H - 48;
        const speedBoost = 1 + (breakerLevel - 1) * 0.12;
        ballDX = (Math.random() > 0.5 ? 3.2 : -3.2) * speedBoost;
        ballDY = -3.4 * speedBoost;
    }

    function initBreaker() {
        breakerScore = 0;
        breakerLives = 3;
        breakerLevel = 1;
        buildBricks();
        resetBallAndPaddle();
        updateHud(0, getBest('breaker'), String(breakerLives), 'Ready — Move Mouse / Touch / Arrows');
        drawBreaker();
    }

    function stepBreaker() {
        if (!running || paused) return;

        if (keysDown.left) paddleX = Math.max(0, paddleX - 6.5);
        if (keysDown.right) paddleX = Math.min(W - PADDLE_W, paddleX + 6.5);

        ballX += ballDX;
        ballY += ballDY;

        // Wall collisions
        if (ballX + BALL_R > W || ballX - BALL_R < 0) ballDX = -ballDX;
        if (ballY - BALL_R < 0) ballDY = -ballDY;

        // Paddle collision
        if (ballDY > 0 && ballY + BALL_R >= H - 24 && ballY - BALL_R <= H - 24 + PADDLE_H &&
            ballX >= paddleX - 4 && ballX <= paddleX + PADDLE_W + 4) {
            const hitPos = (ballX - (paddleX + PADDLE_W / 2)) / (PADDLE_W / 2);
            ballDX = hitPos * 4.8;
            ballDY = -Math.abs(ballDY);
        }

        // Bottom miss
        if (ballY - BALL_R > H) {
            breakerLives--;
            if (breakerLives <= 0) {
                running = false;
                const best = Math.max(breakerScore, getBest('breaker'));
                setBest('breaker', best);
                updateHud(breakerScore, best, '0', 'Game Over — Press Restart');
                drawBreaker();
                return;
            }
            resetBallAndPaddle();
            updateHud(breakerScore, getBest('breaker'), String(breakerLives), 'Playing — Level ' + breakerLevel);
        }

        // Brick collisions
        let remaining = 0;
        for (const b of bricks) {
            if (!b.alive) continue;
            remaining++;
            if (ballX + BALL_R > b.x && ballX - BALL_R < b.x + BRICK_W &&
                ballY + BALL_R > b.y && ballY - BALL_R < b.y + BRICK_H) {
                b.alive = false;
                remaining--;
                ballDY = -ballDY;
                breakerScore += 15;
                const best = Math.max(breakerScore, getBest('breaker'));
                setBest('breaker', best);
                updateHud(breakerScore, best, String(breakerLives), 'Level ' + breakerLevel);
                break;
            }
        }

        if (remaining === 0) {
            breakerLevel++;
            buildBricks();
            resetBallAndPaddle();
            updateHud(breakerScore, getBest('breaker'), String(breakerLives), 'Level ' + breakerLevel + '!');
        }

        drawBreaker();
        rafId = requestAnimationFrame(stepBreaker);
    }

    function drawBreaker() {
        ctx.fillStyle = '#070a12';
        ctx.fillRect(0, 0, W, H);

        // Bricks
        for (const b of bricks) {
            if (!b.alive) continue;
            ctx.save();
            ctx.fillStyle = b.color;
            ctx.shadowColor = b.color;
            ctx.shadowBlur = 6;
            ctx.beginPath();
            ctx.roundRect(b.x, b.y, BRICK_W, BRICK_H, 5);
            ctx.fill();
            ctx.restore();
        }

        // Paddle
        ctx.save();
        ctx.fillStyle = '#00f2fe';
        ctx.shadowColor = '#00f2fe';
        ctx.shadowBlur = 10;
        ctx.beginPath();
        ctx.roundRect(paddleX, H - 24, PADDLE_W, PADDLE_H, 6);
        ctx.fill();
        ctx.restore();

        // Ball
        ctx.save();
        ctx.fillStyle = '#ffffff';
        ctx.shadowColor = '#00f2fe';
        ctx.shadowBlur = 12;
        ctx.beginPath();
        ctx.arc(ballX, ballY, BALL_R, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
    }

    // ============================================================
    // SHARED ARCADE CONTROLS
    // ============================================================
    function stopLoop() {
        running = false;
        paused = false;
        if (rafId) cancelAnimationFrame(rafId);
        rafId = null;
    }

    function startGame() {
        if (running && !paused) return;
        if (paused) {
            paused = false;
            updateHud(activeGame === 'snake' ? snakeScore : breakerScore, getBest(activeGame), activeGame === 'snake' ? '1' : String(breakerLives), 'Playing');
            rafId = requestAnimationFrame(activeGame === 'snake' ? stepSnake : stepBreaker);
            return;
        }
        running = true;
        paused = false;
        if (activeGame === 'snake') {
            if (snake.length === 0 || (statusEl && statusEl.textContent.includes('Game Over'))) initSnake();
            updateHud(snakeScore, getBest('snake'), '1', 'Playing');
            lastSnakeTick = performance.now();
            rafId = requestAnimationFrame(stepSnake);
        } else {
            if (breakerLives <= 0) initBreaker();
            updateHud(breakerScore, getBest('breaker'), String(breakerLives), 'Level ' + breakerLevel);
            rafId = requestAnimationFrame(stepBreaker);
        }
    }

    function togglePause() {
        if (!running) return;
        paused = !paused;
        if (paused) {
            if (rafId) cancelAnimationFrame(rafId);
            if (statusEl) statusEl.textContent = 'Paused';
        } else {
            if (statusEl) statusEl.textContent = 'Playing';
            rafId = requestAnimationFrame(activeGame === 'snake' ? stepSnake : stepBreaker);
        }
    }

    function restartGame() {
        stopLoop();
        if (activeGame === 'snake') initSnake();
        else initBreaker();
        startGame();
    }

    switchBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const target = btn.getAttribute('data-game');
            if (!target || target === activeGame) return;
            stopLoop();
            activeGame = target;
            switchBtns.forEach(b => b.classList.toggle('active', b === btn));
            const dpadWrap = document.getElementById('arcade-dpad-wrap');
            if (dpadWrap) dpadWrap.style.display = (activeGame === 'snake') ? 'flex' : 'none';
            if (activeGame === 'snake') initSnake();
            else initBreaker();
        });
    });

    if (startBtn) startBtn.addEventListener('click', startGame);
    if (pauseBtn) pauseBtn.addEventListener('click', togglePause);
    if (restartBtn) restartBtn.addEventListener('click', restartGame);

    // Keyboard controls (only when Arcade panel is active)
    document.addEventListener('keydown', (e) => {
        const gamePanel = document.getElementById('panel-game');
        if (!gamePanel || !gamePanel.classList.contains('active')) return;
        if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', ' '].includes(e.key)) {
            if (document.activeElement && ['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
            e.preventDefault();
        }
        if (activeGame === 'snake') {
            if (e.key === 'ArrowUp' || e.key === 'w' || e.key === 'W') { setSnakeDirection(0, -1); if (!running) startGame(); }
            if (e.key === 'ArrowDown' || e.key === 's' || e.key === 'S') { setSnakeDirection(0, 1); if (!running) startGame(); }
            if (e.key === 'ArrowLeft' || e.key === 'a' || e.key === 'A') { setSnakeDirection(-1, 0); if (!running) startGame(); }
            if (e.key === 'ArrowRight' || e.key === 'd' || e.key === 'D') { setSnakeDirection(1, 0); if (!running) startGame(); }
        } else {
            if (e.key === 'ArrowLeft' || e.key === 'a' || e.key === 'A') keysDown.left = true;
            if (e.key === 'ArrowRight' || e.key === 'd' || e.key === 'D') keysDown.right = true;
        }
        if (e.key === ' ') togglePause();
    });

    document.addEventListener('keyup', (e) => {
        if (e.key === 'ArrowLeft' || e.key === 'a' || e.key === 'A') keysDown.left = false;
        if (e.key === 'ArrowRight' || e.key === 'd' || e.key === 'D') keysDown.right = false;
    });

    // D-pad touch controls for Snake
    dpadBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (activeGame !== 'snake') return;
            const d = btn.getAttribute('data-dir');
            if (d === 'up') setSnakeDirection(0, -1);
            if (d === 'down') setSnakeDirection(0, 1);
            if (d === 'left') setSnakeDirection(-1, 0);
            if (d === 'right') setSnakeDirection(1, 0);
            if (!running) startGame();
        });
    });

    // Pointer / Touch drag for Cyber Breaker paddle
    function movePaddleToClientX(clientX) {
        if (activeGame !== 'breaker') return;
        const rect = canvas.getBoundingClientRect();
        const scaleX = W / rect.width;
        const x = (clientX - rect.left) * scaleX - PADDLE_W / 2;
        paddleX = Math.max(0, Math.min(W - PADDLE_W, x));
        if (!running) drawBreaker();
    }

    canvas.addEventListener('mousemove', (e) => movePaddleToClientX(e.clientX));
    canvas.addEventListener('touchmove', (e) => {
        if (activeGame === 'breaker' && e.touches[0]) {
            e.preventDefault();
            movePaddleToClientX(e.touches[0].clientX);
        }
    }, { passive: false });

    // Initialize default game
    initSnake();
})();

