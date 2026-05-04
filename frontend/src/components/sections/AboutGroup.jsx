import React from "react";
import { motion } from "framer-motion";
import { Globe2, Gem, Factory } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { TIMELINE } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

const PILLARS = [
  { icon: Globe2, title: "Global Footprint", body: "Exporting trusted solutions to a diverse, international customer base." },
  { icon: Gem, title: "Proven Expertise", body: "Leveraging decades of operational and financial strength from our parent group." },
  { icon: Factory, title: "Future-Ready Scale", body: "Expanding horizons with state-of-the-art manufacturing infrastructure." },
];

export const AboutGroup = () => {
  return (
    <section
      id="about"
      className="relative py-24 md:py-32 bg-kipl-slate overflow-hidden"
      data-testid="about-section"
    >
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-20">
          <div className="lg:col-span-6 flex flex-col gap-10">
            <SectionHeader
              eyebrow="About KIPL · Group Strength"
              title={<><span>A Legacy of Excellence.</span><br /><span className="text-kipl-emerald">A Future of Innovation.</span></>}
              sub="Krystal Ingredients Private Limited (KIPL) is a next-generation specialty chemical manufacturer and a wholly-owned subsidiary of Gem Aromatics Limited. Backed by a 25+ year legacy in essential oils and aroma chemicals, KIPL is engineered to meet the evolving demands of global markets."
              testId="about-header"
            />

            <motion.div
              variants={stagger}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="grid grid-cols-1 sm:grid-cols-3 gap-4"
            >
              {PILLARS.map((p, i) => (
                <motion.div
                  key={p.title}
                  variants={fadeUp}
                  className="group relative rounded-2xl bg-white border border-slate-200 p-6 hover:-translate-y-1 hover:shadow-xl hover:border-kipl-emerald/40 transition-all duration-300"
                  data-testid={`about-pillar-${i}`}
                >
                  <div className="w-10 h-10 rounded-xl bg-kipl-navy text-kipl-emerald flex items-center justify-center mb-4">
                    <p.icon className="w-5 h-5" />
                  </div>
                  <h4 className="font-display font-semibold text-lg text-kipl-navy leading-tight">
                    {p.title}
                  </h4>
                  <p className="mt-2 text-sm text-slate-600 leading-relaxed">{p.body}</p>
                </motion.div>
              ))}
            </motion.div>
          </div>

          {/* Timeline */}
          <div className="lg:col-span-6">
            <motion.div
              variants={fadeUp}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="relative rounded-3xl bg-kipl-navy text-white p-8 md:p-10 overflow-hidden"
              data-testid="about-timeline"
            >
              <div className="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-kipl-emerald/10 blur-3xl" />
              <div className="flex items-center justify-between mb-8">
                <span className="text-xs tracking-[0.28em] uppercase font-semibold text-kipl-emerald">
                  Timeline · 1997 → Present
                </span>
                <span className="font-mono text-[11px] text-white/40">GEM · KIPL</span>
              </div>

              <ol className="relative space-y-8">
                <span className="absolute left-[11px] top-1 bottom-1 w-px bg-white/15" aria-hidden />
                {TIMELINE.map((t, i) => (
                  <motion.li
                    key={t.year}
                    variants={fadeUp}
                    className="relative pl-10"
                    data-testid={`timeline-item-${i}`}
                  >
                    <span className="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-kipl-emerald/10 border border-kipl-emerald flex items-center justify-center">
                      <span className="w-2 h-2 rounded-full bg-kipl-emerald" />
                    </span>
                    <div className="font-mono text-xs tracking-widest text-kipl-emerald">
                      {t.year}
                    </div>
                    <div className="mt-1 font-display text-lg font-semibold text-white">
                      {t.title}
                    </div>
                    <p className="mt-1 text-sm text-white/60 leading-relaxed max-w-md">
                      {t.body}
                    </p>
                  </motion.li>
                ))}
              </ol>
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default AboutGroup;
