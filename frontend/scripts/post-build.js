/**
 * Post-build step: copies static deployment assets (.htaccess, contact.php,
 * robots.txt, sitemap.xml) from /deploy into the /build output so the
 * generated build folder can be uploaded directly to Hostinger.
 */
const fs = require("fs");
const path = require("path");

const root = path.resolve(__dirname, "..");
const buildDir = path.join(root, "build");
const deployDir = path.join(root, "deploy");

if (!fs.existsSync(buildDir)) {
  console.error("[post-build] build/ folder missing. Run craco build first.");
  process.exit(1);
}

if (!fs.existsSync(deployDir)) {
  console.warn("[post-build] deploy/ folder missing — skipping.");
  process.exit(0);
}

const copy = (src, dst) => {
  fs.copyFileSync(src, dst);
  console.log(`[post-build] copied ${path.relative(root, src)} -> ${path.relative(root, dst)}`);
};

const walk = (dir, base = dir) => {
  for (const entry of fs.readdirSync(dir, { withFileTypes: true })) {
    const srcPath = path.join(dir, entry.name);
    const relPath = path.relative(base, srcPath);
    const dstPath = path.join(buildDir, relPath);
    if (entry.isDirectory()) {
      if (!fs.existsSync(dstPath)) fs.mkdirSync(dstPath, { recursive: true });
      walk(srcPath, base);
    } else {
      copy(srcPath, dstPath);
    }
  }
};

walk(deployDir);
console.log("[post-build] done.");
