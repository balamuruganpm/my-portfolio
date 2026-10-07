<?php
/**
 * Section: Experience Timeline with Climbing Mascot (Extracted from about.php mode 1)
 */
?>
<section class="experience-section py-1" aria-label="<?php echo e($expLabel); ?>" data-mascot-speech="<?php echo e($expSpeech); ?>">
    <!-- Single Unified Career Ladder Card Container -->
    <div class="timeline-container-card p-4 p-md-5">
        <div class="timeline-wrapper d-flex position-relative">
            
            <!-- Left Ladder Column (100px width) -->
            <div class="ladder-track-col" aria-hidden="true">
                <!-- White/Gray Ladder Graphic -->
                <div class="vertical-timeline-ladder"></div>
                
                <!-- Sticky Climber Character Container -->
                <div class="rope-climber-sticky">
                    <div class="rope-climber" id="timeline-climber">
                        <!-- Inline SVG containing Frame 1 and Frame 2 groups of Pixel Art Character -->
                        <svg viewBox="0 0 64 80" width="64" height="80">
                            <!-- Frame 1: Left hand/leg climbing -->
                            <g class="climb-frame climb-frame-1">
                                <rect x="14" y="24" width="6" height="12" fill="#ffffff" />
                                <rect x="14" y="20" width="6" height="4" fill="#fc5b5b" />
                                <rect x="44" y="32" width="6" height="12" fill="#ffffff" />
                                <rect x="44" y="44" width="6" height="4" fill="#fc5b5b" />
                                <rect x="20" y="28" width="24" height="20" fill="#ffffff" />
                                <rect x="24" y="30" width="16" height="18" fill="#8cb03a" />
                                <rect x="26" y="32" width="12" height="14" fill="#75932e" />
                                <path d="M 22 20 Q 32 8 42 20 Z" fill="#fc5b5b" />
                                <rect x="24" y="20" width="16" height="3" fill="#3a3a3a" />
                                <rect x="18" y="20" width="4" height="6" fill="#1c1c1c" />
                                <rect x="42" y="20" width="4" height="6" fill="#1c1c1c" />
                                <rect x="22" y="48" width="20" height="10" fill="#3b5998" />
                                <rect x="22" y="58" width="8" height="12" fill="#3b5998" />
                                <rect x="22" y="70" width="8" height="4" fill="#fc5b5b" />
                                <rect x="34" y="54" width="8" height="12" fill="#3b5998" />
                                <rect x="34" y="66" width="8" height="4" fill="#fc5b5b" />
                            </g>

                            <!-- Frame 2: Right hand/leg climbing -->
                            <g class="climb-frame climb-frame-2">
                                <rect x="14" y="32" width="6" height="12" fill="#ffffff" />
                                <rect x="14" y="44" width="6" height="4" fill="#fc5b5b" />
                                <rect x="44" y="24" width="6" height="12" fill="#ffffff" />
                                <rect x="44" y="20" width="6" height="4" fill="#fc5b5b" />
                                <rect x="20" y="28" width="24" height="20" fill="#ffffff" />
                                <rect x="24" y="30" width="16" height="18" fill="#8cb03a" />
                                <rect x="26" y="32" width="12" height="14" fill="#75932e" />
                                <path d="M 22 20 Q 32 8 42 20 Z" fill="#fc5b5b" />
                                <rect x="24" y="20" width="16" height="3" fill="#3a3a3a" />
                                <rect x="18" y="20" width="4" height="6" fill="#1c1c1c" />
                                <rect x="42" y="20" width="4" height="6" fill="#1c1c1c" />
                                <rect x="22" y="48" width="20" height="10" fill="#3b5998" />
                                <rect x="22" y="54" width="8" height="12" fill="#3b5998" />
                                <rect x="22" y="66" width="8" height="4" fill="#fc5b5b" />
                                <rect x="34" y="58" width="8" height="12" fill="#3b5998" />
                                <rect x="34" y="70" width="8" height="4" fill="#fc5b5b" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Content Column inside Single Card -->
            <div class="timeline-content-col flex-grow-1 d-flex flex-column gap-4">
                <?php 
                $index = 1;
                foreach ($experienceList as $exp) {
                    $company = isset($exp['company']) ? e($exp['company']) : '';
                    $role = isset($exp['role']) ? e($exp['role']) : '';
                    $duration = isset($exp['duration']) ? e($exp['duration']) : '';
                    $location = isset($exp['location']) ? e($exp['location']) : '';
                    $bullets = isset($exp['bullets']) ? $exp['bullets'] : [];
                    
                    $contextNote = "";
                    if (stripos($company, 'Skillchemy') !== false) {
                        $contextNote = ' <span class="text-muted small font-body">(TechForge Academy Company)</span>';
                    }
                ?>
                    <!-- Experience Item block -->
                    <div class="timeline-item-block reveal-card" data-index="<?php echo $index; ?>">
                        <div class="card-header-timeline d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
                            <div>
                                <h3 class="h4 fw-bold font-title text-dark mb-1"><?php echo $role; ?></h3>
                                <p class="text-secondary m-0 fw-semibold"><?php echo $company . $contextNote; ?></p>
                            </div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <span class="badge badge-accent-light"><?php echo $duration; ?></span>
                                <span class="badge badge-location-light"><?php echo $location; ?></span>
                            </div>
                        </div>
                        <div class="card-body-timeline text-secondary font-body leading-relaxed">
                            <?php if (!empty($bullets)) { ?>
                                <p class="primary-summary mb-0"><?php echo e($bullets[0]); ?></p>
                            <?php } ?>
                            
                            <?php if (count($bullets) > 1) { ?>
                                <div class="collapsible-details-wrapper" id="details-<?php echo $index; ?>">
                                    <ul class="ps-3 mt-3 mb-0 details-bullet-list">
                                        <?php for ($i = 1; $i < count($bullets); $i++) { ?>
                                            <li class="mb-2"><?php echo e($bullets[$i]); ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                
                                <!-- Toggle Button -->
                                <button class="view-more-btn mt-3 d-flex align-items-center gap-1" aria-expanded="false" aria-controls="details-<?php echo $index; ?>">
                                    <span class="toggle-text">View more</span>
                                    <i class="bi bi-chevron-down toggle-icon"></i>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                <?php 
                    $index++;
                } 
                ?>
            </div>
        </div>
    </div>
</section>
