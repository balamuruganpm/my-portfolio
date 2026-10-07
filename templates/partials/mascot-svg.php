<?php
/**
 * Partial: Mascot Character SVG Scene
 * 300+ line pixel art mascot character scene extracted from header.php
 */
?>
<div class="floating-jetpack-container in-preloader char-sitting" id="jetpack-character" aria-hidden="true" data-default-speech="<?php echo e($defaultMascotSpeech); ?>" data-whatsapp="<?php echo e($socialsWhatsapp); ?>" data-whatsapp-message="<?php echo e($mascotWhatsappMessage); ?>">
    <div class="jetpack-tooltip"><?php echo e($defaultMascotSpeech); ?></div>
    <div class="jetpack-character-wrapper">
        <svg viewBox="0 0 100 96" width="100" height="96" id="preloader-scene-svg">

            <!-- ====== SCENE ELEMENTS ====== -->
            <!-- Fuel Station / Canister (On the right) -->
            <g class="g-fuel-station">
                <ellipse cx="83" cy="70" rx="10" ry="2.5" fill="rgba(0,0,0,0.06)" />
                <rect x="75" y="44" width="16" height="26" fill="#75932e" rx="2" />
                <rect x="79" y="38" width="8" height="6" fill="#8cb03a" />

                <rect x="77" y="47" width="12" height="7" fill="#1c1c1c" rx="1" />
                <text x="83" y="52.5" fill="#ffb300" font-family="'Courier New', monospace" font-size="4.5" font-weight="bold" text-anchor="middle" id="svg-fuel-percent">0%</text>

                <ellipse cx="83" cy="62" rx="4" ry="2" fill="#58711e" />
                <circle cx="83" cy="62" r="1.5" fill="#1c1c1c" />
                <path d="M 83 62 Q 74 65 67 48" fill="none" stroke="#1c1c1c" stroke-width="1.5" />
            </g>

            <!-- ====== MASCOT CHARACTER ====== -->
            <!-- Sitting frame (preloading state) -->
            <g class="g-char-sitting">
                <ellipse cx="43" cy="76" rx="24" ry="4" fill="rgba(0,0,0,0.08)" />
                <rect x="22" y="72" width="42" height="3" fill="#8b5a2b" rx="1" />
                <rect x="26" y="75" width="3" height="12" fill="#6f421b" />
                <rect x="57" y="75" width="3" height="12" fill="#6f421b" />

                <rect x="30" y="64" width="6" height="16" fill="#3b5998" rx="2" />
                <rect x="30" y="80" width="6" height="3" fill="#fc5b5b" rx="1" />
                <rect x="30" y="83" width="6" height="2" fill="#ffffff" />

                <rect x="42" y="64" width="6" height="16" fill="#3b5998" rx="2" />
                <rect x="42" y="80" width="6" height="3" fill="#fc5b5b" rx="1" />
                <rect x="42" y="83" width="6" height="2" fill="#ffffff" />

                <rect x="28" y="44" width="22" height="22" fill="#ffffff" rx="2" />
                <polygon points="38,48 40,48 41,56 39,59 37,56" fill="#fc5b5b" />

                <rect x="29" y="30" width="20" height="14" fill="#f1c27d" rx="2" />
                <rect x="31" y="34" width="16" height="4" fill="#1c1c1c" rx="1" />
                <rect x="33" y="35" width="4" height="2" fill="#ffffff" />
                <rect x="27" y="30" width="2" height="12" fill="#1c1c1c" />
                <rect x="49" y="30" width="2" height="12" fill="#1c1c1c" />
                <rect x="29" y="28" width="20" height="2" fill="#1c1c1c" />

                <path d="M 29 28 Q 39 16 49 28 Z" fill="#fc5b5b" />
                <rect x="27" y="28" width="24" height="3" fill="#e54343" rx="1" />

                <rect x="22" y="46" width="6" height="14" fill="#ffffff" rx="2" />
                <rect x="22" y="60" width="6" height="4" fill="#f1c27d" rx="1" />

                <rect x="50" y="46" width="6" height="14" fill="#ffffff" rx="2" />
                <rect x="50" y="60" width="6" height="4" fill="#f1c27d" rx="1" />
            </g>

            <!-- Pose 2: Walking frame 1 -->
            <g class="g-char-walking-1">
                <ellipse cx="30" cy="74" rx="18" ry="3" fill="rgba(0,0,0,0.06)" />
                <rect x="18" y="26" width="24" height="22" fill="#ffffff" />
                <polygon points="29,30 31,30 32,38 30,41 28,38" fill="#fc5b5b" />
                <rect x="20" y="14" width="20" height="12" fill="#f1c27d" />
                <rect x="22" y="18" width="16" height="4" fill="#1c1c1c" />
                <rect x="24" y="19" width="4" height="2" fill="#ffffff" />
                <rect x="18" y="14" width="2" height="10" fill="#1c1c1c" />
                <rect x="40" y="14" width="2" height="10" fill="#1c1c1c" />
                <rect x="20" y="12" width="20" height="2" fill="#1c1c1c" />
                <path d="M 20 12 Q 30 2 40 12 Z" fill="#fc5b5b" />
                <rect x="18" y="12" width="24" height="3" fill="#e54343" />
                <rect x="12" y="28" width="6" height="12" fill="#ffffff" />
                <rect x="12" y="40" width="6" height="4" fill="#f1c27d" />
                <rect x="42" y="30" width="6" height="10" fill="#ffffff" />
                <rect x="42" y="40" width="6" height="4" fill="#f1c27d" />
                <rect x="20" y="48" width="8" height="22" fill="#3b5998" />
                <rect x="20" y="70" width="8" height="4" fill="#fc5b5b" />
                <rect x="32" y="48" width="8" height="18" fill="#3b5998" />
                <rect x="32" y="66" width="8" height="4" fill="#fc5b5b" />
            </g>

            <!-- Pose 2: Walking frame 2 -->
            <g class="g-char-walking-2">
                <ellipse cx="30" cy="74" rx="18" ry="3" fill="rgba(0,0,0,0.06)" />
                <rect x="20" y="28" width="24" height="20" fill="#ffffff" />
                <polygon points="31,32 33,32 34,40 32,43 30,40" fill="#fc5b5b" />
                <rect x="22" y="16" width="20" height="12" fill="#f1c27d" />
                <rect x="24" y="20" width="16" height="4" fill="#1c1c1c" />
                <rect x="26" y="21" width="4" height="2" fill="#ffffff" />
                <rect x="20" y="16" width="2" height="10" fill="#1c1c1c" />
                <rect x="42" y="16" width="2" height="10" fill="#1c1c1c" />
                <rect x="22" y="14" width="20" height="2" fill="#1c1c1c" />
                <path d="M 22 14 Q 32 4 42 14 Z" fill="#fc5b5b" />
                <rect x="20" y="14" width="24" height="3" fill="#e54343" />
                <rect x="14" y="30" width="6" height="10" fill="#ffffff" />
                <rect x="14" y="40" width="6" height="4" fill="#f1c27d" />
                <rect x="44" y="28" width="6" height="12" fill="#ffffff" />
                <rect x="44" y="40" width="6" height="4" fill="#f1c27d" />
                <rect x="22" y="48" width="8" height="18" fill="#3b5998" />
                <rect x="22" y="66" width="8" height="4" fill="#fc5b5b" />
                <rect x="34" y="48" width="8" height="22" fill="#3b5998" />
                <rect x="34" y="70" width="8" height="4" fill="#fc5b5b" />
            </g>

            <!-- Pose 3: Fully Equipped / Flying -->
            <g class="g-char-equipped">
                <rect x="16" y="24" width="5" height="20" fill="#5a5d5f" />
                <rect x="43" y="24" width="5" height="20" fill="#5a5d5f" />

                <g class="thruster-flames">
                    <path class="thruster-flame left-flame" d="M 16 44 L 18.5 68 L 21 44 Z" fill="#ff9800" />
                    <path class="thruster-flame-inner left-flame-inner" d="M 17 44 L 18.5 58 L 20 44 Z" fill="#ffeb3b" />
                    <path class="thruster-flame right-flame" d="M 43 44 L 45.5 68 L 48 44 Z" fill="#ff9800" />
                    <path class="thruster-flame-inner right-flame-inner" d="M 44 44 L 45.5 58 L 47 44 Z" fill="#ffeb3b" />
                </g>

                <rect x="13" y="28" width="6" height="12" fill="#ffffff" />
                <rect x="13" y="40" width="6" height="4" fill="#f1c27d" />
                <rect x="45" y="28" width="6" height="12" fill="#ffffff" />
                <rect x="45" y="40" width="6" height="4" fill="#f1c27d" />

                <rect x="21" y="46" width="9" height="24" fill="#3b5998" />
                <rect x="34" y="46" width="9" height="24" fill="#3b5998" />

                <rect x="21" y="70" width="9" height="4" fill="#fc5b5b" />
                <rect x="21" y="74" width="9" height="2" fill="#ffffff" />
                <rect x="34" y="70" width="9" height="4" fill="#fc5b5b" />
                <rect x="34" y="74" width="9" height="2" fill="#ffffff" />

                <rect x="19" y="26" width="26" height="20" fill="#ffffff" />

                <rect x="22" y="26" width="4" height="20" fill="#8cb03a" />
                <rect x="38" y="26" width="4" height="20" fill="#8cb03a" />
                <rect x="26" y="34" width="12" height="4" fill="#8cb03a" />

                <rect x="21" y="14" width="22" height="12" fill="#f1c27d" />
                <rect x="23" y="17" width="18" height="4" fill="#1c1c1c" />
                <rect x="25" y="18" width="5" height="2" fill="#ffffff" />

                <rect x="19" y="14" width="2" height="10" fill="#1c1c1c" />
                <rect x="43" y="14" width="2" height="10" fill="#1c1c1c" />
                <rect x="21" y="12" width="22" height="2" fill="#1c1c1c" />

                <path d="M 21 12 Q 32 0 43 12 Z" fill="#fc5b5b" />
                <rect x="19" y="12" width="26" height="3" fill="#e54343" />
            </g>

        </svg>
    </div>
</div>
