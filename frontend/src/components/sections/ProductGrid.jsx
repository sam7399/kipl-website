import React, { useRef } from "react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { ArrowRight, Check, ChevronLeft, ChevronRight } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { PRODUCTS } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

const MoleculeWatermark = () => (
  <svg viewBox="0 0 200 200" className="absolute -right-8 -bottom-8 w-48 h-48 opacity-0 group-hover:opacity-20 transition-opacity duration-500 text-kipl-emerald pointer-events-none">
    <g fill="none" stroke="currentColor" strokeWidth="1.2">
      <polygon points="100,30 160,60 160,130 100,160 40,130 40,60" />
      <circle cx="100" cy="30" r="5" fill="currentColor" />
      <circle cx="160" cy="60" r="5" fill="currentColor" />
      <circle cx="160" cy="130" r="5" fill="currentColor" />
      <circle cx="100" cy="160" r="5" fill="currentColor" />
      <circle cx="40" cy="130" r="5" fill="currentColor" />
      <circle cx="40" cy="60" r="5" fill="currentColor" />
      <circle cx="100" cy="95" r="7" fill="currentColor" />
      <line x1="100" y1="95" x2="100" y2="30" />
      <line x1="100" y1="95" x2="160" y2="60" />
      <line x1="100" y1="95" x2="160" y2="130" />
      <line x1="100" y1="95" x2="100" y2="160" />
      <line x1="100" y1="95" x2="40" y2="130" />
      <line x1="100" y1="95" x2="40" y2="60" />
    </g>
  </svg>
);

export const ProductGrid = () => {
  const railRef = useRef(null);
  const scrollBy = (dx) => railRef.current?.scrollBy({ left: dx, behavior: "smooth" });

  return (
    <section id="products" className="relative py-24 md:py-32 bg-white" data-testid="products-section">
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="flex flex-col md:flex-row md:items-end justify-between gap-8">
          <SectionHeader
            eyebrow="Products & Solutions"
            title="Precision Chemistry for Distinctive Applications"
            sub="Five catalog families — delivered at laboratory purity, engineered for industrial scale."
            testId="products-header"
          />
          <div className="hidden md:flex items-center gap-2">
            <button
              onClick={() => scrollBy(-380)}
              className="w-11 h-11 rounded-full border border-slate-200 hover:border-kipl-navy flex items-center justify-center transition"
              aria-label="Scroll left"
              data-testid="products-scroll-left"
            >
              <ChevronLeft className="w-4 h-4" />
            </button>
            <button
              onClick={() => scrollBy(380)}
              className="w-11 h-11 rounded-full border border-slate-200 hover:border-kipl-navy flex items-center justify-center transition"
              aria-label="Scroll right"
              data-testid="products-scroll-right"
            >
              <ChevronRight className="w-4 h-4" />
            </button>
          </div>
        </div>

        <motion.div
          ref={railRef}
          variants={stagger}
          initial="hidden"
          whileInView="show"
          viewport={viewportOnce}
          className="mt-12 flex gap-6 overflow-x-auto scroll-snap-x kipl-scrollbar pb-4 -mx-6 md:-mx-10 px-6 md:px-10"
          data-testid="products-rail"
        >
          {PRODUCTS.map((p, i) => (
            <motion.article
              key={p.key}
              variants={fadeUp}
              className={`group relative min-w-[300px] md:min-w-[360px] lg:min-w-[380px] rounded-3xl border border-slate-200 bg-kipl-slate p-8 overflow-hidden hover:-translate-y-1 hover:shadow-2xl hover:border-kipl-emerald/40 transition-all duration-300`}
              data-testid={`product-card-${p.key}`}
            >
              <MoleculeWatermark />
              <div className="flex items-center justify-between">
                <span className="font-mono text-xs tracking-[0.22em] text-kipl-emerald">{p.no}</span>
                <span className="text-[10px] tracking-[0.2em] uppercase text-slate-500">Series</span>
              </div>

              <h3 className="mt-8 font-display font-bold text-2xl md:text-[28px] text-kipl-navy leading-tight">
                {p.title}
              </h3>
              <p className="mt-2 text-sm text-kipl-emerald font-semibold">{p.tagline}</p>
              <p className="mt-4 text-sm text-slate-600 leading-relaxed">{p.body}</p>

              <ul className="mt-6 space-y-2 text-sm text-kipl-navy/80">
                {p.bullets.map((b) => (
                  <li key={b} className="flex items-start gap-2">
                    <Check className="w-4 h-4 text-kipl-emerald mt-0.5 flex-shrink-0" />
                    <span>{b}</span>
                  </li>
                ))}
              </ul>

              <div className="mt-8 pt-6 border-t border-slate-200">
                <Link
                  to="/products"
                  className="inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald transition-colors"
                  data-testid={`product-link-${p.key}`}
                >
                  Request technical spec
                  <ArrowRight className="w-4 h-4" />
                </Link>
              </div>
            </motion.article>
          ))}
        </motion.div>
      </div>
    </section>
  );
};

export default ProductGrid;
