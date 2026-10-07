<?php
/**
 * View: Arcade & Retro Games Hub
 */
?>
<div class="container py-4">
<section class="py-2" id="arcade-game-hub" aria-label="Developer Arcade and MiniCraft">
    <?php if ($adsEnabled): ?>
        <!-- Top Leaderboard Ad (728x90) -->
        <div class="my-3 text-center overflow-auto">
            <script type="text/javascript">
              atOptions = {
                'key' : 'eff49cbb9e486773112180b4e21c171d',
                'format' : 'iframe',
                'height' : 90,
                'width' : 728,
                'params' : {}
              };
            </script>
            <script type="text/javascript" src="https://www.highrevenueformat.com/eff49cbb9e486773112180b4e21c171d/invoke.js"></script>
        </div>
    <?php endif; ?>

    <!-- Header Title Banner -->
    <div class="cyber-card-frame p-4 p-md-5 mb-4 position-relative overflow-hidden">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 2;">
            <div>
                <span class="hud-mono-tag font-mono text-cyan mb-2 d-inline-block">
                    <i class="bi bi-controller me-1"></i> // DEVELOPER_ARCADE_NEXUS
                </span>
                <h1 class="h3 fw-bold text-white font-title mb-2">MiniCraft &amp; Interactive Simulations</h1>
                <p class="text-secondary leading-relaxed mb-0 font-body" style="max-width: 650px;">
                    Welcome to the developer canvas laboratory. Mine materials and build terrain in <strong>MiniCraft 2D</strong>, test reflexes in <strong>Pixel Snake</strong>, or train neural recall in <strong>Memory Matrix</strong>.
                </p>
            </div>
            
            <!-- Game Switcher Tabs -->
            <div class="d-flex flex-wrap gap-2" role="tablist" aria-label="Game Selection Tabs">
                <button class="cyber-btn cyber-btn-primary game-tab-btn active" data-game="minicraft">
                    <i class="bi bi-box-seam-fill text-warning me-1"></i> <span>MiniCraft 2D</span>
                </button>
                <button class="cyber-btn cyber-btn-glass game-tab-btn" data-game="snake">
                    <i class="bi bi-cpu-fill text-cyan me-1"></i> <span>Pixel Snake</span>
                </button>
                <button class="cyber-btn cyber-btn-glass game-tab-btn" data-game="memory">
                    <i class="bi bi-grid-3x3-gap-fill text-primary me-1"></i> <span>Memory Match</span>
                </button>
            </div>
        </div>
    </div>

    <?php if ($adsEnabled): ?>
        <!-- Arcade Sponsor Links Bar -->
        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
            <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="nav-btn-pill nav-btn-primary">
                <i class="bi bi-trophy-fill me-1.5"></i> <span>Claim Free Arcade Rewards 🎁</span>
            </a>
            <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="nav-btn-pill nav-btn-glass">
                <i class="bi bi-controller me-1.5 text-accent"></i> <span>Unlock Special Arcade Pass ⚡</span>
            </a>
        </div>
    <?php endif; ?>

    <!-- ============================================================ -->
    <!-- GAME 1: MINICRAFT 2D SANDBOX -->
    <!-- ============================================================ -->
    <div class="game-container-block active" id="game-minicraft">
        <div class="card bento-card p-3 p-md-4">
            
            <!-- MiniCraft Toolbar Header -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3 pb-3 border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-secondary small fw-bold text-uppercase font-mono">Blocks Mined:</span>
                        <span class="badge badge-tech font-mono" id="minicraft-score">0</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-secondary small fw-bold text-uppercase font-mono">Time:</span>
                        <span class="badge badge-tech font-mono" id="minicraft-tod">Day ☀️</span>
                    </div>
                </div>

                <!-- Hotbar Inventory Selector -->
                <div class="d-flex align-items-center gap-1.5 flex-wrap" id="minicraft-inventory">
                    <!-- Dynamic inventory slots rendered via JS -->
                </div>

                <!-- Controls & Actions -->
                <div class="d-flex align-items-center gap-2">
                    <button class="nav-btn-pill nav-btn-glass" id="btn-toggle-time" title="Toggle Day/Night" style="padding: 6px 12px; font-size: 0.72rem;">
                        <i class="bi bi-moon-stars-fill"></i>
                    </button>
                    <button class="nav-btn-pill nav-btn-secondary" id="btn-reset-world" title="Regenerate World" style="padding: 6px 14px; font-size: 0.72rem;">
                        <i class="bi bi-arrow-counterclockwise me-1"></i><span>Reset World</span>
                    </button>
                </div>
            </div>

            <!-- Canvas Viewport -->
            <div class="position-relative w-100 rounded-4 overflow-hidden shadow-inner bg-black d-flex justify-content-center align-items-center" style="min-height: 440px;">
                <canvas id="minicraft-canvas" width="800" height="440" class="w-100 h-100 d-block" style="touch-action: none; cursor: crosshair;"></canvas>

                <!-- Onscreen Controls Overlay for Mobile -->
                <div class="position-absolute bottom-0 start-0 end-0 p-3 d-md-none d-flex justify-content-between align-items-end pointer-events-none" style="z-index: 10;">
                    <!-- Left D-Pad -->
                    <div class="d-flex gap-2 pointer-events-auto">
                        <button class="nav-btn-pill nav-btn-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" id="m-btn-left" style="width: 44px; height: 44px;"><i class="bi bi-arrow-left"></i></button>
                        <button class="nav-btn-pill nav-btn-secondary rounded-circle p-0 d-flex align-items-center justify-content-center" id="m-btn-right" style="width: 44px; height: 44px;"><i class="bi bi-arrow-right"></i></button>
                    </div>
                    <!-- Right Jump & Mine -->
                    <div class="d-flex gap-2 pointer-events-auto">
                        <button class="nav-btn-pill nav-btn-primary rounded-circle p-0 d-flex align-items-center justify-content-center fw-bold" id="m-btn-jump" style="width: 48px; height: 48px; font-size: 0.7rem;">JUMP</button>
                        <button class="nav-btn-pill nav-btn-glass rounded-circle p-0 d-flex align-items-center justify-content-center fw-bold" id="m-btn-mine" style="width: 48px; height: 48px; font-size: 0.7rem;">MINE</button>
                    </div>
                </div>
            </div>

            <!-- Instructions Banner -->
            <div class="mt-3 p-3 bg-secondary-subtle rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-2 small text-secondary font-mono">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <span><kbd class="bg-dark text-white">A</kbd> / <kbd class="bg-dark text-white">D</kbd> or <kbd class="bg-dark text-white">←</kbd> <kbd class="bg-dark text-white">→</kbd> Move</span>
                    <span><kbd class="bg-dark text-white">W</kbd> or <kbd class="bg-dark text-white">SPACE</kbd> Jump</span>
                    <span><kbd class="bg-dark text-white">Left Click</kbd> Break Block</span>
                    <span><kbd class="bg-dark text-white">Right Click</kbd> / <kbd class="bg-dark text-white">Shift+Click</kbd> Place Block</span>
                    <span><kbd class="bg-dark text-white">1 - 6</kbd> Select Block</span>
                </div>
                <div class="fw-semibold text-accent"><i class="bi bi-lightbulb me-1"></i>Tip: Dig deep to discover rare Diamond Ore!</div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- GAME 2: RETRO PIXEL SNAKE -->
    <!-- ============================================================ -->
    <div class="game-container-block d-none" id="game-snake">
        <div class="card bento-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <h2 class="h5 fw-bold text-dark font-title mb-0">Retro Pixel Snake</h2>
                    <span class="badge badge-tech">Score: <span id="snake-score">0</span></span>
                    <span class="badge badge-location-light">Highscore: <span id="snake-highscore">0</span></span>
                </div>
                <button class="nav-btn-pill nav-btn-primary" id="btn-start-snake" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-play-fill me-1"></i><span>Start Game</span>
                </button>
            </div>

            <div class="position-relative w-100 rounded-4 overflow-hidden bg-dark d-flex justify-content-center align-items-center" style="min-height: 400px;">
                <canvas id="snake-canvas" width="600" height="400" class="d-block" style="max-width: 100%; height: auto;"></canvas>
                <div id="snake-overlay" class="position-absolute top-0 start-0 end-0 bottom-0 d-flex flex-column align-items-center justify-content-center bg-dark bg-opacity-75 text-white p-4 text-center">
                    <i class="bi bi-controller display-3 text-accent mb-2"></i>
                    <h3 class="fw-bold mb-2 font-title">Retro Arcade Snake</h3>
                    <p class="text-secondary small mb-3 font-body">Use Arrow keys or WASD to control the pixel snake and collect developer powerups!</p>
                    <button class="nav-btn-pill nav-btn-primary" onclick="startSnakeGame()"><span>PLAY NOW</span></button>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- GAME 3: CODE MEMORY MATCH -->
    <!-- ============================================================ -->
    <div class="game-container-block d-none" id="game-memory">
        <div class="card bento-card p-3 p-md-4">
            <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                    <h2 class="h5 fw-bold text-dark font-title mb-0">Tech Stack Memory Match</h2>
                    <span class="badge badge-tech">Moves: <span id="memory-moves">0</span></span>
                    <span class="badge badge-tech">Matches: <span id="memory-matches">0</span> / 6</span>
                </div>
                <button class="nav-btn-pill nav-btn-glass" id="btn-reset-memory" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-arrow-counterclockwise me-1"></i><span>Restart Match</span>
                </button>
            </div>

            <div class="row g-3 max-w-lg mx-auto py-3" id="memory-grid-container" style="max-width: 600px;">
                <!-- Renders 12 memory cards -->
            </div>
        </div>
    </div>

    <?php if ($adsEnabled): ?>
        <!-- Arcade Bottom Ads Container -->
        <div class="my-5 p-4 card bento-card text-center">
            <h3 class="h6 text-secondary font-title mb-4">Arcade Sponsors &amp; Advertisements</h3>
            
            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4 mb-4">
                <div>
                    <script async="async" data-cfasync="false" src="https://pl30967632.profitableratecpmnetwork.com/a006ed973d12be80f0e7a963ed44ffb7/invoke.js"></script>
                    <div id="container-a006ed973d12be80f0e7a963ed44ffb7"></div>
                </div>

                <div>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : '498c3786a2bea98f8854603be8642237',
                        'format' : 'iframe',
                        'height' : 250,
                        'width' : 300,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/498c3786a2bea98f8854603be8642237/invoke.js"></script>
                </div>

                <div>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : 'd24d3fbbafec999f2684aa0f086b83ae',
                        'format' : 'iframe',
                        'height' : 300,
                        'width' : 160,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/d24d3fbbafec999f2684aa0f086b83ae/invoke.js"></script>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Custom Arcade CSS & Interactive JS Scripts -->
<style>
.game-container-block.d-none { display: none !important; }
.minicraft-inv-slot {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    border: 2px solid var(--border-color);
    background: var(--bg-card);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s, border-color 0.2s;
    user-select: none;
}
.minicraft-inv-slot.active {
    border-color: var(--accent);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
}
.minicraft-inv-icon {
    width: 24px;
    height: 24px;
    border-radius: 4px;
}
.memory-card {
    aspect-ratio: 1 / 1;
    perspective: 1000px;
    cursor: pointer;
}
.memory-card-inner {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 16px;
}
.memory-card.flipped .memory-card-inner,
.memory-card.matched .memory-card-inner {
    transform: rotateY(180deg);
}
.memory-card-front, .memory-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    backface-visibility: hidden;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border-color);
}
.memory-card-front {
    background: var(--bg-card);
    color: var(--accent);
    font-size: 1.8rem;
}
.memory-card-back {
    background: #141724;
    color: #fff;
    transform: rotateY(180deg);
    font-size: 2rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab Switcher
    const tabBtns = document.querySelectorAll('.game-tab-btn');
    const gameBlocks = document.querySelectorAll('.game-container-block');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetGame = this.getAttribute('data-game');
            tabBtns.forEach(b => {
                b.classList.remove('nav-btn-primary', 'active');
                b.classList.add('nav-btn-secondary');
            });
            this.classList.remove('nav-btn-secondary');
            this.classList.add('nav-btn-primary', 'active');

            gameBlocks.forEach(block => {
                if (block.id === 'game-' + targetGame) {
                    block.classList.remove('d-none');
                } else {
                    block.classList.add('d-none');
                }
            });

            if (targetGame === 'snake' && !snakeRunning) {
                startSnakeGame();
            }
        });
    });

    // MiniCraft 2D Engine
    const canvas = document.getElementById('minicraft-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const scoreEl = document.getElementById('minicraft-score');
    const todEl = document.getElementById('minicraft-tod');

    const BLOCKS = { AIR: 0, GRASS: 1, DIRT: 2, STONE: 3, WOOD: 4, LEAVES: 5, DIAMOND: 6, BRICK: 7 };
    const BLOCK_COLORS = { 1: '#4CAF50', 2: '#795548', 3: '#607D8B', 4: '#8D6E63', 5: '#2E7D32', 6: '#00BCD4', 7: '#D32F2F' };
    const BLOCK_NAMES = { 1: 'Grass', 2: 'Dirt', 3: 'Stone', 4: 'Wood', 5: 'Leaves', 6: 'Diamond', 7: 'Brick' };
    const TILE_SIZE = 32, COLS = 50, ROWS = 30;
    let world = [], minedCount = 0, selectedBlock = BLOCKS.GRASS, isNight = false;

    const player = { x: 100, y: 100, width: 22, height: 38, vx: 0, vy: 0, speed: 4, jumpPower: -10, grounded: false };
    const keys = {};

    function playBeep(freq, duration) {
        try {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (!AudioCtx) return;
            const audioCtx = new AudioCtx();
            const osc = audioCtx.createOscillator();
            const gain = audioCtx.createGain();
            osc.type = 'square';
            osc.frequency.setValueAtTime(freq, audioCtx.currentTime);
            gain.gain.setValueAtTime(0.08, audioCtx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + duration);
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.start();
            osc.stop(audioCtx.currentTime + duration);
        } catch(e){}
    }

    function generateWorld() {
        world = Array(ROWS).fill(null).map(() => Array(COLS).fill(BLOCKS.AIR));
        const groundLevel = 14;
        for (let r = 0; r < ROWS; r++) {
            for (let c = 0; c < COLS; c++) {
                if (r === groundLevel) world[r][c] = BLOCKS.GRASS;
                else if (r > groundLevel && r <= groundLevel + 4) world[r][c] = BLOCKS.DIRT;
                else if (r > groundLevel + 4) {
                    world[r][c] = (r > groundLevel + 8 && Math.random() < 0.08) ? BLOCKS.DIAMOND : BLOCKS.STONE;
                }
            }
        }
        player.x = 200;
        player.y = (groundLevel - 3) * TILE_SIZE;
        player.vx = 0;
        player.vy = 0;
    }

    function renderInventory() {
        const invContainer = document.getElementById('minicraft-inventory');
        if (!invContainer) return;
        invContainer.innerHTML = '';
        [BLOCKS.GRASS, BLOCKS.DIRT, BLOCKS.STONE, BLOCKS.WOOD, BLOCKS.LEAVES, BLOCKS.DIAMOND, BLOCKS.BRICK].forEach(id => {
            const slot = document.createElement('div');
            slot.className = 'minicraft-inv-slot' + (selectedBlock === id ? ' active' : '');
            slot.title = BLOCK_NAMES[id];
            slot.innerHTML = `<div class="minicraft-inv-icon" style="background-color: ${BLOCK_COLORS[id]};"></div>`;
            slot.addEventListener('click', () => {
                selectedBlock = id;
                renderInventory();
                playBeep(440, 0.05);
            });
            invContainer.appendChild(slot);
        });
    }

    window.addEventListener('keydown', e => { keys[e.code] = true; });
    window.addEventListener('keyup', e => { keys[e.code] = false; });

    document.getElementById('btn-reset-world')?.addEventListener('click', () => {
        minedCount = 0;
        if (scoreEl) scoreEl.textContent = '0';
        generateWorld();
        playBeep(600, 0.15);
    });

    document.getElementById('btn-toggle-time')?.addEventListener('click', () => {
        isNight = !isNight;
        if (todEl) todEl.textContent = isNight ? 'Night 🌙' : 'Day ☀️';
        playBeep(350, 0.08);
    });

    function updatePhysics() {
        if (keys['KeyA'] || keys['ArrowLeft']) player.vx = -player.speed;
        else if (keys['KeyD'] || keys['ArrowRight']) player.vx = player.speed;
        else player.vx = 0;

        if ((keys['KeyW'] || keys['Space'] || keys['ArrowUp']) && player.grounded) {
            player.vy = player.jumpPower;
            player.grounded = false;
            playBeep(320, 0.08);
        }

        player.vy += 0.5;
        if (player.vy > 12) player.vy = 12;

        player.x += player.vx;
        handleCollision(true);

        player.y += player.vy;
        handleCollision(false);

        if (player.x < 0) player.x = 0;
        if (player.x > COLS * TILE_SIZE - player.width) player.x = COLS * TILE_SIZE - player.width;
        if (player.y > ROWS * TILE_SIZE) { player.x = 200; player.y = 100; player.vy = 0; }
    }

    function handleCollision(isX) {
        const startC = Math.floor(player.x / TILE_SIZE);
        const endC = Math.floor((player.x + player.width) / TILE_SIZE);
        const startR = Math.floor(player.y / TILE_SIZE);
        const endR = Math.floor((player.y + player.height) / TILE_SIZE);

        for (let r = startR; r <= endR; r++) {
            for (let c = startC; c <= endC; c++) {
                if (r >= 0 && r < ROWS && c >= 0 && c < COLS) {
                    if (world[r][c] !== BLOCKS.AIR) {
                        if (isX) {
                            if (player.vx > 0) player.x = c * TILE_SIZE - player.width;
                            else if (player.vx < 0) player.x = (c + 1) * TILE_SIZE;
                        } else {
                            if (player.vy > 0) {
                                player.y = r * TILE_SIZE - player.height;
                                player.vy = 0;
                                player.grounded = true;
                            } else if (player.vy < 0) {
                                player.y = (r + 1) * TILE_SIZE;
                                player.vy = 0;
                            }
                        }
                    }
                }
            }
        }
    }

    function renderGame() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.fillStyle = isNight ? '#0A0F1D' : '#87CEEB';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        for (let r = 0; r < ROWS; r++) {
            for (let c = 0; c < COLS; c++) {
                const bType = world[r][c];
                if (bType !== BLOCKS.AIR) {
                    ctx.fillStyle = BLOCK_COLORS[bType] || '#fff';
                    ctx.fillRect(c * TILE_SIZE, r * TILE_SIZE, TILE_SIZE, TILE_SIZE);
                }
            }
        }

        ctx.fillStyle = '#FF5722';
        ctx.fillRect(player.x, player.y + 12, player.width, 16);
        ctx.fillStyle = '#FFCC80';
        ctx.fillRect(player.x + 2, player.y, player.width - 4, 12);
        ctx.fillStyle = '#1565C0';
        ctx.fillRect(player.x + 2, player.y + 28, player.width - 4, 10);
    }

    function gameLoop() {
        updatePhysics();
        renderGame();
        requestAnimationFrame(gameLoop);
    }

    generateWorld();
    renderInventory();
    gameLoop();
});
</script>
</div>
