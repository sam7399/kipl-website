import React from "react";

export const PageHeader = ({ eyebrow, title, sub, testId }) => {
  return (
    <section
      className="relative pt-36 md:pt-44 pb-16 md:pb-24 bg-kipl-navy text-white overflow-hidden"
      data-testid={testId || "page-header"}
    >
      <div className="absolute inset-0 opacity-20 pointer-events-none">
        <svg viewBox="0 0 1200 400" className="w-full h-full" preserveAspectRatio="xMidYMid slice" aria-hidden>
          <defs>
            <linearGradient id="ph-grad" x1="0" y1="0" x2="1" y2="1">
              <stop offset="0%" stopColor="#10B981" stopOpacity="0.5" />
              <stop offset="100%" stopColor="#10B981" stopOpacity="0" />
            </linearGradient>
          </defs>
          {Array.from({ length: 20 }).map((_, i) => {
            const cx = (i * 73) % 1200;
            const cy = (i * 131) % 400;
            return <circle key={i} cx={cx} cy={cy} r="2.2" fill="#10B981" opacity="0.5" />;
          })}
          <path d="M0 250 Q 300 150 600 250 T 1200 250" stroke="url(#ph-grad)" strokeWidth="1.5" fill="none" />
        </svg>
      </div>
      <div className="absolute -top-40 -right-32 w-[32rem] h-[32rem] rounded-full bg-kipl-emerald/10 blur-3xl" />

      <div className="relative max-w-7xl mx-auto px-6 md:px-10">
        {eyebrow && (
          <span className="inline-flex items-center gap-2 text-[11px] tracking-[0.32em] uppercase font-semibold text-kipl-emerald">
            <span className="h-px w-8 bg-kipl-emerald" />
            {eyebrow}
          </span>
        )}
        <h1 className="mt-6 font-display font-bold text-4xl sm:text-5xl lg:text-6xl leading-[1.05] tracking-tight max-w-4xl">
          {title}
        </h1>
        {sub && <p className="mt-6 text-base sm:text-lg text-white/70 max-w-2xl leading-relaxed">{sub}</p>}
      </div>
    </section>
  );
};

export default PageHeader;
