import React from "react";
import { motion } from "framer-motion";
import { Leaf, ShieldCheck, Handshake, Download } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { SUSTAINABILITY_PILLARS, IMAGES } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

const iconMap = { Leaf, ShieldCheck, Handshake };

export const Sustainability = () => {
  return (
    <section
      id="sustainability"
      className="relative py-24 md:py-32 bg-kipl-emerald-deep text-white overflow-hidden"
      data-testid="sustainability-section"
    >
      <img
        src={IMAGES.sustainability}
        alt=""
        aria-hidden
        className="absolute inset-0 w-full h-full object-cover opacity-[0.18] mix-blend-screen"
      />
      <div className="absolute inset-0 bg-gradient-to-br from-[#022C22] via-[#022C22]/95 to-[#034430]/90" />
      <div className="absolute -top-40 -left-20 w-[30rem] h-[30rem] bg-kipl-emerald/10 blur-3xl rounded-full" />

      <div className="relative max-w-7xl mx-auto px-6 md:px-10">
        <SectionHeader
          eyebrow="Quality · Compliance · Sustainability"
          title="Engineered with Integrity. Manufactured with Responsibility."
          sub="At KIPL, quality is non-negotiable and sustainability is operational core. We bridge cutting-edge chemistry with environmental stewardship."
          invert
          testId="sustainability-header"
        />

        <motion.div
          variants={stagger}
          initial="hidden"
          whileInView="show"
          viewport={viewportOnce}
          className="mt-16 grid grid-cols-1 md:grid-cols-3 gap-5"
        >
          {SUSTAINABILITY_PILLARS.map((p, i) => {
            const Icon = iconMap[p.icon] || Leaf;
            return (
              <motion.div
                key={p.title}
                variants={fadeUp}
                className="rounded-3xl border border-white/10 bg-white/[0.04] backdrop-blur-md p-7 hover:bg-white/[0.07] hover:-translate-y-1 transition-all duration-300"
                data-testid={`sustainability-pillar-${i}`}
              >
                <div className="w-12 h-12 rounded-2xl bg-kipl-emerald/15 border border-kipl-emerald/40 text-kipl-emerald flex items-center justify-center">
                  <Icon className="w-5 h-5" />
                </div>
                <h3 className="mt-6 font-display font-bold text-xl text-white leading-tight">
                  {p.title}
                </h3>
                <p className="mt-3 text-sm text-white/70 leading-relaxed">{p.body}</p>
              </motion.div>
            );
          })}
        </motion.div>

        <motion.div
          variants={fadeUp}
          initial="hidden"
          whileInView="show"
          viewport={viewportOnce}
          className="mt-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 rounded-3xl border border-white/10 bg-white/[0.04] backdrop-blur-md p-7"
          data-testid="sustainability-report-cta"
        >
          <div>
            <div className="text-xs tracking-[0.24em] uppercase text-kipl-emerald font-semibold">
              KIPL · ESG Report 2025
            </div>
            <h4 className="mt-2 font-display font-bold text-2xl">
              Download our latest Sustainability Report.
            </h4>
            <p className="text-sm text-white/60 mt-1 max-w-lg">
              Detailed KPIs on emissions reduction, water recycling, solvent recovery & supply-chain audits.
            </p>
          </div>
          <a
            href="#"
            onClick={(e) => e.preventDefault()}
            className="inline-flex items-center gap-2 bg-kipl-emerald hover:bg-kipl-emerald-dark text-white px-6 py-3.5 rounded-full text-sm font-semibold hover:scale-[1.02] transition-all duration-300"
            data-testid="sustainability-download-btn"
          >
            Download PDF
            <Download className="w-4 h-4" />
          </a>
        </motion.div>
      </div>
    </section>
  );
};

export default Sustainability;
