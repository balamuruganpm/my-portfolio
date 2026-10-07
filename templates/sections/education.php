<?php
/**
 * Section: Education & Academic Milestones
 */
if (!empty($educationList)) {
?>
<!-- Education Section -->
<section id="education-section" class="py-2 mb-4" aria-label="<?php echo e($eduLabel); ?>" data-mascot-speech="<?php echo e($eduSpeech); ?>">
    <div class="cyber-card-frame p-4 p-md-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <span class="hud-mono-tag font-mono text-cyan">// ACADEMIC_CREDENTIALS</span>
        </div>
        <h2 class="h3 fw-bold text-white mb-4 font-title">
            Education &amp; Qualifications
        </h2>
        
        <div class="timeline-wrapper d-flex position-relative">
            <!-- Left Content Column: Academic Milestones -->
            <div class="timeline-content-col flex-grow-1 d-flex flex-column gap-4 text-start">
                <?php 
                $eduIndex = 1;
                foreach ($educationList as $edu) { 
                ?>
                    <div class="cyber-timeline-item reveal-card p-3.5 p-md-4 rounded-3" data-index="<?php echo $eduIndex; ?>">
                        <div class="card-header-timeline d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-2">
                            <div class="text-start">
                                <h3 class="h5 fw-bold font-title text-white mb-1 timeline-degree-heading"><?php echo e($edu['degree']); ?></h3>
                                <p class="text-cyan m-0 font-mono small"><?php echo e($edu['institution']); ?></p>
                            </div>
                            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-md-end justify-content-start">
                                <span class="badge bg-dark text-cyan border border-secondary border-opacity-50 font-mono small"><?php echo e($edu['duration']); ?></span>
                                <span class="badge bg-dark text-secondary border border-secondary border-opacity-50 font-mono small"><?php echo e($edu['location']); ?></span>
                                <span class="badge bg-dark text-white border border-secondary border-opacity-50 font-mono small"><?php echo e($edu['metric']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php 
                    $eduIndex++;
                } 
                ?>
            </div>

            <!-- Right Academic Path Column (100px width) -->
            <div class="ladder-track-col" aria-hidden="true">
                <div class="vertical-academic-track"></div>
                
                <!-- Sticky Student Character Container -->
                <div class="rope-climber-sticky">
                    <div class="student-mascot" id="education-student">
                        <svg viewBox="0 0 64 80" width="64" height="80">
                            <!-- Frame 1: Holding diploma -->
                            <g class="student-frame student-frame-1">
                                <polygon points="12,18 32,8 52,18 32,28" fill="#1c1c1c" />
                                <rect x="29" y="18" width="6" height="6" fill="#1c1c1c" />
                                <line x1="32" y1="18" x2="48" y2="24" stroke="#ffeb3b" stroke-width="2" />
                                <circle cx="48" cy="24" r="2.5" fill="#ffb300" />
                                
                                <rect x="22" y="24" width="20" height="12" fill="#f1c27d" />
                                <rect x="24" y="27" width="16" height="4" fill="#1c1c1c" />
                                
                                <rect x="18" y="36" width="28" height="24" fill="#1e2229" rx="2" />
                                <polygon points="26,36 32,46 38,36" fill="#ffb300" />
                                
                                <rect x="10" y="38" width="8" height="14" fill="#1e2229" />
                                <rect x="10" y="52" width="8" height="4" fill="#f1c27d" />
                                <rect x="8" y="48" width="12" height="4" fill="#ffffff" rx="1" />
                                <rect x="13" y="48" width="2" height="4" fill="#fc5b5b" />
                                
                                <rect x="46" y="38" width="8" height="10" fill="#1e2229" />
                                <rect x="46" y="48" width="8" height="4" fill="#f1c27d" />
                                
                                <rect x="23" y="60" width="7" height="4" fill="#fc5b5b" />
                                <rect x="34" y="60" width="7" height="4" fill="#fc5b5b" />
                            </g>
                            
                            <!-- Frame 2: Swaying tassel / waving diploma -->
                            <g class="student-frame student-frame-2">
                                <polygon points="12,18 32,8 52,18 32,28" fill="#1c1c1c" />
                                <rect x="29" y="18" width="6" height="6" fill="#1c1c1c" />
                                <line x1="32" y1="18" x2="44" y2="14" stroke="#ffeb3b" stroke-width="2" />
                                <circle cx="44" cy="14" r="2.5" fill="#ffb300" />
                                
                                <rect x="22" y="24" width="20" height="12" fill="#f1c27d" />
                                <rect x="24" y="27" width="16" height="4" fill="#1c1c1c" />
                                
                                <rect x="18" y="36" width="28" height="24" fill="#1e2229" rx="2" />
                                <polygon points="26,36 32,46 38,36" fill="#ffb300" />
                                
                                <rect x="8" y="34" width="8" height="14" fill="#1e2229" />
                                <rect x="8" y="48" width="8" height="4" fill="#f1c27d" />
                                <rect x="6" y="44" width="12" height="4" fill="#ffffff" rx="1" />
                                <rect x="11" y="44" width="2" height="4" fill="#fc5b5b" />
                                
                                <rect x="46" y="34" width="8" height="12" fill="#1e2229" />
                                <rect x="46" y="46" width="8" height="4" fill="#f1c27d" />
                                
                                <rect x="23" y="60" width="7" height="4" fill="#fc5b5b" />
                                <rect x="34" y="60" width="7" height="4" fill="#fc5b5b" />
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
} 
?>
