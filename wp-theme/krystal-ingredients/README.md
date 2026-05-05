# Krystal Ingredients — WordPress Theme

A custom, motion-rich WordPress theme for **Krystal Ingredients Pvt. Ltd. (KIPL)** — premium chemical-industry aesthetic, fully editable from the WordPress Customizer plus four custom post types (Products, Industries, Timeline, Insights).

- **No page builders.** Hand-coded PHP templates, Tailwind CSS via the Play CDN for utilities.
- **Tier 1 / 2 / 3 motion stack:** GSAP + ScrollTrigger for scroll choreography, Lenis for smooth scroll, Three.js for the WebGL hero molecule, vanilla JS for cursor / magnetic / tilt / counters / split-text.
- **Zero plugin dependencies.** Customizer + native CPTs handle everything; WP Mail SMTP recommended (not required) for transactional email.
- **13 homepage sections out of the box** — Hero, Numbers strip, About + Timeline, Products, Industries bento, Manufacturing hotspots, Leadership Quote, Sustainability, R&D, Insights, Awards / Press, Compliance marquee, Contact.

---

## 1. Folder structure

```
krystal-ingredients/
├── style.css                 # Theme header (required)
├── functions.php             # Theme bootstrap + module loader
├── index.php                 # Generic loop / archive / search fallback
├── front-page.php            # Homepage composition
├── page.php                  # Generic page template
├── single.php                # Single post
├── archive.php               # Delegates to index.php
├── search.php                # Delegates to index.php
├── searchform.php            # Search input
├── 404.php                   # Off-spec page
├── comments.php              # Themed comments
├── header.php                # Glassmorphism nav
├── footer.php                # Mega footer
├── inc/
│   ├── helpers.php           # kipl_field(), kipl_image(), kipl_icon(), defaults
│   ├── enqueue.php           # Tailwind CDN, GSAP, fonts, theme JS/CSS
│   ├── customizer.php        # Customizer panels for every editable string
│   ├── post-types.php        # Products, Industries, Timeline CPTs + meta
│   └── inquiry-endpoint.php  # /wp-json/kipl/v1/inquiry REST endpoint
├── template-parts/
│   ├── section-hero.php             # Three.js molecule + liquid orb + split-text
│   ├── section-numbers.php          # Animated counter strip
│   ├── section-about.php            # Group + 3 pillars + timeline
│   ├── section-products.php         # Pinned horizontal scroll catalog
│   ├── section-industries.php       # Bento grid + diagonal mask reveals
│   ├── section-manufacturing.php    # Dahej facility + interactive hotspots
│   ├── section-quote.php            # Leadership pull-quote
│   ├── section-sustainability.php   # ESG pillars + report CTA
│   ├── section-rnd.php              # Lab + capabilities
│   ├── section-insights.php         # Newsroom teaser
│   ├── section-awards.php           # Awards / press strip
│   ├── section-compliance.php       # Compliance marquee
│   └── section-contact.php          # AJAX inquiry form
└── assets/
    ├── css/
    │   ├── main.css          # Animations, glassmorphism, form styles
    │   └── editor.css        # Block-editor preview styles
    └── js/
        └── main.js           # GSAP reveals, hero choreography, AJAX form
```

---

## 2. Prerequisites

- A Hostinger Premium / Business / Cloud plan with **WordPress** installed (one-click via hPanel).
- PHP 7.4+ (the theme targets 7.4–8.3).
- WordPress 6.0+.
- An existing email mailbox on your domain (`inquiry@yourdomain.com`) so the contact form notifications send cleanly.

No plugins are required. WP Mail SMTP is **optional** but recommended for higher email deliverability.

---

## 3. Zip & upload — three options

### Option A — Hostinger File Manager (fastest)

1. On your local machine, zip the **`krystal-ingredients/`** folder so the resulting `krystal-ingredients.zip` contains `style.css` at its root (not a nested folder).
   - Windows: select all files inside `krystal-ingredients/` → right-click → **Send to → Compressed (zipped) folder** → rename to `krystal-ingredients.zip`.
   - macOS: select the `krystal-ingredients` folder itself → right-click → **Compress**.
2. Log in to **Hostinger hPanel → Hosting → Manage** for the domain hosting WordPress.
3. Open **WordPress → Edit Site (wp-admin)** → **Appearance → Themes → Add New → Upload Theme**.
4. Choose `krystal-ingredients.zip`, click **Install Now**, then **Activate**.

> If Hostinger blocks zip uploads above ~10 MB, use Option B.

### Option B — File Manager direct upload

1. In hPanel, open **Files → File Manager**.
2. Navigate to **`/public_html/wp-content/themes/`**.
3. Click **Upload Files** → upload `krystal-ingredients.zip`.
4. Right-click the zip → **Extract** → confirm into the `themes/` folder.
5. Delete the zip. You should see `wp-content/themes/krystal-ingredients/` containing `style.css`.
6. In wp-admin → **Appearance → Themes** → hover over **Krystal Ingredients** → **Activate**.

### Option C — FTP / SFTP

1. Connect with FileZilla / WinSCP using your hPanel FTP credentials.
2. Drop the `krystal-ingredients/` folder into `/public_html/wp-content/themes/`.
3. Activate from wp-admin → Appearance → Themes.

---

## 3.5. Replacing an existing Elementor / page-builder build

If your subdomain currently runs Elementor (or any page builder) and you want
to switch to this theme without breaking anything, follow this **safe
swap-and-verify sequence** rather than deleting plugins first.

### Why not just delete Elementor?

Pages built with Elementor store their layout as a serialised structure
inside `post_content`. Without Elementor's CSS/JS the rendered output looks
broken. You want our theme rendering the homepage *before* you remove
Elementor — that way you can verify everything works before tearing
anything out.

### The sequence

1. **Take a backup first.** hPanel → **Files → Backups** (or use a plugin
   like UpdraftPlus). Hostinger's daily backups are also a fallback.

2. **Note your current Elementor pages.** wp-admin → **Pages**. Anything
   labelled "Edited with Elementor" will need to be either re-created in our
   theme later or deleted. The homepage doesn't matter — our `front-page.php`
   takes priority over any page-builder homepage automatically.

3. **Activate the Krystal Ingredients theme.** Upload + activate via
   Appearance → Themes (see Section 3 above). The homepage flips immediately
   to our design — Elementor is no longer rendering it.

4. **Walk every URL** on the live site (Home, any inner pages, the contact
   page, blog posts if any). Anything that still looks unstyled is a page
   that *needs* Elementor's CSS/JS to render.

5. **Deactivate Elementor (don't delete).** wp-admin → **Plugins** → find
   "Elementor" + "Elementor Pro" → **Deactivate**. Reload every page you
   walked in step 4. If everything still works, you're safe.

   - Anything that breaks at this point is a page that depends on Elementor.
     Your options are: rebuild that page using our theme's `page.php` +
     Gutenberg blocks, **or** keep Elementor activated for those pages only.

6. **Delete Elementor (when ready).** Once you've confirmed nothing depends
   on it, hit **Delete** on Elementor + Elementor Pro. This removes
   ~400 KB of plugin assets from every page load.

7. **Edit Settings → General.** Set **Site Title** to *Krystal Ingredients*
   and **Tagline** to your preferred byline (e.g. *Specialty chemistry,
   engineered for tomorrow*). The previous title `KIPL version` was a
   placeholder.

8. **Open Customizer.** Appearance → Customize → **KIPL · Site Content**.
   Walk through panels 01 → 14, dropping in the real copy and images. A few
   panels reference custom post types — those are managed in the sidebar
   (Products, Industries, Timeline, Insights).

### Should I keep Elementor for one-off pages?

Generally **no** — our theme has Gutenberg block styles tuned to match the
brand (see `assets/css/editor.css`), and any page you build with Gutenberg
will render natively without needing a page builder. The exception is if
you have a complex one-off landing page (e.g. an event page) that's faster
to lay out visually — in that case, keep Elementor active and re-deactivate
when done.

---

## 4. After activation — first-run

1. The theme will **auto-create a `Home` page** and set it as the static homepage. If you already have a homepage, edit **Settings → Reading → Your homepage displays** and pick whichever page you want.
2. Sample **Products**, **Industries** and **Timeline** items are seeded automatically the first time an admin loads wp-admin.
3. Visit **Appearance → Customize → KIPL · Site Content** to edit every section copy, image, CTA and contact detail. Changes are grouped into ten panels (`01 · Hero` through `10 · Footer`).
4. Visit **Products / Industries / Timeline** in the WP sidebar to add, remove, reorder or replace the seeded content. The “Order” field on each item controls the display order on the homepage.
5. Add featured images to **Industries** to populate the bento grid backgrounds. Add a featured image to the Manufacturing image (Customizer → 05 · Manufacturing) and R&D image (Customizer → 07 · R&D).

---

## 5. Editing the homepage — quick reference

| Section            | Where to edit                                                                |
| ------------------ | ---------------------------------------------------------------------------- |
| Hero               | Customizer → KIPL · Site Content → 01 · Hero                                  |
| About + Pillars    | Customizer → 02 · About / Group                                               |
| Two Brands narrative | Customizer → 2A · Two Brands (Gem + KIPL)                                   |
| Timeline events    | wp-admin → Timeline                                                           |
| Products intro     | Customizer → 03 · Products (intro)                                            |
| Product cards      | wp-admin → Products                                                           |
| Industries intro   | Customizer → 04 · Industries (intro)                                          |
| Industry tiles     | wp-admin → Industries (set tile size in the right meta box)                   |
| Manufacturing      | Customizer → 05 · Manufacturing — Dahej                                       |
| Sustainability     | Customizer → 06 · Sustainability / ESG                                        |
| R&D                | Customizer → 07 · R&D / Innovation                                            |
| Compliance badges  | Customizer → 08 · Compliance Strip (comma-separated list)                     |
| Contact + offices  | Customizer → 09 · Contact                                                     |
| Footer blurb       | Customizer → 10 · Footer                                                      |
| Numbers strip      | Customizer → 11 · Numbers Strip (4 animated counters)                         |
| Awards / press     | Customizer → 12 · Awards / Press (comma-separated)                            |
| Leadership quote   | Customizer → 13 · Leadership Quote                                            |
| Insights intro     | Customizer → 14 · Insights / Newsroom (intro)                                 |
| Insight articles   | wp-admin → Insights (kicker + reading-time meta on each)                      |
| Site logo          | Customizer → Site Identity → Logo                                             |
| Primary navigation | Appearance → Menus → assign menu to **Primary Navigation**                    |
| Footer navigation  | Appearance → Menus → assign menu to **Footer Navigation**                     |

---

## Motion / effect stack (what's running on every visitor's screen)

**Tier 1 — Always on (vanilla JS, ~10 KB):**
- Magnetic CTAs, tilt cards, custom emerald cursor, split-text hero, animated stat counters,
  marquee with hover-reverse direction, glassmorphism nav, scroll-progress bar.

**Tier 2 — Scroll choreography (Lenis + GSAP ScrollTrigger):**
- Lenis smooth scroll, pinned horizontal product rail, scroll-scrubbed hero rotation,
  diagonal mask-reveal on industry tiles, GSAP-driven section reveals.

**Tier 3 — WebGL (Three.js, desktop-only):**
- Real 3D molecule in the hero (octahedral atom geometry, lit, mouse-parallax, rotating),
  liquid gradient orb canvas drifting behind the hero. Both gracefully fall back to the
  pure-SVG hero on mobile, low-power devices, or `prefers-reduced-motion`.

All of it honours `prefers-reduced-motion` — animations pause, the WebGL scene doesn't boot,
the cursor is hidden, and reveals snap in instantly.

---

## 6. Contact form

Submissions hit `POST /wp-json/kipl/v1/inquiry` (handled in `inc/inquiry-endpoint.php`):

- Validates the payload, blocks the honeypot, rate-limits per-IP (1 / 30 s).
- Saves each lead as a `kipl_inquiry` post — visible in **wp-admin → Inquiries**.
- Sends a notification to the address set in **Customizer → 09 · Contact → Inquiry email**.
- Emails an auto-responder with a `KIPL-XXXXXXXX` reference number.

Mail goes through `wp_mail()`. On Hostinger this routes through your domain mailbox if one exists; for higher deliverability install **WP Mail SMTP** and point it at Hostinger SMTP (smtp.hostinger.com:465, SSL, your inbox creds).

---

## 7. Customising colours, fonts, content width

- **Colours:** edit the `colors.kipl.*` block in `inc/enqueue.php` (Tailwind config) and the `:root` variables in `assets/css/main.css`.
- **Fonts:** swap the Google Fonts URL in `inc/enqueue.php` and update the `fontFamily` block in the same file. Default stack is `Space Grotesk` (display) + `Inter` (body) + `JetBrains Mono` (mono).
- **Container width:** change `max-w-7xl` on the section wrappers in `template-parts/section-*.php` if you want a wider canvas.

---

## 8. Going to production (optional polish)

1. Install **WP Mail SMTP** for reliable transactional email.
2. Install **Yoast SEO** or **Rank Math** for sitemap + schema beyond what the theme provides.
3. Install a caching plugin (LiteSpeed Cache ships with Hostinger and pairs well with the CDN scripts here).
4. Replace the Tailwind Play CDN with a compiled CSS file once your design is locked. The CDN is fine for low/medium traffic; the warning in the console is not a runtime issue.
5. Replace the placeholder mailto/phone defaults via the Customizer.
6. Add real photography to **Industries** featured images, the Manufacturing image, and the R&D image.

---

## 9. Removing the theme cleanly

If you uninstall and want the seed content gone too: WP-CLI one-liner from the Hostinger SSH terminal —

```bash
wp post delete $(wp post list --post_type=kipl_product,kipl_industry,kipl_timeline,kipl_inquiry --format=ids) --force
wp option delete kipl_seeded_v1
```

Or in PHP, drop those rows manually from **Tools → Database** in hPanel.

---

## 10. Browser support

- Chrome, Edge, Firefox, Safari — last 2 versions.
- iOS Safari 14+, Android Chrome 90+.
- Honours `prefers-reduced-motion` — molecules pause, reveals snap in instantly.
