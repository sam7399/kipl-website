import React from "react";

// Animated molecular bonds scene - pure SVG + CSS
// Honours reduced motion and is decorative only
export const MolecularScene = ({ className = "" }) => {
  return (
    <svg
      className={className}
      viewBox="0 0 1200 800"
      preserveAspectRatio="xMidYMid slice"
      aria-hidden="true"
      data-testid="hero-molecular-scene"
    >
      <defs>
        <radialGradient id="nodeGlow" cx="50%" cy="50%" r="50%">
          <stop offset="0%" stopColor="#10B981" stopOpacity="0.9" />
          <stop offset="60%" stopColor="#10B981" stopOpacity="0.25" />
          <stop offset="100%" stopColor="#10B981" stopOpacity="0" />
        </radialGradient>
        <linearGradient id="bondStroke" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0%" stopColor="#10B981" stopOpacity="0.75" />
          <stop offset="100%" stopColor="#38BDF8" stopOpacity="0.35" />
        </linearGradient>
        <filter id="soft">
          <feGaussianBlur stdDeviation="1.2" />
        </filter>
      </defs>

      {/* Background grid */}
      <g opacity="0.06" stroke="#CBD5E1" strokeWidth="0.5">
        {Array.from({ length: 14 }).map((_, i) => (
          <line key={`v${i}`} x1={i * 90} y1="0" x2={i * 90} y2="800" />
        ))}
        {Array.from({ length: 10 }).map((_, i) => (
          <line key={`h${i}`} x1="0" y1={i * 90} x2="1200" y2={i * 90} />
        ))}
      </g>

      {/* Slowly rotating hex lattice */}
      <g className="mol-spin" style={{ transformOrigin: "600px 400px" }}>
        {[0, 60, 120, 180, 240, 300].map((a, i) => {
          const rad = (a * Math.PI) / 180;
          const x = 600 + Math.cos(rad) * 180;
          const y = 400 + Math.sin(rad) * 180;
          return (
            <g key={i}>
              <line
                x1="600"
                y1="400"
                x2={x}
                y2={y}
                stroke="url(#bondStroke)"
                strokeWidth="1.2"
                className="mol-bond"
                strokeLinecap="round"
              />
              <circle cx={x} cy={y} r="7" fill="#0A192F" stroke="#10B981" strokeWidth="1.4" className="mol-node" />
            </g>
          );
        })}
        <circle cx="600" cy="400" r="10" fill="#10B981" filter="url(#soft)" className="mol-node" />
      </g>

      {/* Floating molecule A */}
      <g className="mol-float-a">
        <g transform="translate(220,180)">
          <circle cx="60" cy="60" r="70" fill="url(#nodeGlow)" />
          {[
            [60, 20],
            [100, 45],
            [100, 85],
            [60, 110],
            [20, 85],
            [20, 45],
          ].map(([cx, cy], i, arr) => {
            const [nx, ny] = arr[(i + 1) % arr.length];
            return (
              <g key={i}>
                <line x1={cx} y1={cy} x2={nx} y2={ny} stroke="#10B981" strokeOpacity="0.7" strokeWidth="1.1" className="mol-bond" />
                <circle cx={cx} cy={cy} r="4" fill="#E2E8F0" />
              </g>
            );
          })}
        </g>
      </g>

      {/* Floating molecule B */}
      <g className="mol-float-b">
        <g transform="translate(880,500)">
          <circle cx="60" cy="60" r="80" fill="url(#nodeGlow)" />
          {[
            [60, 10],
            [110, 40],
            [110, 80],
            [60, 110],
            [10, 80],
            [10, 40],
          ].map(([cx, cy], i, arr) => {
            const [nx, ny] = arr[(i + 2) % arr.length];
            return (
              <g key={i}>
                <line x1={cx} y1={cy} x2={nx} y2={ny} stroke="#38BDF8" strokeOpacity="0.55" strokeWidth="1" className="mol-bond" />
                <circle cx={cx} cy={cy} r="3.5" fill="#CBD5E1" />
              </g>
            );
          })}
        </g>
      </g>

      {/* Floating molecule C */}
      <g className="mol-float-a" style={{ animationDuration: "12s" }}>
        <g transform="translate(940,140)">
          <circle cx="40" cy="40" r="50" fill="url(#nodeGlow)" opacity="0.6" />
          {[
            [40, 10],
            [70, 30],
            [70, 60],
            [40, 80],
            [10, 60],
            [10, 30],
          ].map(([cx, cy], i, arr) => {
            const [nx, ny] = arr[(i + 3) % arr.length];
            return (
              <g key={i}>
                <line x1={cx} y1={cy} x2={nx} y2={ny} stroke="#10B981" strokeOpacity="0.35" strokeWidth="0.9" className="mol-bond" />
                <circle cx={cx} cy={cy} r="3" fill="#94A3B8" />
              </g>
            );
          })}
        </g>
      </g>

      {/* Dots field */}
      <g opacity="0.5">
        {Array.from({ length: 70 }).map((_, i) => {
          const x = (i * 97) % 1200;
          const y = (i * 173) % 800;
          return <circle key={i} cx={x} cy={y} r="1.2" fill="#64748B" />;
        })}
      </g>
    </svg>
  );
};

export default MolecularScene;
