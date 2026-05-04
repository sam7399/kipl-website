import React from "react";
import { motion } from "framer-motion";
import { fadeUp, viewportOnce } from "../../lib/animations";

export const SectionHeader = ({ eyebrow, title, sub, align = "left", invert = false, testId }) => {
  const alignCls = align === "center" ? "text-center items-center" : "text-left items-start";
  const titleColor = invert ? "text-white" : "text-kipl-navy";
  const subColor = invert ? "text-white/70" : "text-slate-600";
  return (
    <motion.div
      variants={fadeUp}
      initial="hidden"
      whileInView="show"
      viewport={viewportOnce}
      className={`flex flex-col gap-4 max-w-3xl ${alignCls}`}
      data-testid={testId}
    >
      {eyebrow && (
        <span className="inline-flex items-center gap-2 text-xs tracking-[0.28em] uppercase font-bold text-kipl-emerald">
          <span className="h-px w-6 bg-kipl-emerald" />
          {eyebrow}
        </span>
      )}
      <h2 className={`font-display font-bold text-3xl sm:text-4xl lg:text-5xl leading-[1.05] tracking-tight ${titleColor}`}>
        {title}
      </h2>
      {sub && <p className={`text-base sm:text-lg leading-relaxed max-w-2xl ${subColor}`}>{sub}</p>}
    </motion.div>
  );
};

export default SectionHeader;
