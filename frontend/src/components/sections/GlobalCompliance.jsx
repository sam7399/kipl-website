import React from "react";
import { COMPLIANCE_BADGES } from "../../lib/data";

export const GlobalCompliance = () => {
  return (
    <section
      className="relative py-14 bg-white border-y border-slate-200 overflow-hidden"
      data-testid="compliance-section"
    >
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div className="max-w-md">
            <span className="text-xs tracking-[0.28em] uppercase font-semibold text-kipl-emerald">
              Global Compliance
            </span>
            <p className="mt-2 font-display font-bold text-2xl text-kipl-navy leading-tight">
              Certified. Documented. Audited.
            </p>
          </div>

          <div className="relative flex-1 overflow-hidden" aria-hidden>
            <div className="flex gap-10 marquee-track" style={{ width: "max-content" }}>
              {[...COMPLIANCE_BADGES, ...COMPLIANCE_BADGES].map((b, i) => (
                <div
                  key={i}
                  className="flex items-center gap-3 text-kipl-navy font-mono text-sm whitespace-nowrap"
                  data-testid={`compliance-badge-${i}`}
                >
                  <span className="w-2 h-2 rounded-full bg-kipl-emerald" />
                  {b}
                </div>
              ))}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default GlobalCompliance;
