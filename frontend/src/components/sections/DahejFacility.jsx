import React, { useState } from "react";
import { motion } from "framer-motion";
import { Cpu, Zap, ShieldCheck } from "lucide-react";
import SectionHeader from "../kipl/SectionHeader";
import { HOTSPOTS, IMAGES } from "../../lib/data";
import { fadeUp, stagger, viewportOnce } from "../../lib/animations";

const KEY_HIGHLIGHTS = [
  { icon: Cpu, title: "Advanced Production", body: "Fully automated, continuous processing technology for maximum yield and purity." },
  { icon: Zap, title: "Massive Scalability", body: "High-capacity infrastructure built to fulfill global volume demands without compromising precision." },
  { icon: ShieldCheck, title: "Uncompromising Safety", body: "Designed to exceed the most stringent international safety and operational standards." },
];

export const DahejFacility = () => {
  const [active, setActive] = useState(HOTSPOTS[0].key);
  const current = HOTSPOTS.find((h) => h.key === active) || HOTSPOTS[0];

  return (
    <section id="manufacturing" className="relative py-24 md:py-32 bg-white" data-testid="manufacturing-section">
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-14">
          <div className="lg:col-span-5 flex flex-col gap-10">
            <SectionHeader
              eyebrow="Manufacturing · Dahej, Gujarat"
              title="The Next Frontier of Manufacturing."
              sub="Our upcoming ₹230 Cr Dahej facility represents the pinnacle of modern chemical engineering — where automation, yield and global-grade safety converge."
              testId="manufacturing-header"
            />

            <motion.div
              variants={stagger}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="flex flex-col gap-4"
            >
              {KEY_HIGHLIGHTS.map((h, i) => (
                <motion.div
                  key={h.title}
                  variants={fadeUp}
                  className="flex gap-4 p-5 rounded-2xl border border-slate-200 hover:border-kipl-emerald/40 hover:bg-kipl-slate transition-colors duration-300"
                  data-testid={`dahej-highlight-${i}`}
                >
                  <div className="w-11 h-11 rounded-xl bg-kipl-navy text-kipl-emerald flex items-center justify-center flex-shrink-0">
                    <h.icon className="w-5 h-5" />
                  </div>
                  <div>
                    <h4 className="font-display font-semibold text-kipl-navy">{h.title}</h4>
                    <p className="text-sm text-slate-600 mt-1 leading-relaxed">{h.body}</p>
                  </div>
                </motion.div>
              ))}
            </motion.div>
          </div>

          <div className="lg:col-span-7">
            <motion.div
              variants={fadeUp}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="relative rounded-3xl overflow-hidden border border-slate-200 bg-kipl-navy aspect-[4/3] lg:aspect-[5/4]"
              data-testid="dahej-hotspot-map"
            >
              <img
                src={IMAGES.dahejFacility}
                alt="KIPL Dahej facility"
                className="absolute inset-0 w-full h-full object-cover opacity-90"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-kipl-navy/80 via-transparent to-kipl-navy/30" />

              {HOTSPOTS.map((h) => (
                <button
                  key={h.key}
                  onClick={() => setActive(h.key)}
                  className="absolute -translate-x-1/2 -translate-y-1/2 group"
                  style={{ left: h.x, top: h.y }}
                  aria-label={h.label}
                  data-testid={`hotspot-${h.key}`}
                >
                  <span className={`block w-4 h-4 rounded-full hotspot-dot ${active === h.key ? "bg-white" : "bg-kipl-emerald"}`} />
                  <span className={`absolute top-6 left-1/2 -translate-x-1/2 whitespace-nowrap text-[11px] tracking-[0.18em] uppercase font-semibold px-3 py-1 rounded-full ${active === h.key ? "bg-white text-kipl-navy" : "bg-kipl-navy/80 text-white"} transition-colors duration-300`}>
                    {h.label}
                  </span>
                </button>
              ))}

              <div className="absolute bottom-6 left-6 right-6 p-5 rounded-2xl bg-white/10 backdrop-blur-xl border border-white/15 text-white" data-testid="hotspot-detail">
                <div className="flex items-center justify-between">
                  <span className="text-[10px] tracking-[0.28em] uppercase text-kipl-emerald font-semibold">
                    Zone · {current.label}
                  </span>
                  <span className="font-mono text-[10px] text-white/50">
                    {HOTSPOTS.findIndex((h) => h.key === active) + 1} / {HOTSPOTS.length}
                  </span>
                </div>
                <p className="mt-2 text-sm text-white/85 leading-relaxed">{current.detail}</p>
              </div>
            </motion.div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default DahejFacility;
