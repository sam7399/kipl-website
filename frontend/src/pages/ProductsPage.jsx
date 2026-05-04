import React from "react";
import { motion } from "framer-motion";
import { Check, ArrowRight } from "lucide-react";
import PageHeader from "../components/kipl/PageHeader";
import ProductGrid from "../components/sections/ProductGrid";
import GlobalCompliance from "../components/sections/GlobalCompliance";
import ContactForm from "../components/sections/ContactForm";
import { PRODUCTS } from "../lib/data";
import { fadeUp, stagger, viewportOnce } from "../lib/animations";

export default function ProductsPage() {
  return (
    <div data-testid="products-page">
      <PageHeader
        eyebrow="Catalog · 2025"
        title="Five catalog families. One uncompromising standard."
        sub="Explore KIPL's specialty portfolio — from aroma chemicals to custom intermediates — engineered for global formulators."
        testId="products-page-header"
      />

      <ProductGrid />

      <section className="relative py-24 md:py-32 bg-kipl-slate" data-testid="products-detail-section">
        <div className="max-w-7xl mx-auto px-6 md:px-10">
          <motion.div
            variants={stagger}
            initial="hidden"
            whileInView="show"
            viewport={viewportOnce}
            className="grid grid-cols-1 md:grid-cols-2 gap-6"
          >
            {PRODUCTS.map((p) => (
              <motion.article
                key={p.key}
                variants={fadeUp}
                className="rounded-3xl bg-white border border-slate-200 p-8 hover:-translate-y-1 hover:shadow-xl hover:border-kipl-emerald/40 transition-all duration-300"
                data-testid={`products-detail-${p.key}`}
              >
                <div className="flex items-center justify-between">
                  <span className="font-mono text-xs tracking-[0.22em] text-kipl-emerald">{p.no}</span>
                  <span className="text-[10px] tracking-[0.22em] uppercase text-slate-500">Series</span>
                </div>
                <h2 className="mt-6 font-display font-bold text-3xl text-kipl-navy leading-tight">{p.title}</h2>
                <p className="mt-2 text-kipl-emerald font-semibold">{p.tagline}</p>
                <p className="mt-4 text-sm text-slate-600 leading-relaxed">{p.body}</p>
                <div className="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-2">
                  {p.bullets.map((b) => (
                    <div key={b} className="flex items-start gap-2 text-xs text-kipl-navy/75">
                      <Check className="w-3.5 h-3.5 text-kipl-emerald mt-0.5 flex-shrink-0" />
                      <span>{b}</span>
                    </div>
                  ))}
                </div>
                <a href="#contact" className="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald">
                  Request technical data sheet <ArrowRight className="w-4 h-4" />
                </a>
              </motion.article>
            ))}
          </motion.div>
        </div>
      </section>

      <GlobalCompliance />
      <ContactForm compact />
    </div>
  );
}
