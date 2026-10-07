<?php
/**
 * Section: Experience Timeline with Climbing Mascot
 */
$experienceList = $experienceList ?? $experience ?? [];
?>
<section class="experience-section py-2 mb-4" aria-label="<?php echo e($expLabel); ?>" data-mascot-speech="<?php echo e($expSpeech); ?>">
    <div class="cyber-card-frame p-4 p-md-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="hud-mono-tag font-mono text-cyan">// CAREER_TRAJECTORY</span>
        </div>
        <h2 class="h3 fw-bold font-title text-white mb-4">
            Professional Experience &amp; Positions
        </h2>

        <div class="timeline-wrapper d-flex position-relative">
            
            <!-- Left Ladder Column -->
            <div class="ladder-track-col d-none d-md-block" aria-hidden="true" style="width: 70px;">
                <div class="vertical-timeline-ladder"></div>
                
                <!-- Sticky Climber Character Container -->
                <div class="rope-climber-sticky">
                    <div class="rope-climber" id="timeline-climber">
                        <svg viewBox="0 0 64 80" width="64" height="80">
                            <!-- Frame 1 -->
                            <g class="climb-frame climb-frame-1">
                                <rect x="14" y="24" width="6" height="12" fill="#ffffff" />
                                <rect x="14" y="20" width="6" height="4" fill="#00f2fe" />
                                <rect x="44" y="32" width="6" height="12" fill="#ffffff" />
                                <rect x="44" y="44" width="6" height="4" fill="#00f2fe" />
                                <rect x="20" y="28" width="24" height="20" fill="#ffffff" />
                                <rect x="24" y="30" width="16" height="18" fill="#8b5cf6" />
                                <rect x="26" y="32" width="12" height="14" fill="#7928ca" />
                                <path d="M 22 20 Q 32 8 42 20 Z" fill="#00f2fe" />
                                <rect x="24" y="20" width="16" height="3" fill="#050811" />
                                <rect x="18" y="20" width="4" height="6" fill="#050811" />
                                <rect x="42" y="20" width="4" height="6" fill="#050811" />
                                <rect x="22" y="48" width="20" height="10" fill="#3b5998" />
                                <rect x="22" y="58" width="8" height="12" fill="#3b5998" />
                                <rect x="22" y="70" width="8" height="4" fill="#00f2fe" />
                                <rect x="34" y="54" width="8" height="12" fill="#3b5998" />
                                <rect x="34" y="66" width="8" height="4" fill="#00f2fe" />
                            </g>

                            <!-- Frame 2 -->
                            <g class="climb-frame climb-frame-2">
                                <rect x="14" y="32" width="6" height="12" fill="#ffffff" />
                                <rect x="14" y="44" width="6" height="4" fill="#00f2fe" />
                                <rect x="44" y="24" width="6" height="12" fill="#ffffff" />
                                <rect x="44" y="20" width="6" height="4" fill="#00f2fe" />
                                <rect x="20" y="28" width="24" height="20" fill="#ffffff" />
                                <rect x="24" y="30" width="16" height="18" fill="#8b5cf6" />
                                <rect x="26" y="32" width="12" height="14" fill="#7928ca" />
                                <path d="M 22 20 Q 32 8 42 20 Z" fill="#00f2fe" />
                                <rect x="24" y="20" width="16" height="3" fill="#050811" />
                                <rect x="18" y="20" width="4" height="6" fill="#050811" />
                                <rect x="42" y="20" width="4" height="6" fill="#050811" />
                                <rect x="22" y="48" width="20" height="10" fill="#3b5998" />
                                <rect x="22" y="54" width="8" height="12" fill="#3b5998" />
                                <rect x="22" y="66" width="8" height="4" fill="#00f2fe" />
                                <rect x="34" y="58" width="8" height="12" fill="#3b5998" />
                                <rect x="34" y="70" width="8" height="4" fill="#00f2fe" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Right Content Column -->
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
                        $contextNote = ' <span class="text-secondary small font-body">(TechForge Academy Company)</span>';
                    }
                ?>
                    <!-- Experience Item block -->
                    <div class="cyber-timeline-item reveal-card p-3.5 p-md-4 rounded-3" data-index="<?php echo $index; ?>">
                        <div class="card-header-timeline d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2 mb-3">
                            <div>
                                <h3 class="h5 fw-bold font-title text-white mb-1"><?php echo $role; ?></h3>
                                <p class="text-cyan m-0 font-mono small"><?php echo $company . $contextNote; ?></p>
                            </div>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <span class="badge bg-dark text-cyan border border-secondary border-opacity-50 font-mono small"><?php echo $duration; ?></span>
                                <span class="badge bg-dark text-secondary border border-secondary border-opacity-50 font-mono small"><?php echo $location; ?></span>
                            </div>
                        </div>
                        <div class="card-body-timeline text-secondary font-body leading-relaxed">
                            <?php if (!empty($bullets)) { ?>
                                <p class="primary-summary mb-0"><?php echo e($bullets[0]); ?></p>
                            <?php } ?>
                            
                            <?php if (count($bullets) > 1) { ?>
                                <div class="collapsible-details-wrapper" id="details-<?php echo $index; ?>">
                                    <ul class="ps-3 mt-3 mb-0 details-bullet-list font-body">
                                        <?php for ($i = 1; $i < count($bullets); $i++) { ?>
                                            <li class="mb-2"><?php echo e($bullets[$i]); ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                
                                <!-- Toggle Button -->
                                <button class="cyber-btn cyber-btn-glass mt-3 d-inline-flex align-items-center gap-1.5 view-more-btn font-mono" aria-expanded="false" aria-controls="details-<?php echo $index; ?>" style="font-size: 0.78rem; padding: 4px 14px;">
                                    <span class="toggle-text">VIEW_DETAILS</span>
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
