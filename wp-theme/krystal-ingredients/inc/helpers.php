<?php
/**
 * Helpers — small utilities used across templates.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Curated defaults for every Customizer setting. Keeping these in one place
 * means the theme renders gracefully on a fresh install before the client
 * has touched anything in the Customizer.
 */
function kipl_defaults() {
    return [
        // Brand
        'brand_short'              => 'KIPL',
        'brand_long'               => 'Krystal Ingredients',
        'brand_tag'                => 'Specialty Chemistry · Mumbai · Dahej · Worldwide',

        // Hero
        'hero_eyebrow'             => 'Specialty Chemistry · Mumbai · Dahej · Worldwide',
        'hero_title_a'             => 'The molecules',
        'hero_title_accent'        => 'behind',
        'hero_title_b'             => 'modern formulation.',
        'hero_sub'                 => 'From flavours and fragrances to pharmaceuticals and personal care — Krystal Ingredients delivers high-purity specialty chemistry to the world\'s most demanding formulators. Engineered in India. Trusted globally.',
        'hero_cta_primary_label'   => 'Explore Our Catalogue',
        'hero_cta_primary_link'    => '#products',
        'hero_cta_secondary_label' => 'Speak with Our Experts',
        'hero_cta_secondary_link'  => '#contact',
        'hero_stat_1_value'        => '25+',
        'hero_stat_1_label'        => 'Years of group legacy',
        'hero_stat_2_value'        => '42',
        'hero_stat_2_label'        => 'Countries served',
        'hero_stat_3_value'        => '₹230 Cr',
        'hero_stat_3_label'        => 'Dahej facility investment',
        'hero_stat_4_value'        => '99.5%',
        'hero_stat_4_label'        => 'Typical assay purity',

        // About
        'about_eyebrow'      => 'About KIPL · A Gem Aromatics Company',
        'about_title_a'      => 'Decades of chemistry.',
        'about_title_accent' => 'A future built on precision.',
        'about_body'         => 'Krystal Ingredients Pvt. Ltd. is the next-generation specialty chemical arm of Gem Aromatics Ltd., one of India\'s most respected names in essential oils and aroma chemistry. We combine 25+ years of operational depth with a clean-sheet engineering mandate — to build the most precise, traceable, and sustainable specialty chemistry platform serving global markets.',
        'about_pillar_1_title' => 'Global Reach',
        'about_pillar_1_body'  => 'Trusted by formulators across 42 countries — from independent perfume houses to Fortune 500 manufacturers.',
        'about_pillar_2_title' => 'Pedigree Expertise',
        'about_pillar_2_body'  => 'Operational, financial, and technical strength inherited from a 25-year-old listed parent group.',
        'about_pillar_3_title' => 'Engineered for Scale',
        'about_pillar_3_body'  => 'A purpose-built ₹230 Cr Dahej plant designed for continuous-flow chemistry from day one.',

        // Products
        'products_eyebrow' => 'Products · Catalogue 2026',
        'products_title'   => 'Precision chemistry, packaged for the world\'s formulators.',
        'products_sub'     => 'Five product families — high-purity grades, batch-traceable documentation, and the option to develop entirely bespoke molecules under NDA.',

        // Industries
        'industries_eyebrow' => 'Industries We Power',
        'industries_title'   => 'Quietly inside the products you trust.',
        'industries_sub'     => 'From perfumery bases to pharmaceutical intermediates and food-grade aroma — our molecules sit inside category-defining brands across every continent.',

        // Manufacturing
        'mfg_eyebrow' => 'Manufacturing · Dahej · Gujarat',
        'mfg_title'   => 'A continuous-processing facility built for the next decade.',
        'mfg_sub'     => 'Our ₹230 Cr Dahej plant is engineered around continuous-flow reactors, multi-stage fractional distillation, and an in-line analytical suite — designed to ship metric-tonne quantities at laboratory purity.',
        'mfg_h1_title' => 'Continuous-Flow Production',
        'mfg_h1_body'  => 'Automated batch & continuous reactors with in-line process analytics, delivering >99% conversion at scale.',
        'mfg_h2_title' => 'Tonne-Scale Capacity',
        'mfg_h2_body'  => 'Multi-thousand tonne annual throughput across primary, intermediate, and finishing streams — without sacrificing purity.',
        'mfg_h3_title' => 'Global-Grade Safety',
        'mfg_h3_body'  => 'Designed against IEC, OISD and international PSM standards. ISO 45001 occupational safety baked into every workflow.',

        // Sustainability
        'sus_eyebrow'      => 'Quality · Compliance · Sustainability',
        'sus_title'        => 'Specialty chemistry has to be cleaner. We engineered it to be.',
        'sus_sub'          => 'Sustainability isn\'t a corporate veneer at KIPL — it\'s built into our process architecture. Closed-loop solvent recovery, water reuse, real-time emissions monitoring, and supply-chain audits across every tier.',
        'sus_p1_title'     => 'Closed-Loop Manufacturing',
        'sus_p1_body'      => 'Solvent recovery >92%, water-recycle ratio >85%, and waste minimisation protocols benchmarked against the GreenChem framework.',
        'sus_p2_title'     => 'Global Compliance',
        'sus_p2_body'      => 'ISO 9001 / 14001 / 45001, REACH (EU), FDA DMF, FSSC 22000, GMP, Kosher and Halal — documented per molecule, audited per shipment.',
        'sus_p3_title'     => 'Responsible Sourcing',
        'sus_p3_body'      => 'Tier-2 supplier audits, EcoVadis-aligned procurement scoring, and full traceability on naturally-derived inputs.',
        'sus_report_url'   => '#',

        // R&D
        'rnd_eyebrow' => 'R&D · Custom Synthesis',
        'rnd_title'   => 'A laboratory that ships at industrial scale.',
        'rnd_sub'     => 'Our R&D group runs proprietary synthesis programs across natural-identical compounds, phenol derivatives, and bespoke specialty intermediates — taking molecules from milligram bench prep to metric-tonne campaign in a single, validated pipeline.',
        'rnd_c1_title' => 'Bench → Pilot → Commercial',
        'rnd_c1_body'  => 'Validated scale-up from gram to metric tonne through dedicated pilot reactors and pre-commercial campaigns.',
        'rnd_c2_title' => 'Custom Molecules · NDA',
        'rnd_c2_body'  => 'Proprietary syntheses developed under strict confidentiality for flavour, fragrance and pharma formulators.',
        'rnd_c3_title' => 'Analytical Suite',
        'rnd_c3_body'  => 'In-house GC-MS, HPLC, FTIR and 400 MHz NMR — full spectroscopic traceability with each Certificate of Analysis.',

        // Compliance
        'compliance_label' => 'Global Compliance',
        'compliance_sub'   => 'Certified. Documented. Audited.',
        'compliance_list'  => 'ISO 9001, ISO 14001, ISO 45001, REACH, FSSC 22000, GMP, Kosher, Halal, FDA DMF, EcoVadis',

        // Contact
        'contact_eyebrow' => 'Contact · Global Inquiry',
        'contact_title'   => 'Let\'s engineer your next ingredient together.',
        'contact_sub'     => 'Whether you\'re sourcing a catalogue molecule at tonne-scale or briefing a custom synthesis, our team responds within one business day.',
        'contact_email'   => 'inquiry@krystalingredients.com',
        'contact_phone'   => '+91 22 0000 0000',
        'office_hq_label' => 'Headquarters',
        'office_hq_city'  => 'Mumbai, Maharashtra',
        'office_hq_country' => 'India',
        'office_mfg_label' => 'Manufacturing',
        'office_mfg_city'  => 'Dahej, Gujarat',
        'office_mfg_country' => 'India',

        // Footer
        'footer_blurb' => 'Krystal Ingredients Pvt. Ltd. is the specialty-chemistry arm of Gem Aromatics Ltd. — engineered in India, trusted across 42 countries.',

        // Numbers strip (new)
        'numbers_eyebrow' => 'By the numbers',
        'numbers_title'   => 'A scale story, not a story about scale.',
        'numbers_1_value' => '99.5',
        'numbers_1_suffix'=> '%',
        'numbers_1_label' => 'Typical assay purity across the catalogue',
        'numbers_2_value' => '230',
        'numbers_2_suffix'=> ' Cr',
        'numbers_2_label' => 'INR invested in the Dahej continuous-flow plant',
        'numbers_3_value' => '42',
        'numbers_3_suffix'=> '',
        'numbers_3_label' => 'Countries shipped to in the last fiscal year',
        'numbers_4_value' => '180',
        'numbers_4_suffix'=> '+',
        'numbers_4_label' => 'Active SKUs across five product families',

        // Awards / Press strip (new)
        'awards_label' => 'Recognition · Press · Industry',
        'awards_sub'   => 'Coverage and accreditation from across the chemicals world.',
        'awards_list'  => 'CHEMEXCIL Gold · 2025, EcoVadis Silver · 2024, FICCI Industry Recognition · 2024, Chemical Today · Featured Manufacturer · 2025, Indian Chemical Council · Member, Responsible Care · Signatory',

        // Testimonial / Leadership quote (new)
        'quote_eyebrow' => 'From the leadership',
        'quote_body'    => 'We started Krystal Ingredients with a single brief — to build a specialty-chemistry platform that European and American formulators would specify by name. Every reactor, every column, every certificate of analysis is engineered against that promise.',
        'quote_author'  => 'Managing Director',
        'quote_role'    => 'Krystal Ingredients Pvt. Ltd.',

        // Insights teaser (new)
        'insights_eyebrow' => 'Insights · Newsroom',
        'insights_title'   => 'Field notes from the laboratory floor.',
        'insights_sub'     => 'Technical bulletins, application notes, and announcements from our chemistry, manufacturing, and sustainability teams.',

        // Two Brands narrative (new)
        'two_brands_eyebrow' => 'One Group · Two Specialised Brands',
        'two_brands_title'   => 'A 25-year aroma chemistry legacy, paired with a clean-sheet specialty platform.',
        'two_brands_sub'     => 'Gem Aromatics gives our customers four decades of essential-oil and aroma-chemical heritage. Krystal Ingredients gives them a purpose-built, continuous-flow specialty plant designed for the chemistries of the next decade.',
        'gem_label'          => 'Gem Aromatics Limited',
        'gem_year'           => 'Since 1997',
        'gem_blurb'          => 'A publicly-listed specialist in essential oils and aroma chemicals. Trusted by perfume houses and flavour formulators across India, Europe and North America for over two decades.',
        'gem_link_label'     => 'Visit gemaromatics.com',
        'gem_link'           => 'https://gemaromatics.com',
        'kipl_label'         => 'Krystal Ingredients Pvt. Ltd.',
        'kipl_year'          => 'Since 2023',
        'kipl_blurb'         => 'The next-generation specialty-chemistry arm — purpose-built around continuous-flow reactors, custom synthesis, and pharmaceutical-grade documentation at industrial scale.',
        'kipl_link_label'    => 'Explore the catalogue',
        'kipl_link'          => '#products',
    ];
}

/**
 * Customizer field reader with default fallback.
 *
 * @param string $key
 * @return string
 */
function kipl_field( $key ) {
    $defaults = kipl_defaults();
    $default  = $defaults[ $key ] ?? '';
    $value    = get_theme_mod( $key, $default );
    return is_string( $value ) ? trim( $value ) : $value;
}

/**
 * Pull an attachment ID from the Customizer (or theme default fallback).
 *
 * @param string $key
 * @return int
 */
function kipl_image_id( $key ) {
    $val = get_theme_mod( $key, 0 );
    return absint( $val );
}

/**
 * Render an attachment image with sane defaults; falls back to a remote
 * placeholder so the design holds on a fresh install with no media set.
 *
 * @param string $key       Customizer setting name.
 * @param string $size      WP image size.
 * @param string $fallback  External URL fallback.
 * @param string $alt       Alt text.
 * @param array  $attr      Additional <img> attributes.
 */
function kipl_image( $key, $size = 'large', $fallback = '', $alt = '', $attr = [] ) {
    $id = kipl_image_id( $key );
    if ( $id ) {
        $attr_string = '';
        foreach ( $attr as $k => $v ) {
            $attr_string .= sprintf( ' %s="%s"', esc_attr( $k ), esc_attr( $v ) );
        }
        echo wp_get_attachment_image( $id, $size, false, array_merge( [ 'alt' => $alt ], $attr ) );
        return;
    }
    if ( $fallback ) {
        $attr_string = '';
        foreach ( $attr as $k => $v ) {
            $attr_string .= sprintf( ' %s="%s"', esc_attr( $k ), esc_attr( $v ) );
        }
        printf(
            '<img src="%1$s" alt="%2$s" loading="lazy"%3$s />',
            esc_url( $fallback ),
            esc_attr( $alt ),
            $attr_string
        );
    }
}

/**
 * Inline SVG icon (lucide-aligned). Caches reads for the request.
 *
 * @param string $name  Icon name (e.g. arrow-right, check, leaf).
 * @param array  $attrs Optional attributes (class, stroke-width).
 */
function kipl_icon( $name, $attrs = [] ) {
    static $cache = [];

    $defaults = [
        'class'        => 'w-5 h-5',
        'stroke-width' => '1.6',
    ];
    $attrs = array_merge( $defaults, $attrs );

    $icons = $cache ?: kipl_icon_set();
    $cache = $icons;
    $svg   = $icons[ $name ] ?? '';
    if ( ! $svg ) {
        return '';
    }

    $extra = sprintf(
        ' class="%s" stroke-width="%s"',
        esc_attr( $attrs['class'] ),
        esc_attr( $attrs['stroke-width'] )
    );
    echo str_replace( '<svg', '<svg' . $extra, $svg );
}

/**
 * The icon set is intentionally tiny — only what the theme needs.
 */
function kipl_icon_set() {
    return [
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
        'arrow-up-right' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>',
        'check' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>',
        'menu' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16"/><path d="M4 12h16"/><path d="M4 18h16"/></svg>',
        'x' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
        'globe' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14 14 0 0 0 0 20"/><path d="M12 2a14 14 0 0 1 0 20"/><path d="M2 12h20"/></svg>',
        'gem' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3h12l4 6-10 13L2 9Z"/><path d="M11 3 8 9l4 13 4-13-3-6"/><path d="M2 9h20"/></svg>',
        'factory' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/></svg>',
        'leaf' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19.2 2.96a1 1 0 0 1 1.6.8c0 6.79-7.2 13.8-9.8 16.24Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6"/></svg>',
        'shield' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1Z"/><path d="m9 12 2 2 4-4"/></svg>',
        'handshake' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/></svg>',
        'flask' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10 2v7.31"/><path d="M14 9.3V1.99"/><path d="M8.5 2h7"/><path d="M14 9.3a6.5 6.5 0 1 1-4 0"/><path d="M5.52 16h12.96"/></svg>',
        'atom' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><path d="M20.2 20.2c2.04-2.03.02-7.36-4.5-11.9-4.54-4.52-9.87-6.54-11.9-4.5-2.04 2.03-.02 7.36 4.5 11.9 4.54 4.52 9.87 6.54 11.9 4.5"/><path d="M15.7 15.7c4.52-4.54 6.54-9.87 4.5-11.9-2.03-2.04-7.36-.02-11.9 4.5-4.52 4.54-6.54 9.87-4.5 11.9 2.03 2.04 7.36.02 11.9-4.5"/></svg>',
        'microscope' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M6 18h8"/><path d="M3 22h18"/><path d="M14 22a7 7 0 1 0 0-14h-1"/><path d="M9 14h2"/><path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"/><path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"/></svg>',
        'cpu' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><path d="M15 2v2"/><path d="M15 20v2"/><path d="M2 15h2"/><path d="M2 9h2"/><path d="M20 15h2"/><path d="M20 9h2"/><path d="M9 2v2"/><path d="M9 20v2"/></svg>',
        'zap' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>',
        'pin' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>',
        'mail' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        'phone' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'download' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>',
        'mouse' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="7"/><path d="M12 6v4"/></svg>',
        'spinner' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>',
        'check-circle' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>',
    ];
}

/**
 * Tiny logo SVG used in nav and footer.
 */
function kipl_logo_mark( $stroke = '#10B981', $size = 36 ) {
    printf(
        '<svg viewBox="0 0 40 40" width="%1$d" height="%1$d" aria-hidden="true">
            <polygon points="20,3 35,12 35,28 20,37 5,28 5,12" fill="none" stroke="%2$s" stroke-width="1.6" />
            <circle cx="20" cy="20" r="3" fill="%2$s" />
            <circle cx="12" cy="14" r="2" fill="#fff" />
            <circle cx="28" cy="14" r="2" fill="#fff" />
            <circle cx="12" cy="26" r="2" fill="#fff" />
            <circle cx="28" cy="26" r="2" fill="#fff" />
            <line x1="20" y1="20" x2="12" y2="14" stroke="#fff" stroke-opacity="0.5" />
            <line x1="20" y1="20" x2="28" y2="14" stroke="#fff" stroke-opacity="0.5" />
            <line x1="20" y1="20" x2="12" y2="26" stroke="#fff" stroke-opacity="0.5" />
            <line x1="20" y1="20" x2="28" y2="26" stroke="#fff" stroke-opacity="0.5" />
        </svg>',
        absint( $size ),
        esc_attr( $stroke )
    );
}
