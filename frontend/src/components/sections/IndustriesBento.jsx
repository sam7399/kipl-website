import React from "react";
import { motion } from "framer-motion";
import { ArrowUpRight } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { INDUSTRIES } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

export const IndustriesBento = () => {
  return (
    <section id="industries" className="relative py-24 md:py-32 bg-kipl-slate" data-testid="industries-section">
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <SectionHeader
          eyebrow="Industries Served"
          title="Compounds that define entire categories."
          sub="From perfumery bases to pharmaceutical intermediates — our molecules quietly power the most demanding industries on the planet."
          testId="industries-header"
        />

        <motion.div
          variants={stagger}
          initial="hidden"
          whileInView="show"
          viewport={viewportOnce}
          className="mt-14 grid grid-cols-1 md:grid-cols-3 md:grid-rows-2 gap-4 md:gap-5 md:auto-rows-[280px]"
        >
          {INDUSTRIES.map((ind, i) => (
            <motion.div
              key={ind.key}
              variants={fadeUp}
              className={`group relative rounded-3xl overflow-hidden border border-slate-200 ${ind.span} min-h-[240px] hover:scale-[1.01] transition-transform duration-500`}
              data-testid={`industry-card-${ind.key}`}
            >
              <img
                src={ind.image}
                alt={ind.title}
                loading="lazy"
                className="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.06] transition-transform duration-[1200ms] ease-out"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-kipl-navy/90 via-kipl-navy/40 to-transparent" />
              <div className="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-kipl-emerald/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500" />

              <div className="relative h-full flex flex-col justify-between p-6 md:p-7 text-white">
                <div className="flex items-start justify-between">
                  <span className="font-mono text-[11px] tracking-[0.2em] text-white/70">
                    {String(i + 1).padStart(2, "0")} / {INDUSTRIES.length}
                  </span>
                  <span className="w-9 h-9 rounded-full bg-white/10 backdrop-blur flex items-center justify-center border border-white/20 group-hover:bg-kipl-emerald group-hover:border-kipl-emerald transition-all duration-300">
                    <ArrowUpRight className="w-4 h-4" />
                  </span>
                </div>

                <div>
                  <h3 className="font-display font-bold text-xl md:text-2xl lg:text-3xl leading-tight">
                    {ind.title}
                  </h3>
                  <p className="mt-2 text-sm text-white/70 max-w-sm leading-relaxed">
                    {ind.copy}
                  </p>
                </div>
              </div>
            </motion.div>
          ))}
        </motion.div>
      </div>
    </section>
  );
};

export default IndustriesBento;
