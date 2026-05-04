# Krystal Ingredients — Corporate Website

Production-ready corporate site for **Krystal Ingredients Pvt. Ltd. (KIPL)**, a wholly-owned specialty-chemicals subsidiary of Gem Aromatics Ltd.

Stack: React 19 + Tailwind CSS 3 + Framer Motion (CRA + craco). Output is a static bundle; the only server-side piece is a single PHP endpoint for the contact form, which works out of the box on Hostinger shared hosting.

---

## 1. Project layout

```
frontend/
├── deploy/                ← drop-in files (.htaccess, contact.php, robots.txt, sitemap.xml)
├── public/                ← favicon, manifest, index.html template
├── scripts/
│   └── post-build.js      ← copies deploy/ into build/ after craco build
├── src/
│   ├── components/
│   │   ├── kipl/          ← navbar, footer, scroll-progress, molecular scene, headers
│   │   ├── sections/      ← hero, about, products, industries, manufacturing, etc.
│   │   └── ui/            ← shadcn primitives (radix wrappers)
│   ├── pages/             ← HomePage, ProductsPage, ManufacturingPage, …
│   ├── lib/               ← static data, animation variants, fetch client
│   ├── App.js             ← router + page transitions + scroll progress
│   ├── App.css
│   ├── index.css          ← global theme, Tailwind layers, motion keyframes
│   └── index.js
├── craco.config.js
├── tailwind.config.js
├── postcss.config.js
└── package.json
```

The `backend/` folder from the scaffold is **not used in production** — the contact form goes through `deploy/contact.php` instead. You can delete `backend/` before uploading.

---

## 2. Local development

```bash
cd frontend
npm install        # or: yarn install
npm start          # opens http://localhost:3000
```

Hot-reload, ESLint and source maps are enabled in dev mode.

---

## 3. Production build

```bash
cd frontend
npm install
npm run build
```

After the command finishes, `frontend/build/` contains the **complete deployable bundle**:

```
build/
├── index.html
├── favicon.svg
├── site.webmanifest
├── robots.txt
├── sitemap.xml
├── contact.php          ← form handler
├── .htaccess            ← SPA routing, caching, security
└── static/              ← hashed JS/CSS/media
```

The post-build script (`scripts/post-build.js`) automatically copies `deploy/.htaccess`, `deploy/contact.php`, `robots.txt` and `sitemap.xml` into `build/` so you can upload the folder as-is.

---

## 4. Deploying to Hostinger (shared hosting / subdomain)

### Option A — File Manager (fastest)

1. Log in to your Hostinger **hPanel**.
2. Go to **Hosting → Domains → Subdomains**, create the subdomain (e.g. `kipl.yourdomain.com`). Note the **document root** Hostinger assigns it (typically `/public_html/kipl`).
3. Open **File Manager**, navigate into that document root, and **delete** any default `default.php` / `index.html` files.
4. Open `frontend/build/` on your local machine, select **all** files (including the hidden `.htaccess`), zip them, and upload the zip.
5. Right-click the uploaded zip in File Manager → **Extract** → into the same folder.
6. Delete the zip. Done — visit your subdomain.

> ⚠️ Make sure hidden files are visible in File Manager (View → Show hidden files) so `.htaccess` uploads correctly.

### Option B — FTP / SFTP

1. Connect with FileZilla / WinSCP using the FTP credentials from hPanel.
2. Upload the **contents** of `frontend/build/` (not the `build` folder itself) into the subdomain document root.
3. Verify `.htaccess` and `contact.php` made it across (FileZilla → Server → Force showing hidden files).

### Option C — Hostinger Git deployment

1. Push `frontend/build/` into a separate `dist` branch.
2. In hPanel → **Git** → connect the repo and set the deploy path to your subdomain document root.
3. Hostinger pulls every push into the live folder.

---

## 5. Configuring the contact form

`deploy/contact.php` works on Hostinger out of the box — `mail()` is enabled on every plan. Before the first deploy:

1. Open `deploy/contact.php` and edit the top of the file:
   ```php
   $RECIPIENT = 'inquiry@krystalingredients.com';   // where leads should land
   $SMTP_FROM = 'no-reply@krystalingredients.com';  // a mailbox that exists on your domain
   ```
2. Create the mailbox `no-reply@yourdomain.com` in **hPanel → Emails → Email Accounts**. Hostinger will sign outgoing mail with SPF/DKIM automatically.
3. (Optional) For higher deliverability, swap the bottom of `contact.php` to use **PHPMailer** with Hostinger SMTP creds. The current version uses native `mail()` which is fine for moderate volumes.

The form payload is also persisted to `inquiries.log` (next to `contact.php`). The log path can be moved above the web root by changing `$LOG_PATH`. The `.htaccess` already blocks direct access to `inquiries.log`.

---

## 6. Subdomain vs. root domain

The build is **path-agnostic** — `package.json` ships with `"homepage": "./"` so all asset URLs resolve relative to wherever you upload the bundle. No rebuild needed when switching between root and subdomain.

If you later move the site to a sub-path (e.g. `yourdomain.com/kipl/`) and want pretty URLs, change the `BrowserRouter` in `src/App.js` to use a `basename`:

```jsx
<BrowserRouter basename="/kipl">
```

…then rebuild.

---

## 7. Performance & SEO checklist (already wired)

- ✅ Long-cache (`max-age=31536000, immutable`) on hashed JS/CSS, no-cache on HTML.
- ✅ Brotli + gzip via `mod_deflate` / `mod_brotli`.
- ✅ HTTP → HTTPS forced. HSTS, X-Frame-Options, Referrer-Policy and Permissions-Policy set.
- ✅ Critical CSS inlined; pre-loader avoids FOUC.
- ✅ Open Graph + Twitter card meta + JSON-LD `Organization` schema.
- ✅ `robots.txt`, `sitemap.xml` shipped.
- ✅ Reduced-motion preferences honoured globally.
- ✅ Lazy-loaded section imagery, AVIF-ready (Unsplash CDN).

---

## 8. Customisation cheat-sheet

| What you want to change            | File                                                       |
| ---------------------------------- | ---------------------------------------------------------- |
| Site title / SEO description       | `frontend/public/index.html`                               |
| Brand colours, fonts               | `frontend/tailwind.config.js`, `frontend/src/index.css`    |
| Navigation links                   | `frontend/src/lib/data.js` → `NAV_LINKS`                   |
| Product catalogue copy             | `frontend/src/lib/data.js` → `PRODUCTS`                    |
| Industry tiles / images            | `frontend/src/lib/data.js` → `INDUSTRIES`                  |
| Timeline milestones                | `frontend/src/lib/data.js` → `TIMELINE`                    |
| Compliance badges (marquee strip)  | `frontend/src/lib/data.js` → `COMPLIANCE_BADGES`           |
| Contact form recipient             | `frontend/deploy/contact.php` → `$RECIPIENT`               |
| Office addresses & phone           | `frontend/src/components/sections/ContactForm.jsx`         |
| Hero headline / sub-copy           | `frontend/src/components/sections/Hero.jsx`                |
| Footer columns                     | `frontend/src/components/kipl/MegaFooter.jsx`              |

---

## 9. Browser support

- Chrome, Edge, Firefox, Safari — last 2 versions.
- iOS Safari 14+, Android Chrome 90+.
- Graceful degradation: animations fall back to static content under `prefers-reduced-motion`.

---

## 10. License & attribution

All product copy, brand naming and design system are © Krystal Ingredients Pvt. Ltd. Photography is sourced from Unsplash under the Unsplash license — replace with proprietary plant / lab photography before the public launch.
