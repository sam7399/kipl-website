import React from "react";
import { motion } from "framer-motion";
import { FlaskConical, Atom, Microscope } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { IMAGES } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

const CAPABILITIES = [
  { icon: FlaskConical, title: "Bench to Commercial", body: "Scale from gram to metric-tonne through rigorous pilot validation." },
  { icon: Atom, title: "Custom Molecules", body: "Proprietary syntheses developed under NDA for downstream formulators." },
  { icon: Microscope, title: "Analytical Excellence", body: "In-house GC-MS, HPLC, IR & NMR for full spectroscopic traceability." },
];

export const RnDInnovation = () => {
  return (
    <section id="rnd" className="relative py-24 md:py-32 bg-kipl-slate" data-testid="rnd-section">
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          <motion.div
            variants={fadeUp}
            initial="hidden"
            whileInView="show"
            viewport={viewportOnce}
            className="lg:col-span-6 relative rounded-3xl overflow-hidden border border-slate-200 aspect-[4/3]"
          >
            <img src={IMAGES.lab} alt="KIPL research laboratory" className="absolute inset-0 w-full h-full object-cover" />
            <div className="absolute inset-0 bg-gradient-to-t from-kipl-navy/70 to-transparent" />
            {/* Structural formula overlay */}
            <svg
              viewBox="0 0 400 260"
              className="absolute bottom-6 left-6 right-6 w-[calc(100%-3rem)] h-32 text-white/90"
              aria-hidden
            >
              <g fill="none" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round">
                <line x1="20" y1="130" x2="70" y2="100" />
                <line x1="70" y1="100" x2="120" y2="130" />
                <line x1="120" y1="130" x2="170" y2="100" />
                <line x1="170" y1="100" x2="220" y2="130" />
                <line x1="220" y1="130" x2="270" y2="100" />
                <line x1="270" y1="100" x2="320" y2="130" />
                <line x1="320" y1="130" x2="370" y2="100" />
                <line x1="170" y1="100" x2="170" y2="60" />
                <circle cx="170" cy="50" r="8" stroke="#10B981" />
                <text x="165" y="54" fontFamily="JetBrains Mono" fontSize="12" fill="#10B981" stroke="none">O</text>
                <circle cx="270" cy="100" r="8" stroke="#10B981" />
                <text x="265" y="104" fontFamily="JetBrains Mono" fontSize="12" fill="#10B981" stroke="none">H</text>
              </g>
              <text x="20" y="230" fontFamily="JetBrains Mono" fontSize="10" fill="#10B981">
                C10H14O · molecular weight 150.22 g/mol · purity ≥ 99.5%
              </text>
            </svg>

            <div className="absolute top-6 left-6 flex items-center gap-2 text-xs tracking-[0.2em] uppercase text-white/80">
              <span className="w-2 h-2 rounded-full bg-kipl-emerald animate-pulse" />
              Live · R&amp;D Lab, Mumbai
            </div>
          </motion.div>

          <div className="lg:col-span-6">
            <SectionHeader
              eyebrow="R&amp;D · Innovation"
              title="Innovating at the Molecular Level."
              sub="Our laboratories are the heart of KIPL. Driven by a team of elite chemists, we focus on continuous product innovation and custom molecule development for complex industrial challenges."
              testId="rnd-header"
            />

            <motion.div
              variants={stagger}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="mt-10 space-y-3"
            >
              {CAPABILITIES.map((c, i) => (
                <motion.div
                  key={c.title}
                  variants={fadeUp}
                  className="flex gap-4 p-5 rounded-2xl bg-white border border-slate-200 hover:border-kipl-emerald/40 hover:-translate-y-0.5 transition-all duration-300"
                  data-testid={`rnd-capability-${i}`}
                >
                  <div className="w-10 h-10 rounded-xl bg-kipl-emerald/10 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                    <c.icon className="w-5 h-5" />
                  </div>
                  <div>
                    <div className="font-display font-semibold text-kipl-navy">{c.title}</div>
                    <p className="text-sm text-slate-600 mt-1 leading-relaxed">{c.body}</p>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default RnDInnovation;
