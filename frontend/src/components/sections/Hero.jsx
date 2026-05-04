import React from "react";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { ArrowRight, MousePointer2 } from "lucide-react";
import MolecularScene from "../kipl/MolecularScene";
import { fadeUp, stagger } from "../../lib/animations";

export const Hero = () => {
  return (
    <section
      className="relative min-h-[100svh] flex items-center overflow-hidden bg-kipl-navy text-white grain"
      data-testid="hero-section"
    >
      {/* Gradient base */}
      <div className="absolute inset-0 bg-gradient-to-br from-kipl-navy via-[#0A1A35] to-[#061022]" />

      {/* Molecular SVG scene */}
      <div className="absolute inset-0 opacity-[0.85]">
        <MolecularScene className="w-full h-full" />
      </div>

      {/* Vignette */}
      <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_0%,rgba(10,25,47,0.4)_60%,rgba(10,25,47,0.85)_100%)]" />

      {/* Content */}
      <div className="relative max-w-7xl mx-auto px-6 md:px-10 w-full pt-28 md:pt-32 pb-24 md:pb-28">
        <motion.div
          variants={stagger}
          initial="hidden"
          animate="show"
          className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-end"
        >
          <div className="lg:col-span-8">
            <motion.span
              variants={fadeUp}
              className="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald"
            >
              <span className="h-px w-10 bg-kipl-emerald" />
              Specialty Chemistry · Est. via Gem Aromatics 1997
            </motion.span>

            <motion.h1
              variants={fadeUp}
              data-testid="hero-headline"
              className="mt-6 font-display font-bold text-4xl sm:text-6xl lg:text-[5.25rem] leading-[0.98] tracking-tight"
            >
              Engineering the
              <br />
              Future of{" "}
              <span className="relative inline-block text-kipl-emerald">
                Specialty
                <svg
                  className="absolute -bottom-2 left-0 w-full"
                  viewBox="0 0 220 10"
                  preserveAspectRatio="none"
                  aria-hidden="true"
                >
                  <path
                    d="M2 8 C 60 2, 120 2, 218 8"
                    stroke="#10B981"
                    strokeWidth="1.5"
                    fill="none"
                    strokeLinecap="round"
                  />
                </svg>
              </span>{" "}
              Ingredients.
            </motion.h1>

            <motion.p
              variants={fadeUp}
              className="mt-8 max-w-xl text-base sm:text-lg text-white/70 leading-relaxed"
            >
              Advanced aroma chemicals and precision specialty solutions powering global
              industries. Built on legacy. Designed for tomorrow.
            </motion.p>

            <motion.div variants={fadeUp} className="mt-10 flex flex-wrap items-center gap-4">
              <Link
                to="/products"
                className="group inline-flex items-center gap-2 bg-kipl-emerald text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-kipl-emerald-dark hover:scale-[1.02] transition-all duration-300"
                data-testid="hero-cta-products"
              >
                Explore Our Products
                <ArrowRight className="w-4 h-4 group-hover:translate-x-0.5 transition-transform" />
              </Link>
              <Link
                to="/contact"
                className="inline-flex items-center gap-2 border border-white/25 text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-white/10 hover:scale-[1.02] transition-all duration-300"
                data-testid="hero-cta-contact"
              >
                Contact Our Experts
              </Link>
            </motion.div>
          </div>

          <motion.div variants={fadeUp} className="lg:col-span-4">
            <div className="grid grid-cols-2 gap-4">
              {[
                { v: "25+", l: "Years of group legacy" },
                { v: "40+", l: "Countries served" },
                { v: "₹230Cr", l: "Dahej plant investment" },
                { v: "99.5%", l: "Typical assay purity" },
              ].map((s, i) => (
                <div
                  key={i}
                  className="rounded-2xl border border-white/10 bg-white/[0.03] backdrop-blur-md p-5 hover:border-kipl-emerald/40 transition-colors duration-300"
                  data-testid={`hero-stat-${i}`}
                >
                  <div className="font-display text-3xl font-bold text-white">{s.v}</div>
                  <div className="mt-1 text-xs text-white/60 uppercase tracking-[0.18em]">
                    {s.l}
                  </div>
                </div>
              ))}
            </div>
          </motion.div>
        </motion.div>

        {/* scroll cue */}
        <div className="hidden md:flex absolute bottom-8 left-1/2 -translate-x-1/2 items-center gap-2 text-white/50 text-xs tracking-[0.28em] uppercase">
          <MousePointer2 className="w-3.5 h-3.5" /> Scroll to explore
        </div>
      </div>
    </section>
  );
};

export default Hero;
