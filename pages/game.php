<?php
/**
 * Page: Arcade & Mini Games (MiniCraft 2D & Pixel Games)
 */
if (!defined('PAGE_DEPTH')) {
    define('PAGE_DEPTH', 1);
}

$pageTitle = "Developer Arcade & MiniCraft | Balamurugan P M";
$pageMetaDescription = "Play interactive HTML5 mini games including MiniCraft 2D Sandbox, Retro Snake, and Code Memory Match directly inside Balamurugan P M's portfolio arcade.";
$thisPage = "Arcade";

require_once __DIR__ . '/../config/bootstrap.php';

include BASE_PATH . 'templates/layout/head.php';
include BASE_PATH . 'templates/layout/body-start.php';
include BASE_PATH . 'templates/partials/navigation.php';
?>

<section class="py-2" id="arcade-game-hub" aria-label="Developer Arcade and MiniCraft">
    <?php if ($adsEnabled): ?>
        <!-- Background Scripts -->
        <script src="https://pl31286313.profitableratecpmnetwork.com/e2/a9/87/e2a98719b38240fb664d2d652dee4b37.js"></script>
        <script src="https://pl31286316.profitableratecpmnetwork.com/42/a7/fe/42a7fe54f131cdff87ac27996fb1a2dc.js"></script>

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
    <div class="card bento-card p-4 p-md-5 mb-4 position-relative overflow-hidden">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 2;">
            <div>
                <span class="badge bg-danger-subtle text-danger fw-semibold px-3 py-1.5 rounded-pill mb-2 d-inline-flex align-items-center gap-1.5" style="font-size: 0.82rem;">
                    <i class="bi bi-controller fs-6"></i> INTERACTIVE DEVELOPER ARCADE
                </span>
                <h1 class="h2 fw-bold text-dark font-title mb-2">MiniCraft &amp; Web Games Hub</h1>
                <p class="text-secondary leading-relaxed mb-0" style="max-width: 650px;">
                    Welcome to the developer playground! Mine blocks, build structures in <strong>MiniCraft 2D</strong>, test your reflexes in <strong>Retro Snake</strong>, or sharpen your mind with <strong>Memory Match</strong>.
                </p>
            </div>
            
            <!-- Game Switcher Tabs -->
            <div class="d-flex flex-wrap gap-2" role="tablist" aria-label="Game Selection Tabs">
                <button class="btn btn-dark rounded-pill px-3.5 py-2 fw-semibold d-inline-flex align-items-center gap-2 game-tab-btn active" data-game="minicraft">
                    <i class="bi bi-box-seam-fill text-warning"></i> MiniCraft 2D
                </button>
                <button class="btn btn-outline-secondary rounded-pill px-3.5 py-2 fw-semibold d-inline-flex align-items-center gap-2 game-tab-btn" data-game="snake">
                    <i class="bi bi-cpu-fill text-success"></i> Pixel Snake
                </button>
                <button class="btn btn-outline-secondary rounded-pill px-3.5 py-2 fw-semibold d-inline-flex align-items-center gap-2 game-tab-btn" data-game="memory">
                    <i class="bi bi-grid-3x3-gap-fill text-primary"></i> Memory Match
                </button>
            </div>
        </div>
    </div>

    <?php if ($adsEnabled): ?>
        <!-- Arcade Sponsor Links Bar -->
        <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
            <a href="https://www.profitableratecpmnetwork.com/fg8vsabw0?key=85a6a5fcd471608b17da62bbd4c415d5" target="_blank" rel="noopener noreferrer" class="btn btn-warning-custom btn-sm rounded-pill px-4 py-2 text-white fw-bold shadow-sm" style="background-color: var(--accent) !important;">
                <i class="bi bi-trophy-fill me-1.5"></i> Claim Free Arcade Bonus Rewards 🎁
            </a>
            <a href="https://www.profitableratecpmnetwork.com/zhzy181j?key=a985ed396e845a0439a1f428f29b755a" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm">
                <i class="bi bi-controller me-1.5 text-danger"></i> Unlock Special Arcade Pass ⚡
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
                        <span class="text-secondary small fw-bold text-uppercase">Blocks Mined:</span>
                        <span class="badge bg-primary rounded-pill px-2.5 py-1 fs-6" id="minicraft-score">0</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-secondary small fw-bold text-uppercase">Time:</span>
                        <span class="badge bg-dark rounded-pill px-2.5 py-1 small" id="minicraft-tod">Day ☀️</span>
                    </div>
                </div>

                <!-- Hotbar Inventory Selector -->
                <div class="d-flex align-items-center gap-1.5 flex-wrap" id="minicraft-inventory">
                    <!-- Dynamic inventory slots rendered via JS -->
                </div>

                <!-- Controls & Actions -->
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="btn-toggle-time" title="Toggle Day/Night">
                        <i class="bi bi-moon-stars-fill"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3" id="btn-reset-world" title="Regenerate World">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>Reset World
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
                        <button class="btn btn-dark opacity-75 rounded-circle p-3 shadow" id="m-btn-left" style="width: 50px; height: 50px;"><i class="bi bi-arrow-left"></i></button>
                        <button class="btn btn-dark opacity-75 rounded-circle p-3 shadow" id="m-btn-right" style="width: 50px; height: 50px;"><i class="bi bi-arrow-right"></i></button>
                    </div>
                    <!-- Right Jump & Mine -->
                    <div class="d-flex gap-2 pointer-events-auto">
                        <button class="btn btn-warning opacity-75 rounded-circle p-3 shadow fw-bold" id="m-btn-jump" style="width: 54px; height: 54px;">JUMP</button>
                        <button class="btn btn-danger opacity-75 rounded-circle p-3 shadow fw-bold" id="m-btn-mine" style="width: 54px; height: 54px;">MINE</button>
                    </div>
                </div>
            </div>

            <!-- Instructions Banner -->
            <div class="mt-3 p-3 bg-light-subtle rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-2 small text-secondary">
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
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h5 fw-bold text-dark font-title mb-0">Retro Pixel Snake</h2>
                    <span class="badge bg-success-subtle text-success fw-bold">Score: <span id="snake-score">0</span></span>
                    <span class="badge bg-warning-subtle text-warning fw-bold">Highscore: <span id="snake-highscore">0</span></span>
                </div>
                <button class="btn btn-sm btn-dark rounded-pill px-3" id="btn-start-snake">
                    <i class="bi bi-play-fill me-1"></i>Start Game
                </button>
            </div>

            <div class="position-relative w-100 rounded-4 overflow-hidden bg-dark d-flex justify-content-center align-items-center" style="min-height: 400px;">
                <canvas id="snake-canvas" width="600" height="400" class="d-block" style="max-width: 100%; height: auto;"></canvas>
                <div id="snake-overlay" class="position-absolute top-0 start-0 end-0 bottom-0 d-flex flex-column align-items-center justify-content-center bg-dark bg-opacity-75 text-white p-4 text-center">
                    <i class="bi bi-controller display-3 text-success mb-2"></i>
                    <h3 class="fw-bold mb-2">Retro Arcade Snake</h3>
                    <p class="text-secondary small mb-3">Use Arrow keys or WASD to control the pixel snake and collect developer powerups!</p>
                    <button class="btn btn-success rounded-pill px-4 py-2 fw-bold" onclick="startSnakeGame()">PLAY NOW</button>
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
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h5 fw-bold text-dark font-title mb-0">Tech Stack Memory Match</h2>
                    <span class="badge bg-info-subtle text-info fw-bold">Moves: <span id="memory-moves">0</span></span>
                    <span class="badge bg-success-subtle text-success fw-bold">Matches: <span id="memory-matches">0</span> / 6</span>
                </div>
                <button class="btn btn-sm btn-dark rounded-pill px-3" id="btn-reset-memory">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Restart Match
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
                <!-- Container Ad -->
                <div>
                    <script async="async" data-cfasync="false" src="https://pl30967632.profitableratecpmnetwork.com/a006ed973d12be80f0e7a963ed44ffb7/invoke.js"></script>
                    <div id="container-a006ed973d12be80f0e7a963ed44ffb7"></div>
                </div>

                <!-- 300x250 Banner -->
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

                <!-- 160x300 Banner -->
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

            <div class="d-flex flex-wrap justify-content-center align-items-center gap-4">
                <!-- 468x60 Banner -->
                <div>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : '15e936c9cbaac50c805ea0afef86fb6e',
                        'format' : 'iframe',
                        'height' : 60,
                        'width' : 468,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/15e936c9cbaac50c805ea0afef86fb6e/invoke.js"></script>
                </div>

                <!-- 160x600 Banner -->
                <div>
                    <script type="text/javascript">
                      atOptions = {
                        'key' : 'c3a9052e628a187b8304abbadff1152f',
                        'format' : 'iframe',
                        'height' : 600,
                        'width' : 160,
                        'params' : {}
                      };
                    </script>
                    <script type="text/javascript" src="https://www.highrevenueformat.com/c3a9052e628a187b8304abbadff1152f/invoke.js"></script>
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
    // ------------------------------------------------------------
    // 1. GAME TAB SWITCHER
    // ------------------------------------------------------------
    const tabBtns = document.querySelectorAll('.game-tab-btn');
    const gameBlocks = document.querySelectorAll('.game-container-block');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetGame = this.getAttribute('data-game');
            tabBtns.forEach(b => {
                b.classList.remove('btn-dark', 'active');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.remove('btn-outline-secondary');
            this.classList.add('btn-dark', 'active');

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

    // ------------------------------------------------------------
    // 2. MINICRAFT 2D SANDBOX ENGINE
    // ------------------------------------------------------------
    const canvas = document.getElementById('minicraft-canvas');
    const ctx = canvas.getContext('2d');
    const scoreEl = document.getElementById('minicraft-score');
    const todEl = document.getElementById('minicraft-tod');

    // Block Definitions
    const BLOCKS = {
        AIR: 0,
        GRASS: 1,
        DIRT: 2,
        STONE: 3,
        WOOD: 4,
        LEAVES: 5,
        DIAMOND: 6,
        BRICK: 7
    };

    const BLOCK_COLORS = {
        1: '#4CAF50', // Grass
        2: '#795548', // Dirt
        3: '#607D8B', // Stone
        4: '#8D6E63', // Wood
        5: '#2E7D32', // Leaves
        6: '#00BCD4', // Diamond
        7: '#D32F2F'  // Brick
    };

    const BLOCK_NAMES = {
        1: 'Grass', 2: 'Dirt', 3: 'Stone', 4: 'Wood', 5: 'Leaves', 6: 'Diamond', 7: 'Brick'
    };

    const TILE_SIZE = 32;
    const COLS = 50;
    const ROWS = 30;
    let world = [];
    let minedCount = 0;
    let selectedBlock = BLOCKS.GRASS;
    let isNight = false;

    // Player State
    const player = {
        x: 100,
        y: 100,
        width: 22,
        height: 38,
        vx: 0,
        vy: 0,
        speed: 4,
        jumpPower: -10,
        grounded: false
    };

    const keys = {};

    // Web Audio Synthesizer Sound Generator
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

    // Generate MiniCraft World
    function generateWorld() {
        world = Array(ROWS).fill(null).map(() => Array(COLS).fill(BLOCKS.AIR));
        const groundLevel = 14;

        for (let r = 0; r < ROWS; r++) {
            for (let c = 0; c < COLS; c++) {
                if (r === groundLevel) {
                    world[r][c] = BLOCKS.GRASS;
                } else if (r > groundLevel && r <= groundLevel + 4) {
                    world[r][c] = BLOCKS.DIRT;
                } else if (r > groundLevel + 4) {
                    // Random Diamonds deep underground
                    if (r > groundLevel + 8 && Math.random() < 0.08) {
                        world[r][c] = BLOCKS.DIAMOND;
                    } else {
                        world[r][c] = BLOCKS.STONE;
                    }
                }
            }
        }

        // Add Trees
        function plantTree(c) {
            const trunkHeight = 4;
            const baseR = groundLevel - 1;
            for (let i = 0; i < trunkHeight; i++) {
                if (baseR - i >= 0) world[baseR - i][c] = BLOCKS.WOOD;
            }
            const leafTop = baseR - trunkHeight;
            for (let lr = leafTop - 1; lr <= leafTop; lr++) {
                for (let lc = c - 2; lc <= c + 2; lc++) {
                    if (lr >= 0 && lc >= 0 && lc < COLS) {
                        if (world[lr][lc] === BLOCKS.AIR) world[lr][lc] = BLOCKS.LEAVES;
                    }
                }
            }
        }

        plantTree(8);
        plantTree(20);
        plantTree(35);
        plantTree(44);

        player.x = 200;
        player.y = (groundLevel - 3) * TILE_SIZE;
        player.vx = 0;
        player.vy = 0;
    }

    // Render Inventory Selector Bar
    function renderInventory() {
        const invContainer = document.getElementById('minicraft-inventory');
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

    // Input Listeners
    window.addEventListener('keydown', e => {
        keys[e.code] = true;
        if (['Digit1', 'Digit2', 'Digit3', 'Digit4', 'Digit5', 'Digit6', 'Digit7'].includes(e.code)) {
            const idx = parseInt(e.code.replace('Digit', ''));
            const bList = [BLOCKS.GRASS, BLOCKS.DIRT, BLOCKS.STONE, BLOCKS.WOOD, BLOCKS.LEAVES, BLOCKS.DIAMOND, BLOCKS.BRICK];
            if (bList[idx - 1]) {
                selectedBlock = bList[idx - 1];
                renderInventory();
            }
        }
    });

    window.addEventListener('keyup', e => {
        keys[e.code] = false;
    });

    // Touch Controls
    const mLeft = document.getElementById('m-btn-left');
    const mRight = document.getElementById('m-btn-right');
    const mJump = document.getElementById('m-btn-jump');
    const mMine = document.getElementById('m-btn-mine');

    if (mLeft) {
        mLeft.addEventListener('touchstart', e => { e.preventDefault(); keys['KeyA'] = true; });
        mLeft.addEventListener('touchend', e => { e.preventDefault(); keys['KeyA'] = false; });
        mRight.addEventListener('touchstart', e => { e.preventDefault(); keys['KeyD'] = true; });
        mRight.addEventListener('touchend', e => { e.preventDefault(); keys['KeyD'] = false; });
        mJump.addEventListener('touchstart', e => { e.preventDefault(); if (player.grounded) { player.vy = player.jumpPower; playBeep(320, 0.08); } });
        mMine.addEventListener('touchstart', e => { e.preventDefault(); breakBlockInFront(); });
    }

    function breakBlockInFront() {
        const centerC = Math.floor((player.x + player.width / 2) / TILE_SIZE);
        const centerR = Math.floor((player.y + player.height / 2) / TILE_SIZE);
        for (let dr = -1; dr <= 1; dr++) {
            for (let dc = -1; dc <= 1; dc++) {
                const r = centerR + dr;
                const c = centerC + dc;
                if (r >= 0 && r < ROWS && c >= 0 && c < COLS) {
                    if (world[r][c] !== BLOCKS.AIR) {
                        world[r][c] = BLOCKS.AIR;
                        minedCount++;
                        scoreEl.textContent = minedCount;
                        playBeep(220, 0.1);
                        return;
                    }
                }
            }
        }
    }

    // Canvas Click (Place / Break Block)
    canvas.addEventListener('contextmenu', e => e.preventDefault());
    canvas.addEventListener('mousedown', e => {
        const rect = canvas.getBoundingClientRect();
        const mouseX = (e.clientX - rect.left) * (canvas.width / rect.width);
        const mouseY = (e.clientY - rect.top) * (canvas.height / rect.height);
        const c = Math.floor(mouseX / TILE_SIZE);
        const r = Math.floor(mouseY / TILE_SIZE);

        if (r >= 0 && r < ROWS && c >= 0 && c < COLS) {
            if (e.button === 2 || e.shiftKey) {
                // Place block
                if (world[r][c] === BLOCKS.AIR) {
                    world[r][c] = selectedBlock;
                    playBeep(520, 0.05);
                }
            } else if (e.button === 0) {
                // Break block
                if (world[r][c] !== BLOCKS.AIR) {
                    world[r][c] = BLOCKS.AIR;
                    minedCount++;
                    scoreEl.textContent = minedCount;
                    playBeep(260, 0.08);
                }
            }
        }
    });

    document.getElementById('btn-reset-world').addEventListener('click', () => {
        minedCount = 0;
        scoreEl.textContent = '0';
        generateWorld();
        playBeep(600, 0.15);
    });

    document.getElementById('btn-toggle-time').addEventListener('click', () => {
        isNight = !isNight;
        todEl.textContent = isNight ? 'Night 🌙' : 'Day ☀️';
        playBeep(350, 0.08);
    });

    // Physics Update Loop
    function updatePhysics() {
        if (keys['KeyA'] || keys['ArrowLeft']) player.vx = -player.speed;
        else if (keys['KeyD'] || keys['ArrowRight']) player.vx = player.speed;
        else player.vx = 0;

        if ((keys['KeyW'] || keys['Space'] || keys['ArrowUp']) && player.grounded) {
            player.vy = player.jumpPower;
            player.grounded = false;
            playBeep(320, 0.08);
        }

        // Gravity
        player.vy += 0.5;
        if (player.vy > 12) player.vy = 12;

        // Move X
        player.x += player.vx;
        handleCollision(true);

        // Move Y
        player.y += player.vy;
        handleCollision(false);

        // Boundary Clamp
        if (player.x < 0) player.x = 0;
        if (player.x > COLS * TILE_SIZE - player.width) player.x = COLS * TILE_SIZE - player.width;
        if (player.y > ROWS * TILE_SIZE) {
            player.x = 200;
            player.y = 100;
            player.vy = 0;
        }
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

    // Render Loop
    function renderGame() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Sky Background
        ctx.fillStyle = isNight ? '#0A0F1D' : '#87CEEB';
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Sun / Moon
        ctx.fillStyle = isNight ? '#F4F6F0' : '#FFD700';
        ctx.beginPath();
        ctx.arc(isNight ? 680 : 120, 70, 30, 0, Math.PI * 2);
        ctx.fill();

        // Draw Blocks
        for (let r = 0; r < ROWS; r++) {
            for (let c = 0; c < COLS; c++) {
                const bType = world[r][c];
                if (bType !== BLOCKS.AIR) {
                    ctx.fillStyle = BLOCK_COLORS[bType] || '#fff';
                    ctx.fillRect(c * TILE_SIZE, r * TILE_SIZE, TILE_SIZE, TILE_SIZE);
                    ctx.strokeStyle = 'rgba(0,0,0,0.15)';
                    ctx.strokeRect(c * TILE_SIZE, r * TILE_SIZE, TILE_SIZE, TILE_SIZE);
                }
            }
        }

        // Draw Player Character (Steve)
        ctx.fillStyle = '#FF5722'; // Shirt
        ctx.fillRect(player.x, player.y + 12, player.width, 16);
        ctx.fillStyle = '#FFCC80'; // Skin/Head
        ctx.fillRect(player.x + 2, player.y, player.width - 4, 12);
        ctx.fillStyle = '#1565C0'; // Pants
        ctx.fillRect(player.x + 2, player.y + 28, player.width - 4, 10);

        // Eyes
        ctx.fillStyle = '#000';
        ctx.fillRect(player.x + (player.vx < 0 ? 3 : 13), player.y + 4, 3, 3);
    }

    function gameLoop() {
        updatePhysics();
        renderGame();
        requestAnimationFrame(gameLoop);
    }

    generateWorld();
    renderInventory();
    gameLoop();

    // ------------------------------------------------------------
    // 3. PIXEL SNAKE GAME ENGINE
    // ------------------------------------------------------------
    const sCanvas = document.getElementById('snake-canvas');
    const sCtx = sCanvas.getContext('2d');
    let snake = [{x: 10, y: 10}];
    let food = {x: 15, y: 15};
    let dx = 1, dy = 0;
    let snakeScore = 0;
    let snakeHighScore = 0;
    let snakeRunning = false;
    let snakeInterval = null;

    function startSnakeGame() {
        document.getElementById('snake-overlay').classList.add('d-none');
        snake = [{x: 10, y: 10}, {x: 9, y: 10}, {x: 8, y: 10}];
        dx = 1; dy = 0;
        snakeScore = 0;
        document.getElementById('snake-score').textContent = '0';
        spawnSnakeFood();
        snakeRunning = true;
        if (snakeInterval) clearInterval(snakeInterval);
        snakeInterval = setInterval(updateSnake, 100);
    }

    function spawnSnakeFood() {
        food = {
            x: Math.floor(Math.random() * (sCanvas.width / 20)),
            y: Math.floor(Math.random() * (sCanvas.height / 20))
        };
    }

    function updateSnake() {
        if (!snakeRunning) return;
        const head = {x: snake[0].x + dx, y: snake[0].y + dy};

        // Wall collision check
        if (head.x < 0 || head.x >= sCanvas.width / 20 || head.y < 0 || head.y >= sCanvas.height / 20 || checkSelfCollision(head)) {
            snakeRunning = false;
            clearInterval(snakeInterval);
            if (snakeScore > snakeHighScore) {
                snakeHighScore = snakeScore;
                document.getElementById('snake-highscore').textContent = snakeHighScore;
            }
            alert('Game Over! Score: ' + snakeScore);
            document.getElementById('snake-overlay').classList.remove('d-none');
            return;
        }

        snake.unshift(head);
        if (head.x === food.x && head.y === food.y) {
            snakeScore += 10;
            document.getElementById('snake-score').textContent = snakeScore;
            playBeep(700, 0.08);
            spawnSnakeFood();
        } else {
            snake.pop();
        }

        // Render Snake Canvas
        sCtx.fillStyle = '#141724';
        sCtx.fillRect(0, 0, sCanvas.width, sCanvas.height);

        // Draw Food
        sCtx.fillStyle = '#FF5722';
        sCtx.fillRect(food.x * 20, food.y * 20, 18, 18);

        // Draw Snake
        sCtx.fillStyle = '#4CAF50';
        snake.forEach((part, i) => {
            sCtx.fillStyle = i === 0 ? '#81C784' : '#4CAF50';
            sCtx.fillRect(part.x * 20, part.y * 20, 18, 18);
        });
    }

    function checkSelfCollision(head) {
        return snake.some((part, index) => index !== 0 && part.x === head.x && part.y === head.y);
    }

    window.addEventListener('keydown', e => {
        if (!snakeRunning) return;
        if ((e.key === 'ArrowUp' || e.key === 'w') && dy !== 1) { dx = 0; dy = -1; }
        else if ((e.key === 'ArrowDown' || e.key === 's') && dy !== -1) { dx = 0; dy = 1; }
        else if ((e.key === 'ArrowLeft' || e.key === 'a') && dx !== 1) { dx = -1; dy = 0; }
        else if ((e.key === 'ArrowRight' || e.key === 'd') && dx !== -1) { dx = 1; dy = 0; }
    });

    document.getElementById('btn-start-snake').addEventListener('click', startSnakeGame);

    // ------------------------------------------------------------
    // 4. MEMORY MATCH ENGINE
    // ------------------------------------------------------------
    const techIcons = [
        'bi-filetype-react', 'bi-filetype-js', 'bi-filetype-php',
        'bi-bootstrap-fill', 'bi-github', 'bi-figma'
    ];
    let memoryCards = [];
    let flippedCards = [];
    let moves = 0;
    let matches = 0;

    function initMemoryGame() {
        const container = document.getElementById('memory-grid-container');
        container.innerHTML = '';
        moves = 0;
        matches = 0;
        flippedCards = [];
        document.getElementById('memory-moves').textContent = '0';
        document.getElementById('memory-matches').textContent = '0';

        const deck = [...techIcons, ...techIcons].sort(() => Math.random() - 0.5);
        
        deck.forEach((icon, idx) => {
            const col = document.createElement('div');
            col.className = 'col-3 col-md-3';
            col.innerHTML = `
                <div class="memory-card" data-icon="${icon}" data-id="${idx}">
                    <div class="memory-card-inner">
                        <div class="memory-card-front"><i class="bi bi-question-lg"></i></div>
                        <div class="memory-card-back"><i class="bi ${icon}"></i></div>
                    </div>
                </div>
            `;
            const cardEl = col.querySelector('.memory-card');
            cardEl.addEventListener('click', () => handleMemoryCardClick(cardEl));
            container.appendChild(col);
        });
    }

    function handleMemoryCardClick(card) {
        if (flippedCards.length >= 2 || card.classList.contains('flipped') || card.classList.contains('matched')) return;

        card.classList.add('flipped');
        flippedCards.push(card);
        playBeep(480, 0.05);

        if (flippedCards.length === 2) {
            moves++;
            document.getElementById('memory-moves').textContent = moves;
            const [c1, c2] = flippedCards;

            if (c1.getAttribute('data-icon') === c2.getAttribute('data-icon')) {
                c1.classList.add('matched');
                c2.classList.add('matched');
                matches++;
                document.getElementById('memory-matches').textContent = matches;
                flippedCards = [];
                playBeep(880, 0.1);
                if (matches === 6) {
                    setTimeout(() => alert('🎉 Congratulations! You solved the Code Memory Match in ' + moves + ' moves!'), 300);
                }
            } else {
                setTimeout(() => {
                    c1.classList.remove('flipped');
                    c2.classList.remove('flipped');
                    flippedCards = [];
                }, 900);
            }
        }
    }

    document.getElementById('btn-reset-memory').addEventListener('click', initMemoryGame);
    initMemoryGame();
});
</script>

<?php
include BASE_PATH . 'templates/layout/footer.php';
include BASE_PATH . 'templates/layout/body-end.php';
?>