/**
 * Portfolio Site Bundle Builder (2026 Edition)
 * 
 * Automates:
 * 1. CSS font-display swap injection.
 * 2. Minification of frontend and admin styles (clean-css).
 * 3. Minification of frontend and admin scripts (terser).
 * 4. Pre-compression with Gzip/Brotli.
 */

const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');
const zlib = require('zlib');

const ROOT = __dirname;
const CSS_DIR = path.join(ROOT, 'assets', 'css');
const JS_DIR = path.join(ROOT, 'assets', 'js');
const ADMIN_ASSETS_DIR = path.join(ROOT, 'admin', 'assets');

// ============================================================
// HELPERS
// ============================================================

function formatSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
    return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
}

function processCSS(filePath) {
    if (!fs.existsSync(filePath)) return '';
    let content = fs.readFileSync(filePath, 'utf8');
    
    // Inject font-display: swap to any @font-face rules that don't have it
    content = content.replace(/@font-face\s*{([^}]*)}/gi, (m, c) => {
        if (c.toLowerCase().includes('font-display')) return m;
        const trimmed = c.trim();
        const sep = (trimmed && !trimmed.endsWith(';')) ? ';' : '';
        return `@font-face{${c}${sep}font-display:swap;}`;
    });
    
    return content;
}

function runMinify(srcPath, destPath, type) {
    const tempPath = srcPath + '.tmp';
    
    if (type === 'css') {
        const processed = processCSS(srcPath);
        fs.writeFileSync(tempPath, processed);
        try {
            execSync(`npx clean-css-cli -O2 -o "${destPath}" "${tempPath}"`, { stdio: 'ignore' });
            console.log(`✓ Minified CSS: ${path.basename(srcPath)} -> ${path.basename(destPath)}`);
        } catch (e) {
            console.warn(`⚠ Clean-CSS fallback triggered for ${path.basename(srcPath)}`);
            fs.copyFileSync(tempPath, destPath);
        }
    } else if (type === 'js') {
        fs.copyFileSync(srcPath, tempPath);
        try {
            execSync(`npx -y terser "${tempPath}" -o "${destPath}" --compress passes=3,drop_console=false,unsafe=true --mangle`, {
                stdio: 'ignore',
                maxBuffer: 10 * 1024 * 1024
            });
            console.log(`✓ Minified JS: ${path.basename(srcPath)} -> ${path.basename(destPath)}`);
        } catch (e) {
            console.warn(`⚠ Terser fallback triggered for ${path.basename(srcPath)}`);
            fs.copyFileSync(tempPath, destPath);
        }
    }
    
    if (fs.existsSync(tempPath)) {
        fs.unlinkSync(tempPath);
    }
    
    // Generate pre-compressed Gzip and Brotli variants
    if (fs.existsSync(destPath)) {
        try {
            const fileContent = fs.readFileSync(destPath);
            const gzipped = zlib.gzipSync(fileContent, { level: 9 });
            fs.writeFileSync(destPath + '.gz', gzipped);
            
            if (typeof zlib.brotliCompressSync === 'function') {
                const brotli = zlib.brotliCompressSync(fileContent, {
                    params: { [zlib.constants.BROTLI_PARAM_QUALITY]: 11 }
                });
                fs.writeFileSync(destPath + '.br', brotli);
            }
        } catch (err) {
            console.warn(`⚠ Pre-compression failed for ${path.basename(destPath)}:`, err.message);
        }
    }
}

// ============================================================
// RUNNER
// ============================================================

async function run() {
    console.log('\n🚀 Starting Portfolio Asset Optimization Builder...\n');

    const tasks = [
        { src: path.join(CSS_DIR, 'style.css'), dest: path.join(CSS_DIR, 'style.min.css'), type: 'css' },
        { src: path.join(JS_DIR, 'main.js'), dest: path.join(JS_DIR, 'main.min.js'), type: 'js' },
        { src: path.join(ADMIN_ASSETS_DIR, 'admin.css'), dest: path.join(ADMIN_ASSETS_DIR, 'admin.min.css'), type: 'css' },
        { src: path.join(ADMIN_ASSETS_DIR, 'admin.js'), dest: path.join(ADMIN_ASSETS_DIR, 'admin.min.js'), type: 'js' }
    ];

    tasks.forEach(task => {
        if (fs.existsSync(task.src)) {
            const inSize = fs.statSync(task.src).size;
            runMinify(task.src, task.dest, task.type);
            const outSize = fs.existsSync(task.dest) ? fs.statSync(task.dest).size : 0;
            console.log(`   📊 Size: ${formatSize(inSize).padStart(8)} -> ${formatSize(outSize).padStart(8)}\n`);
        } else {
            console.warn(`⚠ Source file not found: ${task.src}`);
        }
    });

    console.log('✨ Asset bundling and minification complete!');
}

run().catch(console.error);
